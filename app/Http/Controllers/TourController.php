<?php

namespace App\Http\Controllers;

use App\Jobs\PreBookHotelJob;
use App\Jobs\SendPackageConfirmationEmail;
use App\Models\FerryBookings;
use App\Models\Hotel;
use App\Models\HotelBookings;
use App\Models\PassengerDetails;
use App\Models\RazorpayTransactions;
use App\Models\subCategories;
use App\Models\temp_itineraries;
use App\Models\TempItinerary;
use App\Models\PackagePricing;
use App\Models\TourPackages;
use App\Services\MakruzzApiService;
use App\Services\SealinkService;
use App\Services\TboHotelService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Service;
use App\Models\Addon;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use App\Models\Booking;
use App\Models\GoogleReview;
use Illuminate\Support\Facades\Redirect;

use App\Models\Lead;
use App\Models\PaymentBreakups;
use App\Models\ReviewImage;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Mail;   // 👈 this one is required

use Throwable;
use Barryvdh\DomPDF\Facade\Pdf;


class TourController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $sealinkService;
    protected $makruzzApiService;
    protected $tboHotelService;
    public $trips;
    public $Mtrip = 1;
    public $tripIndexToCheck = 0;
    public $bookingDatas = null;
    public $billingDetail;
    public $credit = 0;

    public function __construct(SealinkService $sealinkService, MakruzzApiService $makruzzApiService, TboHotelService $tboHotelService)
    {
        $this->sealinkService = $sealinkService;
        $this->makruzzApiService = $makruzzApiService;
        $this->tboHotelService = $tboHotelService;
    }


    public static function FerryApiBalance()
    {
        $sealinkService = app()->make(SealinkService::class);
        $makruzzService = app()->make(MakruzzApiService::class);

        $nautikaBalance = $sealinkService->getBalance();

        $makruzzBalance = $makruzzService->getBalance();
        $data = [
            'nautikaBalance' => $nautikaBalance,
            'makruzzBalance' => $makruzzBalance
        ];

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tours = TourPackages::with(['tourCategory', 'tourPhotos', 'subCategories'])
            ->where('status', 1)
            ->when($request->category !== 'best-seller', function ($q) use ($request) {
                $q->whereHas('tourCategory', function ($query) use ($request) {
                    $query->when(!empty($request->categories), fn($q) => $q->whereIn('slug', $request->categories))
                        ->when(!empty($request->category), fn($q) => $q->where('slug', $request->category));
                });
            })
            ->when($request->category == 'best-seller', fn($q) => $q->where('best_seller', 1))
            ->when(!empty($request->ratings), fn($q) => $q->whereIn('ratings', $request->ratings))
            ->when($request->featured == 1, fn($q) => $q->where('featured', 1))
            ->when(!empty($request->status), fn($q) => $q->where('status', $request->status))
            ->when(!empty($request->min_price), fn($q) => $q->where('package_cost', '>=', $request->min_price))
            ->when(!empty($request->max_price), fn($q) => $q->where('package_cost', '<=', $request->max_price))
            ->when(!empty($request->keyword), function ($query) use ($request) {
                $query->where(
                    fn($q) =>
                    $q->where('package_name', 'like', "%{$request->keyword}%")
                        ->orWhere('description', 'like', "%{$request->keyword}%")
                );
            })
            ->paginate(9);


        $tours->each(function ($tour) {
            $cat = $tour->subCategories->sortBy('pivot.starts_from')->first();
            $tour->start_price = optional($cat?->pivot)->starts_from ?? $tour->package_cost;
            $tour->sub_cat = $cat?->name ?? 'standard';
            $tour->discount = optional($cat?->pivot)->discount ?? 0;
        });

        $checkin = $request->input('checkin');
        $paxRooms = $request->input('PaxRooms');

        $inputs = [
            'travel_date' => $checkin,
            'PaxRooms' => $paxRooms
        ];

        if ($request->ajax()) {
            return response()->json([
                'tours' => $tours->items(),
                'next_page' => $tours->nextPageUrl(),
                'has_more' => $tours->hasMorePages()
            ]);
        }


        $categories = Category::where('type', 'tour')->where('status', 1)->get();
        $locations = ['Portblair', 'Havelock', 'Neil Island'];
        return view('tours.index', compact('tours', 'categories', 'locations', 'inputs'));
    }



    public function dev(string $slug)
    {
        $tour = Service::with(['tourPhotos', 'category', 'facilities', 'policies', 'faqs', 'reviews', 'addons'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'tour')
                    ->where('slug', $slug);
            })
            ->where('type', 'tour')->first();


        $addons = Addon::with(['addonPhotos'])->get();
        if ($tour && $tour->addons) {
            $addonIds = explode(',', $tour->addons);
            $tour->addon_names = Addon::whereIn('id', $addonIds)->get();
        }
        $tours = Service::with(['tourPhotos', 'category', 'addons'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'tour')
                    ->where('slug', $slug);
            })
            ->where('type', 'tour')
            // ->whereNot('slug', $subslug)
            ->inRandomOrder()
            ->get();
        $page = $tour->category->slug ?? 'default';
        return view("pages.dev.tours.static.$page.index")
            ->with(compact('tour', 'addons', 'tours'));
    }


    public function view(string $slug, string $subslug = null)
    {

        $tour = Service::with(['tourPhotos', 'category', 'facilities', 'policies', 'faqs', 'reviews', 'addon'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'tour')
                    ->where('slug', $slug);
            })
            ->where('type', 'tour')
            ->firstWhere('slug', $subslug);
        // dd($slug);
        if ($subslug && !$tour) {
            abort(404, 'Page not found.');
        }


        $addons = Addon::with(['addonPhotos'])->get();
        if ($tour && $tour->addons) {
            $addonIds = explode(',', $tour->addons);
            $tour->addon_names = Addon::whereIn('id', $addonIds)->get();
        }
        $tours = Service::with(['tourPhotos'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'tour')
                    ->where('slug', $slug);
            })
            ->where('type', 'tour')
            ->inRandomOrder()
            ->get();

        $hotels = [
            [
                'name' => 'Hotel G International',
                'location' => 'Port Blair',
                'image' => asset('site/img/hotel/g-international.webp'),
                'rating' => 3,
                'amenities' => [
                    ['icon' => 'fa-wifi', 'text' => 'Free Wi-Fi'],
                    ['icon' => 'fa-swimming-pool', 'text' => 'Water Sports'],
                    ['icon' => 'fa-utensils', 'text' => 'Restaurant'],
                    ['icon' => 'fa-car', 'text' => 'Parking'],
                    ['icon' => 'fa-cocktail', 'text' => 'Bar'],
                    ['icon' => 'fa-fire', 'text' => 'Bonfire(Paid)']
                ]
            ],
            [
                'name' => 'Radhakrishna Resort',
                'location' => 'Havelock Island',
                'image' => asset('site/img/hotel/radhakrishna.jpg'),
                'rating' => 3,
                'amenities' => [
                    ['icon' => 'fa-wifi', 'text' => 'Free Wi-Fi'],
                    ['icon' => 'fa-phone', 'text' => 'Telephone'],
                    ['icon' => 'fa-utensils', 'text' => 'Restaurant'],
                    ['icon' => 'fa-car', 'text' => 'Car hire/Parking'],
                    ['icon' => 'fa-bed', 'text' => 'Tile / marble floor'],
                    ['icon' => 'fa-umbrella-beach', 'text' => 'Private Beach']
                ]
            ]
        ];




        return view('tours.static.index')->with(compact('tour', 'addons', 'tours', 'hotels'));
    }

    public function devview(string $slug, string $subslug = null)
    {
        $tour = Service::with(['tourPhotos', 'category', 'facilities', 'policies', 'faqs', 'reviews', 'addon'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'tour')
                    ->where('slug', $slug);
            })
            ->where('type', 'tour')
            ->firstWhere('slug', $subslug);

        if ($subslug && !$tour) {
            abort(404, 'Page not found.');
        }


        $addons = Addon::with(['addonPhotos'])->get();
        if ($tour && $tour->addons) {
            $addonIds = explode(',', $tour->addons);
            $tour->addon_names = Addon::whereIn('id', $addonIds)->get();
        }
        $tours = Service::with(['tourPhotos'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'tour')
                    ->where('slug', $slug);
            })
            ->where('type', 'tour')
            ->inRandomOrder()
            ->get();
        return view('pages.dev.tours.static.index')
            ->with(compact('tour', 'addons', 'tours'));
    }

    public function tourDev(Request $request)
    {
        $tours = Service::with(['category', 'tourPhotos'])
            ->where('type', 'tour')
            ->whereHas('category', function ($query) use ($request) {
                $query->when(!empty($request->categories), function ($q) use ($request) {
                    $q->whereIn('slug', $request->categories);
                })
                    ->when(!empty($request->category), function ($q) use ($request) {
                        $q->where('slug', $request->category);
                    });
            })
            ->when(!empty($request->ratings), fn($q) => $q->whereIn('ratings', $request->ratings))
            ->when($request->featured == 1, fn($q) => $q->where('featured', 1))
            ->when($request->best_seller == 1, fn($q) => $q->where('best_seller', 1))
            ->when(!empty($request->status), fn($q) => $q->where('status', $request->status))
            ->when(!empty($request->min_price), fn($q) => $q->where('adult_price', '>=', $request->min_price))
            ->when(!empty($request->max_price), fn($q) => $q->where('adult_price', '<=', $request->max_price))
            ->when(!empty($request->keyword), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', "%{$request->keyword}%")
                        ->orWhere('description', 'like', "%{$request->keyword}%");
                });
            })
            ->paginate(6);

        if ($request->ajax()) {
            return response()->json([
                'tours' => $tours->items(), // Raw tour data
                'next_page' => $tours->nextPageUrl(),
                'has_more' => $tours->hasMorePages() // For debugging
            ]);
        }

        $categories = Category::where('type', 'tour')->get();
        $locations = ['Portblair', 'Havelock', 'Neil Island'];

        return view('pages.dev.tours.index')->with(compact('tours', 'categories', 'locations'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $category = $request->route('category');
        $slug = $request->route('slug');
        $subslug = $request->route('subslug');
        $priceBreakdown = [];


        $totalCosts = 0;
        $guests = [];
        $vehicleMap = [
            'four_seater_sedan' => 4,
            'six_seater_xylo_ertiga' => 6,
            'seven_seater_innova_hexa_marazzo' => 7,
            'twelve_seater_winger' => 12,
            'seventeen_seater_tempo' => 17,
            'twenty_six_seater_tempo_traveller' => 26,
        ];

        $categories = null;
        if (!empty($category)) {
            $categories = subCategories::where('name', $category)->first();
        }



        $tour = TourPackages::with([
            'tourPhotos',
            'TourItinerary',
            'TourItinerary.transfers',
            'TourItinerary.activities.activity',
            'TourItinerary.services',
            'faqs',
            'tourCategory',
            'contentBlock',
            'subCategories',
            'facilities',
            'inclusions',
            'metaHeadings'
        ])

            ->whereHas('tourCategory', fn($q) => $q->where('slug', $slug))
            ->firstWhere('slug', $subslug);


        if ($subslug && !$tour) {
            abort(404, 'Page not found.');
        }
        $tours = TourPackages::where('category_id', $tour->category_id)
            ->select('package_name', 'slug')
            ->get();

        if ($category) {
            $cat = $tour->subCategories->firstWhere('id', $categories->id);
        } else {
            $cat = $tour->subCategories->sortBy('rating')->first();
        }
        $inputs = $request->all();
        $categories = $cat;
        $searchHash = !empty($inputs) ? md5(json_encode($inputs)) : null;
        $reviews = GoogleReview::orderBy('review_date', 'DESC')->where('comment', '!=', null)->where('rating', 5)->take(10)->get();
        $review_images = ReviewImage::all();

        $review = GoogleReview::all();
        $rating = [
            'total_reviews' => $review->count(),
            'average_rating' => $review->avg('rating'),
            '5' => $review->where('rating', 5)->count(),
            '4' => $review->where('rating', 4)->count(),
            '3' => $review->where('rating', 3)->count(),
            '2' => $review->where('rating', 2)->count(),
            '1' => $review->where('rating', 1)->count(),
        ];


        return view('tours.package', compact('tour', 'categories', 'cat', 'tours', 'reviews', 'review_images', 'rating'));
    }



    public function static(string $slug, string $subslug = null)
    {
        $category = Category::with('metaHeadings', 'categorySection', 'faqs')->where('slug', $slug)->where('type', 'tour')->first();
        if ($slug == 'best-seller') {
            $tour = TourPackages::with([
                'tourPhotos',
                'tourCategory',
                'facilities',
                'faqs',
                'subCategories'
            ])->whereHas('tourCategory', function ($query) use ($slug) {
                $query->where('type', 'tour');
            })->first();


            $categories = Category::where('type', 'tour')->pluck('id');

            $tours = TourPackages::with(['tourPhotos', 'tourCategory', 'subCategories'])
                ->whereIn('category_id', $categories)
                ->where('status', 1)
                ->where('best_seller', 1)
                ->get()
                ->groupBy('category_id')
                ->map(function ($group) {
                    return $group->random(1)->first();
                })
                ->values();
        } else {
            $tour = TourPackages::with([
                'tourPhotos',
                'tourCategory',
                'facilities',
                'faqs',
                'subCategories'
            ])
                ->whereHas('tourCategory', function ($query) use ($slug) {
                    $query->where('type', 'tour')
                        ->where('slug', $slug);
                })
                ->first();


            $tours = TourPackages::with(['tourPhotos', 'tourCategory', 'subCategories'])
                ->whereHas('tourCategory', function ($query) use ($slug) {
                    $query->where('type', 'tour')
                        ->where('slug', '!=', 'best-seller')
                        ->where('slug', $slug);
                })
                ->where('status', 1)
                ->inRandomOrder()
                ->get();
        }




        $tours->each(function ($tour) {
            $tour->start_price = optional($tour->subCategories->first())->pivot_starts_from ?? $tour->package_cost;
        });

        $reviews = GoogleReview::orderBy('review_date', 'DESC')->where('comment', '!=', null)->where('rating', 5)->take(10)->get();
        $review_images = ReviewImage::all();

        $review = GoogleReview::all();
        $rating = [
            'total_reviews' => $review->count(),
            'average_rating' => $review->avg('rating'),
            '5' => $review->where('rating', 5)->count(),
            '4' => $review->where('rating', 4)->count(),
            '3' => $review->where('rating', 3)->count(),
            '2' => $review->where('rating', 2)->count(),
            '1' => $review->where('rating', 1)->count(),
        ];

        return view("tours.main")->with(compact('tour',  'tours', 'category', 'reviews', 'rating', 'review_images'));
    }




    public function devstatic(string $slug, string $subslug = null)
    {
        $tour = Service::with(['tourPhotos', 'tourCategory', 'facilities', 'policies', 'faqs', 'reviews', 'addons'])
            ->whereHas('tourCategory', function ($query) use ($slug) {
                $query->where('type', 'tour')
                    ->where('slug', $slug);
            })
            ->where('type', 'tour')->first();


        $addons = Addon::with(['addonPhotos'])->get();
        if ($tour && $tour->addons) {
            $addonIds = explode(',', $tour->addons);
            $tour->addon_names = Addon::whereIn('id', $addonIds)->get();
        }
        $tours = Service::with(['tourPhotos', 'tourCategory', 'addons'])
            ->whereHas('tourCategory', function ($query) use ($slug) {
                $query->where('type', 'tour')
                    ->where('slug', $slug);
            })->where('status',)
            // ->whereNot('slug', $subslug)
            ->inRandomOrder()
            ->get();
        $page = $tour->category->slug ?? 'default';
        return view("pages.dev.tours.static.$page.index")
            ->with(compact('tour', 'addons', 'tours'));
    }



    public function customBooking(Request $request)
    {
        if ($request->isMethod('post')) {

            if (!empty($request->website)) {
                return back()->with('error', 'Spam detected. Submission blocked.');
            }


            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'mobile' => 'required|numeric|integer|digits:10',
                'email' => 'required|email|max:255',
                'package' => [
                    'sometimes',
                    'string',
                    'max:255',
                    Rule::in(Category::where('type', 'tour')
                        ->pluck('slug')
                        ->toArray()),
                ],
                'hotel' => [
                    'sometimes',
                    'string',
                    'max:255',
                    Rule::in(Category::where('type', 'hotel')
                        ->pluck('slug')
                        ->toArray()),
                ],
                'flight' => 'sometimes|string|max:255|in:have,need',
                'duration' => 'sometimes|string|max:255',
                'checkin' => 'sometimes|date|date_format:d-m-Y|after_or_equal:' . date('Y-m-d'),
                'adult' => 'required|numeric|integer',
                'child' => 'sometimes|nullable|numeric|integer',
                'min' => 'sometimes|nullable|numeric|integer',
                'max' => 'sometimes|nullable|numeric|integer',
                'message' => 'sometimes|nullable',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $lead = new Lead;
            $lead->name = $request->name;
            $lead->mobile = $request->mobile;
            $lead->email = $request->email;
            $lead->package_type = $request->package;
            $lead->hotel_type = $request->hotel;
            $lead->flight_ticket = $request->flight;
            $lead->lead_source = 'direct';
            $lead->duration = $request->duration;
            $lead->travel_start = date('Y-m-d', strtotime($request->checkin));
            $lead->adult = $request->adult;
            $lead->child = $request->child;
            $lead->price_min = $request->min;
            $lead->price_max = $request->max;
            $lead->details = $request->message;
            $lead->save();

            $mailData['subject'] = $request->subject ?? 'Contact Form';
            $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
            $mailData['name'] = env('MAIL_FROM_NAME', 'AndamanBliss');
            $mailData['body'] = "";
            if ($request->name) {
                $mailData['body'] .= "Name: {$request->name}<br/>";
            }
            if ($request->mobile) {
                $mailData['body'] .= "Mobile: {$request->mobile}<br/>";
            }
            if ($request->email) {
                $mailData['body'] .= "Email: {$request->email}<br/>";
            }
            if ($request->package) {
                $mailData['body'] .= "Package Type: {$request->package}<br/>";
            }
            if ($request->hotel) {
                $mailData['body'] .= "Hotel Type: {$request->hotel}<br/>";
            }
            if ($request->flight) {
                $mailData['body'] .= "Flight Ticket: {$request->flight}<br/>";
            }
            if ($request->duration) {
                $mailData['body'] .= "Duration: {$request->duration} Days<br/>";
            }
            if ($request->checkin) {
                $mailData['body'] .= "Travel Start: {$request->checkin}<br/>";
            }
            if ($request->adult) {
                $mailData['body'] .= "Adult: {$request->adult}<br/>
                                    Child: {$request->child}<br/>";
            }
            if ($request->min) {
                $mailData['body'] .= "Price: {$request->min} - {$request->max}<br/>";
            }
            if ($request->message) {
                $mailData['body'] .= "Message:<br/>
                                    {$request->message}";
            }
            // $mailData['url'] = url('login');
            // $mailData['button'] = 'Login';
            // $mailData['subbody'] = "You can also use your registered email & mobile as username.";
            $mailData['info'] = 'Note: don\'t share your login credentials & keep it confedential.';

            \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
                $message->subject($mailData['subject'])
                    ->to('amitmandal@andamanbliss.com')
                    ->cc(['shivakumar@andamanbliss.com']);
            });

            if ($request->ajax()) {
                $statusCode = 200;
                return response()->json([
                    'status' => $statusCode,
                    'message' => __('Enquiry form submitted successfully!'),
                    'data' => $mailData,
                ], $statusCode);
            }

            return back()
                ->with('success', __('Enquiry form submitted successfully!'));
        }

        $duration = [
            '2-3' => 'Quick Trip',
            '4-6' => 'Short Trip',
            '7-10' => 'Week Tour',
            '10+' => 'Long Trip'
        ];

        $hotels = Category::where('type', 'hotel')
            ->get();

        $packages = Category::where('type', 'tour')
            ->get();

        $flights = [
            'have' => 'I already have flight tickets',
            'need' => 'I need flight tickets'
        ];

        return view('tours.custom-booking')->with(compact('duration', 'hotels', 'packages', 'flights'));
    }


    public function dynamica(Request $request, TboHotelService $tbohotelservice)
    {
        $category = $request->route('category');
        $slug = $request->route('slug');
        $subslug = $request->route('subslug');

        if (!$slug || !$subslug) {
            abort(404);
        }
        dd([
            'category' => $category,
            'slug' => $slug,
            'subslug' => $subslug,
        ]);
    }



    public function itinerary(Request $request, TboHotelService $tbohotelservice)
    {

        // dd($request->method());
        $package = $request->input('package') ?? null;

        $data = $request->all();

        $inputs = [];

        if (!empty($data['inputs'])) {
            if (is_string($data['inputs'])) {
                $decoded = json_decode($data['inputs'], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $inputs = $decoded;
                    $inputs['package'] = $package;
                }
            } elseif (is_array($data['inputs'])) {
                $inputs = $data['inputs'];
            }
        } else {
            $inputs = $request->only(['travel_date', 'PaxRooms', 'package']);
        }



        if ($request->isMethod('get')) {
            return redirect()->route('tour.static', [
                'category' => $request->route('category'),
                'slug' => $request->route('slug'),
                'subslug' => $request->route('subslug')
            ])->with('message', 'Redirected to POST logic');
        }


        $category = $request->route('category');
        $slug = $request->route('slug') ?? $package;
        $subslug = $request->route('subslug');
        $priceBreakdown = [];
        $livebook = 1;

        $totalCosts = 0;
        $guests = [];
        $vehicleMap = [
            'four_seater_sedan' => 4,
            'six_seater_xylo_ertiga' => 6,
            'seven_seater_innova_hexa_marazzo' => 7,
            'twelve_seater_winger' => 12,
            'seventeen_seater_tempo' => 17,
            'twenty_six_seater_tempo_traveller' => 26,
        ];

        $categories = null;
        if (!empty($category)) {
            $categories = subCategories::where('name', $category)->first();
        }


        $tour = TourPackages::with([
            'tourPhotos',
            'TourItinerary',
            'TourItinerary.transfers',
            'TourItinerary.activities.activity',
            'TourItinerary.services',
            'faqs',
            'tourCategory',
            'contentBlock',
            'subCategories',
            'facilities',
            'inclusions',
            'metaHeadings'
        ])

            ->whereHas('tourCategory', fn($q) => $q->where('slug', $slug))
            ->firstWhere('slug', $subslug);


        if ($subslug && !$tour) {
            abort(404, 'Page not found.');
        }

        if ($category) {
            $cat = $tour->subCategories->firstWhere('id', $categories->id);
        } else {
            $cat = $tour->subCategories->sortBy('rating')->first();
        }

        $tours = TourPackages::where('category_id', $tour->category_id)
            ->select('package_name', 'slug')
            ->get();


        $makWallet = $this->makruzzApiService->getBalance();
        $tboWallet = $tbohotelservice->getWalletBalance();

        $categories = $cat;
        $searchHash = !empty($inputs) ? md5(json_encode($inputs)) : null;
        $itineraries = [];
        if (!empty($inputs)) {
            if (empty($inputs['travel_date'])) {
                return Redirect::back()
                    ->withInput()
                    ->withErrors(['travel_date' => 'Please select a travel date.']);
            }

            if (empty($inputs['PaxRooms']) || !is_array($inputs['PaxRooms'])) {

                return Redirect::back()
                    ->withInput()
                    ->withErrors(['guests' => 'Please select rooms and guests.']);
            }
            $startDate = Carbon::parse($inputs['travel_date']);
            $guests = $inputs['PaxRooms'];


            $hotelCacheKey = 'hotel_search_' . $tour->id . '_' . $searchHash;
            $cachedHotels = session($hotelCacheKey, null);
            $currentTime = now()->timestamp;
            $sessionKey = 'selected_hotels_' . $tour->id . '_' . $searchHash;
            $selectedBookingCodes = session($sessionKey, []);


            $itineraries = $tour->TourItinerary->map(function ($item, $index) use ($startDate, $guests, $tour, $tbohotelservice, $cachedHotels, $hotelCacheKey, $selectedBookingCodes, $currentTime, $categories) {
                $date = $startDate->copy()->addDays($index)->format('d-m-Y');
                $hotels = collect();
                $selectedHotel = null;
                $hotelTotal = 0;

                if ($index < $tour->nights) {
                    $selectedHotel = null;
                    $cacheKey = $item->accommodation . '_' . $date . '_' . md5(json_encode($guests));

                    if ($cachedHotels && isset($cachedHotels[$index]['cached_at']) && ($currentTime - $cachedHotels[$index]['cached_at'] <= 120)) {
                        $hotels = collect($cachedHotels[$index]['data']);
                    } elseif (isset($accommodationCache[$cacheKey])) {
                        $hotels = $accommodationCache[$cacheKey];
                    } else {
                        $catId = $categories->id ?? optional($tour->subCategories->first())->id;
                        $accommodationName = is_string($item->accomodation_name)
                            ? json_decode($item->accomodation_name, true) ?? []
                            : ($item->accomodation_name ?? []);
                        $categoryHotels = $accommodationName[$catId] ?? [];
                        $req = (object) [
                            'location' => $item->accommodation,
                            'checkin_date' => $date,
                            'guests' => $guests,
                            'hotel_codes' => $categoryHotels
                        ];
                        $hotels = $this->SearchAccomodation($req, $tbohotelservice);
                        $accommodationCache[$cacheKey] = $hotels;
                        $cachedHotels[$index] = [
                            'data' => $hotels->all(),
                            'cached_at' => $currentTime
                        ];
                        session([$hotelCacheKey => $cachedHotels]);
                    }

                    if (isset($selectedBookingCodes[$index])) {
                        $selectedBookingCode = $selectedBookingCodes[$index];
                        foreach ($hotels as $hotel) {
                            $room = collect($hotel['other_rooms'] ?? [])->firstWhere('BookingCode', $selectedBookingCode);
                            if ($room) {
                                $selectedHotel = $hotel;
                                $selectedHotel['selected_room'] = $room;
                                break;
                            }
                        }
                    }

                    if (!$selectedHotel && $hotels->isNotEmpty()) {
                        $catId = $categories->id ?? optional($tour->subCategories->first())->id;
                        $accommodationName = is_string($item->accomodation_name)
                            ? json_decode($item->accomodation_name, true) ?? []
                            : ($item->accomodation_name ?? []);
                        $categoryHotels = $accommodationName[$catId] ?? [];

                        $matchingHotels = $hotels->filter(fn($hotel) => in_array($hotel['hotel_code'], $categoryHotels ?? []));

                        if ($matchingHotels->isEmpty() && $categories->rating) {
                            $ratingHotels = $hotels->filter(fn($hotel) => ($hotel['hotel_rating'] ?? 0) == $categories->rating);
                            $selectedHotel = $ratingHotels->isNotEmpty() ? $ratingHotels : $hotels;
                        } else {
                            $selectedHotel = $matchingHotels->isNotEmpty() ? $matchingHotels : $hotels;
                        }

                        $selectedHotel = collect($selectedHotel)
                            ->sortBy(fn($hotel) => $hotel['selected_room']['DayRates'][0][0]['BasePrice'] ?? PHP_INT_MAX)
                            ->first();
                    }

                    if ($selectedHotel && isset($selectedHotel['selected_room']['TotalFare'])) {
                        $hotelTotal += $selectedHotel['selected_room']['TotalFare'];
                    }
                }

                $ferryServices = [];
                $ferryTotal = 0;

                $adultCount = 0;
                $childCount = 0;
                foreach ($guests as $room) {
                    $adults = (int) ($room['Adults'] ?? 0);
                    $children = (int) ($room['Children'] ?? 0);
                    $childrenAges = $room['ChildrenAges'] ?? [];

                    foreach ($childrenAges as $age) {
                        if ((int) $age < 2) {
                            $adults++;   // count infant as adult for fare/booking
                            $children--; // remove infant from children count
                        }
                    }

                    $adultCount += $adults;
                    $childCount += $children;
                }

                if ($item->transfers && $index < $tour->nights) {
                    foreach ($item->transfers as $transfer) {
                        $ferryRequest = new Request([
                            'from_location' => $transfer->from,
                            'to_location' => $transfer->to,
                            'time' => $transfer->time,
                            'travel_date' => $date,
                            'adult' => $adultCount ?: 1,
                            'infant' => $childCount ?: 0,
                        ]);

                        $ferryResponse = $this->FerrySearch($ferryRequest);
                        $ferryData = collect($ferryResponse->getData()->ferry ?? []);
                        $selectedFerry = $ferryData->sortBy('departure')->first();
                        $ferryCost = 0;

                        if ($selectedFerry) {
                            $selectedClass = $selectedFerry->selected_class ?? ($selectedFerry->classes[0] ?? null);

                            if ($selectedClass) {
                                $adultFare  = ($selectedClass->adult_seat_rate ?? $selectedClass->fare ?? 0);
                                $infantFare = $selectedFerry->infant_fare ?? 0;
                                $portFee    = $selectedFerry->port_fee ?? 0;

                                $ferryCost = ($adultFare * $adultCount) + ($infantFare * $childCount);
                                $ferryCost += ($portFee * $adultCount);
                            }

                            $ferryTotal += $ferryCost;
                        }

                        $ferryServices[] = [
                            'from' => $transfer->from,
                            'to' => $transfer->to,
                            'date' => $date,
                            'adult_count' => $adultCount,
                            'child_count' => $childCount,
                            'adult_fare' => $adultFare ?? 0,
                            'infant_fare' => $infantFare ?? 0,
                            'ferry_cost' => $ferryCost,
                            'selected_ferry' => $selectedFerry,
                            'ferries' => $ferryData,
                        ];
                    }
                }

                $activities = $item->activities->map(function ($activity) use ($adultCount, $childCount) {
                    $basePrice = floatval($activity->price);
                    $adultCost = $basePrice * $adultCount;
                    $childCost = $basePrice * $childCount;
                    return [
                        'name' => $activity->activity->service_name,
                        'description' => $activity->activity->description,
                        'location' => $activity->activity->location,
                        'price_per_person' => $basePrice,
                        'adult_count' => $adultCount,
                        'child_count' => $childCount,
                        'adult_total' => $adultCost,
                        'child_total' => $childCost,
                        'total' => $adultCost + $childCost,
                    ];
                })->toArray();

                $activityTotal = array_sum(array_column($activities, 'total'));

                $vehicleCost = 0;
                $serviceDetails = [];
                if ($item->services) {
                    $vehicleRate = floatval($item->services->six_seater_xylo_ertiga ?? 0);
                    $vehicleCost = $vehicleRate * 1;
                    $serviceDetails = [

                        'service_location' => $item->services->service_location ?? 'N/A',
                        'description' => $item->services->service ?? 'No service description',
                        'day_schedule' => $item->services->day_schedule ?? 'N/A',
                        'vehicle_cost' => $vehicleCost
                    ];
                }
                $serviceTotal = $vehicleCost;

                return [
                    'dayNumber' => $item->day,
                    'date' => $date,
                    'guest' => $guests,
                    'title' => $item->title,
                    'description' => $item->description,
                    'accommodation' => $selectedHotel,
                    'hotels' => $hotels,
                    'ferries' => $ferryServices,
                    'activities' => $activities,
                    'services' => $serviceDetails,
                    'totals' => [
                        'hotelTotal' => $hotelTotal,
                        'ferryTotal' => $ferryTotal,
                        'activityTotal' => $activityTotal,
                        'serviceTotal' => $serviceTotal,
                        'dayTotal' => $hotelTotal + $ferryTotal + $activityTotal + $serviceTotal
                    ]
                ];
            })->toArray();

            $totalCostsSum = array_sum(array_map(fn($day) => $day['totals']['dayTotal'], $itineraries));
            $selectedSubcategory = $cat;


            $markup = (float) ($selectedSubcategory->pivot->markup ?? 0);
            $discount = (float) ($selectedSubcategory->pivot->discount ?? 0);
            $discountAbove = (float) ($selectedSubcategory->pivot->discount_above ?? 0);

            $totalWithMarkup = $totalCostsSum + ($totalCostsSum * $markup / 100);

            if ($discount > 0 && $totalWithMarkup >= $discountAbove) {
                $totalWithDiscount = $totalWithMarkup - ($totalWithMarkup * $discount / 100);
            } else {
                $totalWithDiscount = $totalWithMarkup;
            }

            $gstRate = 0.07;
            $gstAmount = $totalWithDiscount * $gstRate;
            $totalCosts = $totalWithDiscount + $gstAmount;
            $priceBreakdown = [
                'base_total' => round($totalCostsSum, 2),
                'markup' => round($markup, 2),
                'total_with_markup' => round($totalWithMarkup, 2),
                'discount' => round($discount, 2),
                'discount_above' => round($discountAbove, 2),
                'total_with_discount' => round($totalWithDiscount, 2),
                'gst_rate' => round($gstRate * 100, 2),
                'gst_amount' => round($gstAmount, 2),
                'grand_total' => round($totalCosts, 2),
            ];
        }

        $itineraryDaysInfo = [];

        foreach ($tour->TourItinerary as $index => $day) {
            $itineraryDaysInfo[$index + 1] = [
                'has_accommodation_available' => !empty($day->accommodation),
                'has_ferry_available' => $day->transfers && $day->transfers->isNotEmpty(),
                'has_accommodation_selected' => false,
                'has_ferry_selected' => false,
            ];
        }


        foreach ($itineraries as $day) {
            $dayNumber = $day['dayNumber'];
            $hasAccommodationSelected = !empty($day['accommodation']);
            $hasFerrySelected = false;
            foreach ($day['ferries'] as $ferry) {
                if (!empty($ferry['selected_ferry'])) {
                    $hasFerrySelected = true;
                    break;
                }
            }
            if (isset($itineraryDaysInfo[$dayNumber])) {
                $itineraryDaysInfo[$dayNumber]['has_accommodation_selected'] = $hasAccommodationSelected;
                $itineraryDaysInfo[$dayNumber]['has_ferry_selected'] = $hasFerrySelected;
            }
        }



        $totalFerry = array_sum(array_map(fn($day) => $day['totals']['ferryTotal'] ?? 0, $itineraries));
        $totalHotel = array_sum(array_map(fn($day) => $day['totals']['hotelTotal'] ?? 0, $itineraries));

        $totalActivity   = array_sum(array_column(array_column($itineraries, 'totals'), 'activityTotal'));
        $totalService    = array_sum(array_column(array_column($itineraries, 'totals'), 'serviceTotal'));


        $hotelcost = $totalHotel * 1.05;
        $ferrycost = $totalFerry * 1.05;


        $withouthotelCost = $totalService + $totalActivity + $totalFerry;
        $wmark = ($withouthotelCost * $markup / 100);
        $whcost = $wmark + $withouthotelCost;

        $allDaysSelected = array_reduce($itineraryDaysInfo, function ($carry, $day) {
            $accommodationOk = !$day['has_accommodation_available'] || $day['has_accommodation_selected'];
            $ferryOk = !$day['has_ferry_available'] || $day['has_ferry_selected'];
            return $carry && $accommodationOk && $ferryOk;
        }, true);

        $livebook = ($makWallet >= $ferrycost && $tboWallet >= $hotelcost && $allDaysSelected) ? 1 : 0;


        $reviews = GoogleReview::orderBy('review_date', 'DESC')->where('comment', '!=', null)->where('rating', 5)->take(10)->get();
        $review_images = ReviewImage::all();

        $review = GoogleReview::all();
        $rating = [
            'total_reviews' => $review->count(),
            'average_rating' => $review->avg('rating'),
            '5' => $review->where('rating', 5)->count(),
            '4' => $review->where('rating', 4)->count(),
            '3' => $review->where('rating', 3)->count(),
            '2' => $review->where('rating', 2)->count(),
            '1' => $review->where('rating', 1)->count(),
        ];

           

        return view('tours.show')->with(compact('tour', 'itineraries', 'tours', 'inputs', 'totalCosts', 'guests', 'cat', 'priceBreakdown', 'livebook', 'reviews', 'review_images', 'rating', 'hotelcost', 'whcost'));
    }






    protected function getLocationId($location)
    {
        $locations = [
            'Port Blair' => 1,
            'Swaraj Dweep' => 2,
            'Shaheed Dweep' => 3,
        ];
        return $locations[$location] ?? null;
    }



    public function SearchAccomodation($daAaccomodationReq, TboHotelService $tbohotelservice)
    {
        $cacheKey = 'accommodation_search_' . md5(json_encode([
            'location' => $daAaccomodationReq->location,
            'checkin_date' => $daAaccomodationReq->checkin_date,
            'guests' => $daAaccomodationReq->guests,
        ]));

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($daAaccomodationReq, $tbohotelservice) {
            $HotelCodes = Hotel::where(function ($query) use ($daAaccomodationReq) {
                $query->where('city_name', 'like', '%' . $daAaccomodationReq->location . '%')
                    ->orWhere('address', 'like', '%' . $daAaccomodationReq->location . '%');
            })
                ->where('status', 1)
                ->pluck('hotel_code')
                ->toArray();

            $chunks = array_chunk($HotelCodes, 100);

            $paxRooms = collect($daAaccomodationReq->guests ?? [])->map(function ($room) {
                return [
                    'Adults' => (int) $room['Adults'],
                    'Children' => (int) $room['Children'],
                    'ChildrenAges' => isset($room['ChildrenAges']) && is_array($room['ChildrenAges'])
                        ? array_map('intval', $room['ChildrenAges'])
                        : null
                ];
            })->toArray();

            $roomCount = count($paxRooms);
            $checkin = \Carbon\Carbon::parse($daAaccomodationReq->checkin_date);
            $checkout = $checkin->copy()->addDay();

            $payload = [
                'CheckIn' => $checkin->format('Y-m-d'),
                'CheckOut' => $checkout->format('Y-m-d'),
                'GuestNationality' => 'IN',
                'PaxRooms' => $paxRooms,
                'ResponseTime' => 23.0,
                'IsDetailedResponse' => true,
                'Filters' => [
                    'Refundable' => true,
                    'NoOfRooms' => $roomCount > 1 ? $roomCount : 0,
                    'MealType' => 'BreakFast',
                    'OrderBy' => 0,
                    'StarRating' => 0,
                    'HotelName' => null
                ]
            ];

            $allResponses = $tbohotelservice->searchMultipleChunksParallel($chunks, $payload);

            $allHotels = collect($allResponses)->flatMap(function ($response) use ($payload) {
                if (!isset($response['Status']['Code']) || $response['Status']['Code'] !== 200) {
                    return collect();
                }
                if (!isset($response['HotelResult']) || empty($response['HotelResult'])) {
                    return collect();
                }
                return $this->mapApiResults($response, [
                    'checkin' => $payload['CheckIn'],
                    'checkout' => $payload['CheckOut'],
                    'PaxRooms' => $payload['PaxRooms'],
                ]);
            });

            return $allHotels;
        });
    }



    private function mapApiResults(array $response, array $params)
    {
        if (!isset($response['HotelResult']) || empty($response['HotelResult'])) {
            return collect();
        }

        $hotelResults = collect($response['HotelResult']);
        $hotelCodes = $hotelResults->pluck('HotelCode')->toArray();
        $dbHotels = Hotel::whereIn('hotel_code', $hotelCodes)->get()->keyBy('hotel_code');

        return $hotelResults->map(function ($hotelData) use ($dbHotels, $params) {
            $code = $hotelData['HotelCode'];
            $rooms = $hotelData['Rooms'] ?? [];

            $sortedRooms = collect($rooms)->sortBy(function ($room) {
                return $room['DayRates'][0][0]['BasePrice'] ?? PHP_INT_MAX;
            })->values();

            $cheapestRoom = $sortedRooms->first();
            $dbHotel = $dbHotels[$code] ?? null;
            $gallery = !empty($dbHotel?->hotel_gallery) ? json_decode($dbHotel->hotel_gallery, true) : [];
            $firstGalleryImage = !empty($gallery[0]) ? $gallery[0] : null;
            return [
                'hotel_code' => $code,
                'hotel_name' => $dbHotel?->hotel_name ?? 'N/A',
                'hotel_image' => !empty($dbHotel?->hotel_image) ? $dbHotel->hotel_image : ($firstGalleryImage ?: asset('site/img/hotel_image.png')),
                'slug' => $dbHotel?->slug,
                'hotel_rating' => $dbHotel?->hotel_rating,
                'star_count' => match ($dbHotel?->hotel_rating) {
                    'OneStar' => 1,
                    'TwoStar' => 2,
                    'ThreeStar' => 3,
                    'FourStar' => 4,
                    'FiveStar', 'All' => 5,
                    default => null,
                },
                'city_name' => $dbHotel?->city_name,
                'description' => $dbHotel?->description,
                'address' => $dbHotel?->address,
                'booking_code' => $cheapestRoom['BookingCode'] ?? null,
                'total_fare' => $cheapestRoom['TotalFare'] ?? null,
                'total_tax' => $cheapestRoom['TotalTax'] ?? null,
                'base_price' => $cheapestRoom['DayRates'][0][0]['BasePrice'] ?? null,
                'room_name' => $cheapestRoom['Name'][0] ?? null,
                'inclusion' => $cheapestRoom['Inclusion'] ?? null,
                'promotion' => $cheapestRoom['RoomPromotion'][0] ?? null,
                'is_refundable' => $cheapestRoom['IsRefundable'] ?? null,
                'meal_type' => $cheapestRoom['MealType'] ?? null,
                'other_rooms' => $rooms,
                'selected_room' => $cheapestRoom,
                'query' => [
                    'checkin' => $params['checkin'] ?? null,
                    'checkout' => $params['checkout'] ?? null,
                    'room' => $params['room'] ?? null,
                    'adult' => $params['adult'] ?? null,
                    'child' => $params['child'] ?? null,
                    'childAge' => $params['childAge'] ?? [],
                    'PaxRooms' => $params['PaxRooms'] ?? [],
                ]
            ];
        });
    }


    private function normalizeLocation($location)
    {
        $location = strtolower(trim($location));

        if (in_array($location, ['port blair arrival', 'port blair'])) {
            return 'Port Blair';
        }

        if (in_array($location, ['havelock', 'havelock island'])) {
            return 'Swaraj Dweep';
        }

        if (in_array($location, ['neil', 'neil island'])) {
            return 'Shaheed Dweep';
        }

        return $location; // fallback if no match
    }



    protected function FerrySearch(Request $request)
    {
        $from_location = $this->normalizeLocation($request->from_location);
        $to_location = $this->normalizeLocation($request->to_location);
        $travel_date = $request->travel_date;
        $time = $request->time;
        $adult = $request->adult;
        $child = $request->infant;
        $no_of_passenger = $adult + ($child ?? 0);

        $makruzzData = [
            'trip_type' => 'single_trip',
            'from_location' => $this->getLocationId($from_location),
            'to_location' => $this->getLocationId($to_location),
            'no_of_passenger' => $no_of_passenger,
            'travel_date' => Carbon::parse($travel_date)->format('Y-m-d'),
        ];

        $makruzzFerryData = [];
        try {
            $makruzzFerry = $this->makruzzApiService->searchSchedule($makruzzData);
            $makruzzFerryData = $makruzzFerry['data'] ?? [];
        } catch (\Exception $e) {
        }
        Log::info('Makruzz Ferry Search', [
            'request' => $makruzzData,
            'response' => $makruzzFerryData
        ]);
        $Mak = [];
        foreach ($makruzzFerryData as $trip) {
            $key = $trip['departure_time'] . $trip['arrival_time'] . $trip['ship_title'] . $trip['id'];
            if (!isset($Mak[$key])) {
                $Mak[$key] = [
                    'departure' => date('h:i A', strtotime($trip['departure_time'])),
                    'arraival' => date('h:i A', strtotime($trip['arrival_time'])),
                    'ferry_name' => $trip['ship_title'],
                    'ferry_id' => $trip['ship_id'],
                    'route_id' => $trip['id'],
                    'seat_available' => $trip['seat'],
                    'adult_seat_rate' => $trip['ship_class_price'],
                    'port_fee' => $trip['psf'] ?? 0,
                    'fare' => $trip['ship_class_price'],
                    'image' => 'https://andamanbliss.com/site/logos/mak-fleet.jpg',
                    'from' => $trip['source_name'],
                    'to' => $trip['destination_name'],
                    'Provider' => 3,
                    'departDate' => $travel_date,
                    'adult' => $adult,
                    'infant' => $child ?? 0,
                    'trip_id' => $trip['id'],
                    'infant_fare' => 0,
                    'has_seat' => 0,
                    'classes' => [],
                    'service_provider' => 'Makruzz'
                ];
            }
            $Mak[$key]['classes'][] = [
                'class_name' => $trip['ship_class_title'],
                'class_id' => $trip['ship_class_id'],
                'seat_available' => $trip['seat'],
                'adult_seat_rate' => $trip['ship_class_price'],
            ];
        }

        $getPrice = function ($class) {
            if (!is_array($class))
                return 0.0;
            return (float) (
                $class['fare'] ??
                $class['adult_seat_rate'] ??
                $class['ship_class_price'] ??
                $class['class_price'] ??
                $class['price'] ??
                0
            );
        };

        $cutoffTime = strtotime($time);
        $ferries = array_filter($Mak, fn($ferry) => strtotime($ferry['departure']) > $cutoffTime);
        usort($ferries, fn($a, $b) => strtotime($a['departure']) <=> strtotime($b['departure']));

        $selectedFerry = null;
        foreach ($ferries as &$ferry) {
            if (!empty($ferry['classes']) && is_array($ferry['classes'])) {
                $availableClasses = array_filter($ferry['classes'], fn($c) => ($c['seat_available'] ?? 0) > 0);
                if (!empty($availableClasses)) {
                    usort($availableClasses, fn($a, $b) => $getPrice($a) <=> $getPrice($b));
                    $ferry['all_classes'] = $ferry['classes'];
                    $ferry['selected_class'] = $availableClasses[0];
                    $selectedFerry = $ferry;
                    break;
                }
            } else if (($ferry['seat_available'] ?? 0) > 0) {
                $fallbackFare = (float) ($ferry['fare'] ?? $ferry['adult_seat_rate'] ?? $ferry['ship_class_price'] ?? 0);
                $ferry['all_classes'] = [['fare' => $fallbackFare]];
                $ferry['selected_class'] = ['fare' => $fallbackFare];
                $selectedFerry = $ferry;
                break;
            }
        }
        unset($ferry);

        return response()->json([
            'ferry' => $selectedFerry ? [$selectedFerry] : []
        ]);
    }



    public function storeTempItinerary(Request $request)
    {

        // return response()->json(['response' => $request->all()]);

        try {
            $tourId = $request->input('tour_id');
            $category = $request->input('category');
            $wh = $request->input('wh');
            $guests = json_decode($request->input('guests'), true);
            $searchHash = (string) rand(10000, 99999);
            $itinerary = json_decode($request->input('itinerary'), true);
            $priceBreakdown = json_decode($request->input('pricing'), true);
            $travelDate = $itinerary[0]['day']['date'];
            $payment_break = PaymentBreakups::get();
            // Clear existing records for this tour + hash
            TempItinerary::where('tour_id', $tourId)
                ->where('search_hash', $searchHash)
                ->delete();

            foreach ($itinerary as $day) {
                $accommodation = $day['accommodation'] ?? null;
                $dayInfo = $day['day'] ?? [];
                TempItinerary::create([
                    'tour_id' => $tourId,
                    'user_id' => auth()->user()->id ?? '',
                    'category' => $category,
                    'guest' => json_encode($guests),
                    'day_index' => $dayInfo['dayNumber'] ?? null,
                    'hotel_code' => $accommodation['hotel_code'] ?? null,
                    'room_booking_code' => $accommodation['room_booking_code'] ?? null,
                    'room_name' => json_encode($accommodation['room_name'] ?? null),
                    'base_price' => $accommodation['base_price'] ?? 0,
                    'hotel_cost' => $day['dayHotelTotal'] ?? 0,
                    'ferry_total' => $day['dayFerryTotal'] ?? 0,
                    'activity_total' => $day['dayActivityTotal'] ?? 0,   // ✅ Added
                    'service_total' => $day['dayServiceTotal'] ?? 0,
                    'day_total' => $day['dayTotal'] ?? 0,          // ✅ Added
                    'ferry' => !empty($day['ferries']) ? json_encode($day['ferries']) : null,
                    'search_hash' => $searchHash,
                    'start_date' => !empty($dayInfo['date']) ? \Carbon\Carbon::createFromFormat('d-m-Y', $dayInfo['date'])->format('Y-m-d') : null,
                    'status' => 1,
                    'wh' => $wh,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }


            $today = Carbon::now()->startOfDay();
            $travel_date = $travelDate;

            $diff = $today->diffInDays($travel_date);
            $diffDays = $diff + 1;

            $totalAmount = $priceBreakdown['grand_total'];


            $payment_break = PaymentBreakups::get();
            $defaultPayment = $payment_break->firstWhere('days', 0);

            $matchingPayment = $payment_break->filter(fn($payment) => $payment->days > 0 && $diffDays <= $payment->days)
                ->sortBy('days')
                ->first();

            if (!$matchingPayment && $defaultPayment) {
                $matchingPayment = $defaultPayment;
            }


            $paypercent = $matchingPayment['percent'];
            $payable = ($totalAmount * $paypercent) / 100;
            $balance_amt = $totalAmount - $payable;

            PackagePricing::create([
                'package_id' => $tourId,
                'base_total' => $priceBreakdown['base_total'],
                'search_hash' => $searchHash,
                'markup' => $priceBreakdown['markup'],
                'total_with_markup' => $priceBreakdown['total_with_markup'],
                'discount' => $priceBreakdown['discount'],
                'discount_above' => $priceBreakdown['discount_above'],
                'total_with_discount' => $priceBreakdown['total_with_discount'],
                'gst_rate' => $priceBreakdown['gst_rate'],
                'gst_amount' => $priceBreakdown['gst_amount'],
                'grand_total' => $priceBreakdown['grand_total'],
                'days_diff' => $diffDays,
                'paying_percent' => $paypercent,
                'payable_amt' => $payable,
                'balance_amt' => $balance_amt,
            ]);


            return response()->json([
                'status' => 'success',
                'search_hash' => $searchHash
            ]);
        } catch (\Exception $e) {
            \Log::error('Itinerary insert failed', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function bookNow(Request $request, TboHotelService $tboHotelService)
    {
        $logged = null;
        if (auth()->check()) {
            $logged = [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->mobile,
            ];
        }

        $searchHash = $request->query('search_hash');
        $tempItineraries = TempItinerary::with([
            'tour.tourCategory',
            'tour.TourItinerary.activities.activity',
            'tour.TourItinerary.services',
            'accomodation'
        ])->where('search_hash', $searchHash)->get();

        $first = $tempItineraries->first();
        $category = $first->category;
        $wh = $first->wh;
        $tour = $first->tour;
        $pricing = PackagePricing::where('search_hash', $searchHash)->first();

        $time = $pricing->created_at;
        $current_time = now();

        $duration = $current_time->diffInMinutes($time);

        if ($duration > 15) {
            return redirect()->route('tour.static', [
                'category' => $category,
                'slug' => $tour->tourCategory->slug,
                'subslug' => $tour->slug
            ])->with('error', 'Payment Time Out');
        }

        if ($wh == 1) {
            foreach ($tempItineraries as $item) {
                if (!empty($item->room_booking_code)) {
                    $payload = [
                        'BookingCode' => $item->room_booking_code,
                        'PaymentMode' => 'Limit',
                    ];

                    $maxAttempts = 3;
                    $attempt = 0;
                    $success = false;
                    $lastError = null;

                    while ($attempt < $maxAttempts && !$success) {
                        $attempt++;

                        try {
                            $response = $tboHotelService->preBook($payload);
                            $statusCode = $response['Status']['Code'] ?? null;

                            $item->prebook_response = [
                                'status'   => $statusCode == 200 ? 'success' : 'failed',
                                'attempt'  => $attempt,
                                'payload'  => $payload,
                                'response' => $response,
                            ];

                            if ($statusCode == 200 && $item->accomodation) {
                                $item->accomodation->room = $response['HotelResult'][0]['Rooms'][0] ?? 'Andaman bliss';
                                $item->accomodation->ValidationInfo = $response['ValidationInfo'] ?? null;
                                $success = true;
                            }
                        } catch (\Throwable $e) {
                            $lastError = $e->getMessage();
                            \Log::error('PreBook failed', [
                                'attempt' => $attempt,
                                'payload' => $payload,
                                'error'   => $lastError
                            ]);
                            sleep(1);
                        }
                    }

                    if (!$success) {
                        $item->prebook_response = [
                            'status'  => 'error',
                            'attempt' => $maxAttempts,
                            'payload' => $payload,
                            'error'   => $lastError ?? 'Unknown failure',
                        ];
                    }
                } else {
                    $item->prebook_response = [
                        'status'  => 'skipped',
                        'reason'  => 'BookingCode is empty',
                        'payload' => [
                            'BookingCode' => $item->room_booking_code,
                            'PaymentMode' => 'Limit',
                        ]
                    ];
                }
            }

            $timestamp = now()->format('Y-m-d_H-i-s');
            Storage::put("booknow-responses/request_response_{$timestamp}.json", json_encode([
                'response' => $tempItineraries
            ], JSON_PRETTY_PRINT));
        }
        return view('tours.book-now', [
            'tempItineraries' => $tempItineraries,
            'pricing' => $pricing,
            'preBookResponses' => $tempItineraries->pluck('prebook_response.response') ?? null,

        ], compact('logged'));
    }



    public function sendMailToGuest($searchHash)
    {
        $tempItinerary = TempItinerary::with('tour')
            ->where('search_hash', $searchHash)
            ->first();

        $pricing = PackagePricing::where('search_hash', $searchHash)->first();

        $itinerary = TempItinerary::with([
            'tour.tourCategory',
            'ferries',
            'accomodation',
            'tour.TourItinerary.activities.activity',
            'tour.TourItinerary.services',
            'tour.inclusions'
        ])
            ->where('search_hash', $searchHash)
            ->get();

        $iti = Pdf::loadView('tours.itinerary', compact('itinerary', 'pricing'))
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        $passengers = PassengerDetails::where('booking_id', $searchHash)
            ->where('purpose', 'Package booking')
            ->get();

        $payment = RazorpayTransactions::where('booking_id', $searchHash)
            ->where('purpose', 'Package booking')
            ->first();

        $voucher = Pdf::loadView('tickets.package_payment', compact('itinerary', 'payment', 'pricing', 'passengers'))
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        $guest = $payment;

        if (!$guest || !$tempItinerary) return;

        $mailData = [
            'guestName' => $guest->name ?? 'Guest',
            'packageName' => $tempItinerary->tour->package_name ?? 'Your Package',
            'subject' => 'Payment Confirmation - Andaman Bliss',
        ];

        \Illuminate\Support\Facades\Mail::send(
            'emails.package_mail',
            $mailData,
            function ($message) use ($guest, $mailData, $iti, $voucher) {
                $message->to(
                    $guest->email ?? 'shivakumar@andamanbliss.com',
                    $guest->name ?? 'Guest'
                )
                    ->subject($mailData['subject'])
                    ->attachData($iti->output(), 'itinerary.pdf', ['mime' => 'application/pdf'])
                    ->attachData($voucher->output(), 'voucher.pdf', ['mime' => 'application/pdf']);
            }
        );

        \Log::info("Booking confirmation email sent for booking: {$searchHash}");
    }



    public function Payment(Request $request)
    {

        $paying = $request->partial_pay == 'on' ? 0 : 1;

        $hotelResponseRaw = $request->input('hotel_response') ?? null;

        $searchHash = $request->input('search_hash');

        $hotelResponseJson = html_entity_decode($hotelResponseRaw);
        $itineraryArray = json_decode($hotelResponseJson, true);
        if (!is_array($itineraryArray) || empty($itineraryArray)) {
            return response()->json(['error' => 'Invalid hotel_response format'], 422);
        }
        $pricing = PackagePricing::where('search_hash', $searchHash)->first();
        $requestGuests = $request->input('guests', []);
        $adultCount = 0;
        $childCount = 0;

        if (!empty($requestGuests) && is_array($requestGuests)) {
            foreach ($requestGuests as $room) {
                if (isset($room['adults']) && is_array($room['adults'])) {
                    $adultCount += count($room['adults']);
                }
                if (isset($room['children']) && is_array($room['children'])) {
                    $childCount += count($room['children']);
                }
            }
        } else {
            foreach ($itineraryArray as $day) {
                if (!empty($day['guest'])) {
                    $g = json_decode($day['guest'], true);
                    if (is_array($g)) {
                        foreach ($g as $room) {
                            $adultCount += (int) ($room['Adults'] ?? 0);
                            $childCount += (int) ($room['Children'] ?? 0);
                        }
                    }
                }
            }
        }

        $totalPax = $adultCount + $childCount;
        $tourId = $itineraryArray[0]['tour_id'] ?? null;
        $travelDate = $itineraryArray[0]['start_date'] ?? null;
        $billing = $request->input('billing', []);

        $today = Carbon::now()->startOfDay();
        $travel_date = $travelDate;

        $diff = $today->diffInDays($travel_date);
        $diffDays = $diff;

        $totalAmount = $pricing->grand_total;

        $payment_break = PaymentBreakups::get();

        $defaultPayment = $payment_break->firstWhere('days', 0);

        $matchingPayment = $payment_break->filter(fn($payment) => $payment->days > 0 && $diffDays <= $payment->days)
            ->sortBy('days')
            ->first();

        if (!$matchingPayment && $defaultPayment) {
            $matchingPayment = $defaultPayment;
        }


        $paypercent = $paying ? 100 : ($matchingPayment['percent'] ?? 0);
        $payable = ($totalAmount * $paypercent) / 100;
        $balance_amt = $totalAmount - $payable;

        $pricing->update([
            'paying_percent' => $paypercent,
            'payable_amt' => $payable,
            'balance_amt' => $balance_amt,
        ]);

        $combinedData = [
            'search_hash' => $request->input('search_hash', $itineraryArray[0]['search_hash'] ?? null),
            'itinerary' => $itineraryArray,
            'guests' => $requestGuests,
            'billing' => $billing,
            'totals' => [
                'adults' => $adultCount,
                'children' => $childCount,
                'pax' => $totalPax,
                'amount' => $totalAmount,
            ],
            'travel_date' => $travelDate,
            'tour_id' => $tourId,
        ];

        $allSearchHashes = collect($itineraryArray)
            ->pluck('search_hash')
            ->filter()
            ->unique();
        $bookno = 'PK' . strtoupper(uniqid());
        FerryBookings::whereIn('package_id', $allSearchHashes)->delete();
        foreach ($itineraryArray as $index => $day) {
            if (empty($day['ferry'])) {
                continue;
            }

            $decoded = is_string($day['ferry']) ? json_decode($day['ferry'], true) : $day['ferry'];
            if (!is_array($decoded)) {
                continue;
            }

            $ferryEntry = (isset($decoded[0]) && is_array($decoded[0])) ? $decoded[0] : $decoded;

            if (!empty($ferryEntry['ferry']) && is_string($ferryEntry['ferry'])) {
                $inner = json_decode($ferryEntry['ferry'], true);
                if (is_array($inner)) {
                    $ferryEntry = array_merge($ferryEntry, $inner);
                }
            }

            if ((empty($ferryEntry['departure']) || empty($ferryEntry['arraival'])) && !empty($day['time'])) {
                if (strpos($day['time'], '|') !== false) {
                    [$departurePart, $arrivalPart] = array_map('trim', explode('|', $day['time'], 2));
                    $ferryEntry['departure'] = trim(str_ireplace('Departure:', '', $departurePart));
                    $ferryEntry['arraival'] = trim(str_ireplace('Arrival:', '', $arrivalPart));
                }
            }

            $travelDate = now()->toDateString();
            $rawDate = $ferryEntry['departDate'] ?? $ferryEntry['depart_date'] ?? $day['date'] ?? null;
            if (!empty($rawDate)) {
                try {
                    $travelDate = \Carbon\Carbon::parse($rawDate)->format('Y-m-d');
                } catch (\Exception $e) {
                    $travelDate = now()->toDateString();
                }
            }

            $fromLocation = $ferryEntry['from'] ?? $day['from'] ?? '';
            $toLocation = $ferryEntry['to'] ?? $day['to'] ?? '';
            if (!empty($fromLocation) && empty($toLocation) && stripos($fromLocation, ' to ') !== false) {
                [$fromLoc, $toLoc] = array_map('trim', preg_split('/\s+to\s+/i', $fromLocation, 2));
                $fromLocation = $fromLoc;
                $toLocation = $toLoc;
            }

            $embarkation = !empty($ferryEntry['departure']) ? date('H:i:s', strtotime($ferryEntry['departure'])) : '00:00:00';
            $disembarkation = !empty($ferryEntry['arraival']) ? date('H:i:s', strtotime($ferryEntry['arraival'])) : '00:00:00';
            FerryBookings::create([
                'package_id' => $day['search_hash'],
                'bookno' => $bookno,
                'trip_no' => $ferryEntry['id'] ?? $ferryEntry['route_id'] ?? null,
                'trip_id' => $ferryEntry['trip_id'] ?? $index + 1,
                'name' => $billing['name'] ?? null,
                'phone' => $billing['phone'] ?? null,
                'email' => $billing['email'] ?? null,
                'gst' => $billing['gst'] ?? null,
                'from_location' => $fromLocation,
                'to_location' => $toLocation,
                'travel_date' => $travelDate,
                'embarkation' => $embarkation,
                'disembarkation' => $disembarkation,
                'baseFare' => $ferryEntry['adult_seat_rate'] ?? ($ferryEntry['baseFare'] ?? 0),
                'infantFare' => $ferryEntry['infant_fare'] ?? 0,
                'totalCost' => $ferryEntry['fare'] ?? ($ferryEntry['totalCost'] ?? 0),
                'Psf' => $ferryEntry['port_fee'] ?? ($ferryEntry['Psf'] ?? 0),
                'Adult' => $ferryEntry['adult'] ?? 0,
                'Infants' => $ferryEntry['infant'] ?? 0,
                'ferry' => $ferryEntry['ferry_name'] ?? $day['name'] ?? '',
                'vesselId' => $ferryEntry['ferry_id'],
                'class' => $ferryEntry['selected_class']['class_name'],
                'class_id' => $ferryEntry['selected_class']['class_id'] ?? '',
                'booking_mode' => 'package',
                'booking_status' => 0,
                'payment_status' => 0,
            ]);
        }

        HotelBookings::whereIn('package_id', $allSearchHashes)->delete();

        foreach ($combinedData['itinerary'] as $day) {
            if (empty($day['accomodation']) || empty($day['accomodation']['room'])) {
                continue;
            }

            $roomInfo = $day['accomodation']['room'];
            $validationInfo = $day['accomodation']['ValidationInfo'] ?? [];

            HotelBookings::create([
                'booking_code' => $day['room_booking_code'] ?? null,
                'mode' => 'package',
                'package_id' => $day['search_hash'] ?? null,
                'hotel_code' => $day['hotel_code'] ?? null,
                'room_name' => !empty($roomInfo['Name']) ? implode(',', $roomInfo['Name']) : null,
                'nights' => 1,
                'per_day_cost' => $roomInfo['DayRates'][0][0]['BasePrice'] ?? null,
                'total_cost' => $roomInfo['TotalFare'] ?? 0,
                'gst_no' => $combinedData['billing']['gst'] ?? null,
                'check_in' => $day['start_date'] ?? null,
                'check_out' => !empty($day['start_date']) ? \Carbon\Carbon::parse($day['start_date'])->addDay() : null,
                'validation' => json_encode($validationInfo),
                'amenities' => !empty($roomInfo['Amenities']) ? implode(', ', $roomInfo['Amenities']) : null,
                'inclusion' => $roomInfo['Inclusion'] ?? null,
                'total_tax' => $roomInfo['TotalTax'] ?? 0,
                'net_amt' => $roomInfo['NetAmount'] ?? 0,
                'net_tax' => $roomInfo['NetTax'] ?? 0,
                'rooms' => !empty($roomInfo['Name']) ? count($roomInfo['Name']) : 0,
                'status' => 'pending'
            ]);
        }

        PassengerDetails::where('booking_id', $combinedData['search_hash'])->delete();
        RazorpayTransactions::where('booking_id', $combinedData['search_hash'])->delete();

        foreach ($combinedData['guests'] as $roomKey => $roomData) {
            foreach ($roomData as $group => $passengers) {
                foreach ($passengers as $paxIndex => $pax) {
                    $isLead = false;
                    if (!$isLead && strtolower($group) === 'adults' && $paxIndex === 0) {
                        $isLead = true;
                    }

                    $passenger = PassengerDetails::create([
                        'booking_id' => $combinedData['search_hash'],
                        'purpose' => 'Package booking',
                        'prefix' => $pax['title'] ?? 'Mr',
                        'm_name' => $pax['middle_name'] ?? null,
                        'last_name' => $pax['last_name'] ?? null,
                        'name' => $pax['first_name'] ?? $pax['name'],
                        'age' => $pax['age'] ?? 0,
                        'group' => 'room' . ($roomKey + 1),
                        'ticket_no' => null,
                        'type' => strtolower($group) === 'adults' ? 1 : 2,
                        'gender' => $pax['gender'] ?? null,
                        'seat_no' => null,
                        'pass_no' => $pax['passport_no'] ?? null,
                        'pass_exp' => $pax['passport_expiry'] ?? null,
                        'pass_issue' => $pax['passport_issue'] ?? null,
                        'tier' => null,
                        'lead' => $isLead ? 1 : 0,
                        'class' => null,
                        'id_no' => $pax['id_no'] ?? null,
                        'nationality' => $pax['nationality'] ?? 'IN',
                    ]);
                }
            }
        }





        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));

        $orderData = [
            'receipt' => $combinedData['search_hash'],
            'amount' => (int) round($payable * 100),
            'currency' => 'INR',
            'payment_capture' => 1
        ];

        $order = $api->order->create($orderData);

        $paymentDetail = RazorpayTransactions::create([
            'purpose' => 'Package Booking',
            'booking_id' => $combinedData['search_hash'],
            'name' => $billing['name'],
            'email' => $billing['email'],
            'phone' => $billing['phone'],
            'payment_id' => null,
            'order_id' => $order['id'],
            'currency' => 'INR',
            'amount' => $payable,
            'mode' => app()->environment('production') ? 'live' : 'test',
            'json_response' => json_encode($orderData),
        ]);

        return response()->json([
            'success' => true,
            'booking_id' => $combinedData['search_hash'],
            'order_id' => $order['id'],
            'amount' => (int) round($payable * 100),
        ]);
    }



    public function downloadItinerart(Request $request)
    {
        $search_hash = $request->input('trip_code');

        $itinerary = TempItinerary::with([
            'tour.tourCategory',
            'ferries',
            'accomodation',
            'tour.TourItinerary.activities.activity',
            'tour.TourItinerary.services',
            'tour.inclusions'
        ])
            ->where('search_hash', $search_hash)
            ->get();
        $pricing = PackagePricing::where('search_hash', $search_hash)->first();

        $pdf = Pdf::loadView('tours.itinerary', compact('itinerary', 'pricing'))
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        return $pdf->download('Andaman_Bliss_Travel_Itinerary.pdf');
    }




    public function downloadPackageVoucher(Request $request)
    {
        $search_hash = $request->input('trip_code');

        $itinerary = TempItinerary::with([
            'tour.tourCategory',
            'ferries',
            'accomodation',
            'tour.TourItinerary.activities.activity',
            'tour.TourItinerary.services',
            'tour.inclusions'
        ])
            ->where('search_hash', $search_hash)
            ->get();

        $pricing = PackagePricing::where('search_hash', $search_hash)->first();
        $passengers = PassengerDetails::where('booking_id', $search_hash)
            ->where('purpose', 'Package booking')
            ->get();

        $payment = RazorpayTransactions::where('booking_id', $search_hash)
            ->where('purpose', 'Package booking')
            ->first();
        // return view('tickets.package_payment', compact('itinerary'));

        $pdf = Pdf::loadView('tickets.package_payment', compact('itinerary', 'payment', 'pricing', 'passengers'))
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);
        $name = 'Andaman Bliss ' . $itinerary[0]->tour->package_name . '-' . $itinerary[0]->category . '-' . $itinerary[0]->tour->tourCategory->name . '  Payment Voucher.pdf';

        return $pdf->download($name);
    }




    public function updatePayment(Request $request)
    {

        Log::info('[Payment] Initiating payment update', ['booking_id' => $request->booking_id]);

        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);
            Log::info('[Payment] Signature verified', ['payment_id' => $request->razorpay_payment_id]);

            $order = $api->order->fetch($request->razorpay_order_id);

            $transaction = RazorpayTransactions::where('booking_id', $request->booking_id)
                ->where('order_id', $request->razorpay_order_id)
                ->first();

            if (!$transaction) {
                Log::error('[Payment] Transaction not found', ['booking_id' => $request->booking_id]);
                return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
            }

            $transaction->update([
                'payment_id' => $request->razorpay_payment_id,
                'json_response' => json_encode($order),
                'status' => 'completed',
            ]);

            Log::info('[Payment] Transaction updated', ['transaction_id' => $transaction->id]);

            try {
                $this->ProcessBook($transaction->booking_id);

                SendPackageConfirmationEmail::dispatch($transaction->booking_id, $transaction['email'])->delay(now()->addMinutes(1));
                $this->ConfirmToAdmin($transaction->booking_id);
            } catch (\Exception $e) {
                Log::error("Package confirmation job failed", [
                    'booking_id' => $transaction->booking_id,
                    'error' => $e->getMessage()
                ]);
            }


            Log::info('[Booking] Booking status check job dispatched', ['booking_id' => $transaction->booking_id]);

            return response()->json([
                'success' => true,
                'message' => 'Booking in progress. Confirmation will be sent shortly.'
            ]);
        } catch (\Exception $e) {
            Log::error('[Payment] Exception occurred during verification', [
                'error' => $e->getMessage(),
                'booking_id' => $request->booking_id
            ]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }



    public function ProcessBook($bookingId)
    {
        Log::info('Starting booking processing for booking ID: ' . $bookingId);

        $itinerary = TempItinerary::where('search_hash', $bookingId)->get();
        Log::info("Fetched TempItinerary", ['count' => $itinerary->count()]);

        $wh = $itinerary[0]->wh;

        $ferries = FerryBookings::whereIn('package_id', $itinerary->pluck('search_hash'))
            ->where('booking_mode', 'package')
            ->where('booking_status', 0)
            ->get();
        Log::info("Fetched FerryBookings", ['count' => $ferries->count()]);

        $passengers = PassengerDetails::where('booking_id', $bookingId)
            ->where('purpose', 'Package booking')
            ->get();
        Log::info("Fetched PassengerDetails", ['count' => $passengers->count()]);

        $paymentDetail = RazorpayTransactions::where('booking_id', $bookingId)
            ->where('purpose', 'Package booking')
            ->first();
        Log::info("Fetched RazorpayTransactions", ['exists' => !empty($paymentDetail)]);


        if ($wh == 1) {

            $hotels = HotelBookings::whereIn('package_id', $itinerary->pluck('search_hash'))
                ->where('mode', 'package')
                ->where('Status', 0)
                ->get();


            Log::info("Fetched HotelBookings", ['count' => $hotels->count()]);
            $hotelPayloads = [];

            foreach ($hotels as $hotelBooking) {
                Log::info("Processing HotelBooking", ['booking_code' => $hotelBooking->booking_code]);

                $validation = json_decode($hotelBooking->validation, true) ?? [];
                $grouped = $passengers->groupBy('group');
                $hotelRoomsDetails = [];

                foreach ($grouped as $room => $guests) {
                    $roomPassengers = [];
                    foreach ($guests as $index => $guest) {
                        $passenger = [
                            "Title" => $guest->prefix,
                            "FirstName" => $guest->name,
                            "MiddleName" => $guest->m_name,
                            "LastName" => $guest->last_name,
                            "Email" => $guest->email,
                            "PaxType" => $guest->type,
                            "LeadPassenger" => (bool) $guest->lead,
                            "Age" => $guest->type == 2 ? ($guest->age ?? 0) : 0,
                            "Phoneno" => $guest->phone,
                            "PaxId" => $index,
                        ];
                        if (!empty($validation['PanMandatory']))
                            $passenger['PAN'] = $guest->id_no ?? null;
                        if (!empty($validation['PassportMandatory'])) {
                            $passenger['PassportNo'] = $guest->pass_no ?? null;
                            $passenger['PassportIssueDate'] = $guest->pass_issue ?? null;
                            $passenger['PassportExpDate'] = $guest->pass_exp ?? null;
                        }
                        if (!empty($validation['GSTAllowed'])) {
                            $passenger['GSTNumber'] = $guest->gst ?? null;
                            $passenger['GSTCompanyAddress'] = $guest->gst_company_address ?? null;
                            $passenger['GSTCompanyContactNumber'] = $guest->gst_company_contact ?? null;
                            $passenger['GSTCompanyName'] = $guest->gst_company_name ?? null;
                            $passenger['GSTCompanyEmail'] = $guest->gst_company_email ?? null;
                        }
                        $roomPassengers[] = array_filter($passenger, fn($v) => !is_null($v));
                    }
                    $hotelRoomsDetails[] = ["HotelPassenger" => $roomPassengers];
                }
                $hotelPayloads[] = [
                    "BookingCode" => $hotelBooking->booking_code,
                    "IsVoucherBooking" => true,
                    "GuestNationality" => 'IN',
                    "EndUserIp" => request()->ip(),
                    "TokenId" => Cache::get('tbo_token_id'),
                    "RequestedBookingMode" => 5,
                    "NetAmount" => $hotelBooking->net_amt,
                    "HotelRoomsDetails" => $hotelRoomsDetails
                ];
            }

            foreach ($hotelPayloads as $payload) {
                $hotelBooking = HotelBookings::where('booking_code', $payload['BookingCode'])
                    ->where('Status', 0)
                    ->first();
                if (!$hotelBooking) {
                    Log::warning("HotelBooking not found for payload", ['booking_code' => $payload['BookingCode']]);
                    continue;
                }
                try {
                    Log::info("Confirming hotel booking", ['booking_code' => $payload['BookingCode']]);
                    $confirmBookResponse = $this->tboHotelService->confirmRoom($payload);
                    $bookResult = $confirmBookResponse['BookResult'] ?? [];
                    Log::info("Hotel booking response", ['booking_code' => $payload['BookingCode'], 'response' => $bookResult]);

                    $hotelBooking->update([
                        'InvoiceNumber' => $bookResult['InvoiceNumber'],
                        'BookingRefNo' => $bookResult['BookingRefNo'],
                        'BookingId' => $bookResult['BookingId'] ?? null,
                        'TraceId' => $bookResult['TraceId'] ?? null,
                        'ConfirmationNo' => $bookResult['ConfirmationNo'] ?? null,
                        'HotelBookingStatus' => $bookResult['HotelBookingStatus'] ?? 'pending',
                        'Status' => isset($bookResult['BookingId']) ? 1 : 2,
                    ]);
                    dispatch((new \App\Jobs\CheckTboHotelBookingStatus($hotelBooking->id))->delay(now()->addSeconds(300)));
                } catch (\Exception $e) {
                    $hotelBooking->update(['Status' => 2]);
                    Log::error('Hotel booking failed', [
                        'booking_code' => $payload['BookingCode'],
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }
        $nautikaFerries = ['Nautika Seaways', 'Nautika'];
        $makruzzFerries = ['Makruzz', 'Makruzz Gold', 'Makruzz Pearl'];

        foreach ($ferries as $ferryBooking) {
            if ($ferryBooking->booking_status != 0)
                continue;
            try {
                $ferryName = trim($ferryBooking->ferry);
                $result = null;

                if (in_array($ferryName, $nautikaFerries)) {
                    $paxList = [];
                    foreach ($passengers as $index => $guest) {
                        $paxList[] = [
                            "id" => $index + 1,
                            "name" => trim($guest->name . ' ' . $guest->last_name),
                            "age" => (string) ($guest->age ?? 0),
                            "gender" => match (strtolower($guest->gender ?? '')) {
                                'male', 'm' => 'M',
                                'female', 'f' => 'F',
                                default => '',
                            },
                            "nationality" => $guest->nationality ?? 'Indian',
                            "passport" => $guest->pass_no ?? '',
                            "tier" => $guest->tier ?? '',
                            "seat" => $guest->seat_no ?? '',
                            "isCancelled" => 0,
                        ];
                    }
                    $nautikaPayload = [
                        "bookingData" => [
                            [
                                "bookingTS" => time(),
                                "id" => $ferryBooking->trip_no,
                                "tripId" => $ferryBooking->trip_id,
                                "vesselID" => $ferryBooking->vesselId,
                                "from" => $ferryBooking->from_location,
                                "to" => $ferryBooking->to_location,
                                "paxDetail" => [
                                    "email" => $paymentDetail?->email ?? '',
                                    "phone" => $paymentDetail?->phone ?? '',
                                    "gstin" => $paymentDetail?->gst ?? '',
                                    "pax" => $paxList,
                                    "infantPax" => [],
                                    "bClassSeats" => [],
                                    "pClassSeats" => []
                                ],
                                "userData" => [
                                    "apiUser" => [
                                        "userName" => env('SEALINK_API_USERNAME'),
                                        "agency" => '',
                                        "token" => config('services.sealink.token'),
                                        "walletBalance" => 0,
                                    ]
                                ],
                                "paymentData" => ["gstin" => $paymentDetail?->gst ?? '']
                            ]
                        ],
                        "userName" => env('SEALINK_API_USERNAME'),
                        "token" => config('services.sealink.token'),
                    ];
                    $result = $this->getFerryService('Nautika', $nautikaPayload);
                }

                if (in_array($ferryName, $makruzzFerries)) {
                    $passengerData = [];
                    $index = 1;
                    foreach ($passengers as $guest) {
                        $age = (int) ($guest->age ?? 0);

                        if ($age < 2) {
                            $title = "INFANT";
                            $ageValue = (string) max(0, min($age, 1));
                        } else {
                            $title = strtoupper($guest->prefix ?? 'MR');
                            $ageValue = (string) $age;
                        }

                        $passengerData[$index++] = [
                            "title" => $title,
                            "name" => trim($guest->name . ' ' . $guest->last_name),
                            "age" => $ageValue,
                            "sex" => strtoupper($guest->gender ?? 'male'),
                            "nationality" => strtoupper($guest->nationality ?? 'indian'),
                            "fcountry" => strtoupper($guest->nationality ?? 'indian'),
                            "fpassport" => $guest->id_no ?? '',
                            "fexpdate" => ""
                        ];
                    }

                    $preparedBookingData = [
                        "ferry" => "Makruzz",
                        "passenger" => $passengerData,
                        "c_name" => $paymentDetail?->name ?? 'Pravin Kumar',
                        "c_mobile" => $paymentDetail?->phone ?? '89',
                        "c_email" => $paymentDetail?->email ?? 'info@andamanbliss.com',
                        "p_contact" => $paymentDetail?->phone ?? '8900909900',
                        "c_remark" => "live",
                        "no_of_passenger" => (string) count($passengerData),
                        "schedule_id" => $ferryBooking->trip_id,
                        "travel_date" => isset($ferryBooking->travel_date) ? date('Y-m-d', strtotime($ferryBooking->travel_date)) : date('Y-m-d'),
                        "class_id" => $ferryBooking->class_id,
                        "fare" => $ferryBooking->base_fare,
                        "tc_check" => true
                    ];
                    $result = $this->getFerryService('Makruzz', $preparedBookingData);
                }

                if ($result && isset($result['pnr'])) {
                    $ferryBooking->update([
                        'pnr_no' => $result['pnr'],
                        'base_code' => $result['pdf_base64'] ?? null,
                        'booking_status' => 1
                    ]);
                } else {
                    $ferryBooking->update(['booking_status' => 2]);
                }
            } catch (\Exception $e) {
                $ferryBooking->update(['booking_status' => 2]);
            }
        }

        Log::info("Sending confirmation email", ['bookingId' => $bookingId]);
        $controller = app(TourController::class);
        $controller->sendMailToGuest($bookingId);

        Log::info("ProcessBookingJob completed", ['bookingId' => $bookingId]);
    }

    public function getFerryService($ferry, $bookingData)
    {
        // Nautka Booking PNR
        if ($ferry === 'Nautika') {
            try {
                $bookSealink = $this->sealinkService->bookSeatsAuto($bookingData);
                if (isset($bookSealink[0]['seatStatus']) && $bookSealink[0]['seatStatus']) {
                    return [
                        'pnr' => $bookSealink[0]['pnr'],
                        'pdf_base64' => $bookSealink[0]['pdf_base64'] ?? null
                    ];
                }
                return false;
            } catch (\Exception $e) {
                return ['status' => 'error', 'ferry' => 'Nautika', 'message' => $e->getMessage()];
            }
        }

        if ($ferry === 'Makruzz') {
            try {
                $savePassenger = $this->makruzzApiService->savePassengers(['bookingData' => $bookingData]);
                $bookingId = $savePassenger['data']['booking_id'];
                $confirmBooking = $this->makruzzApiService->confirmBooking($bookingId);
                $confirmBookingData = $confirmBooking->getData(true);
                if (!isset($confirmBookingData['data']['pnr']))
                    return false;
                $pnr = $confirmBookingData['data']['pnr'];
                $getTicketResponse = $this->makruzzApiService->downloadTicket($bookingId);
                if (!$getTicketResponse)
                    return false;
                $pdfBase64 = $getTicketResponse->getContent();
                return ['pnr' => $pnr, 'booking_id' => $bookingId, 'pdf_base64' => $pdfBase64];
            } catch (\Exception $e) {
                return ['status' => 'error', 'ferry' => 'Makruzz', 'message' => $e->getMessage()];
            }
        }

        //      if ($ferry === 'Makruzz') {
        //     return [
        //         'pnr' => 'MAKRUZZ5678',
        //         'booking_id' => rand(1000, 9999),
        //         'pdf_base64' => base64_encode('Dummy PDF content for Makruzz'),
        //     ];
        // }


        return ['status' => 'error', 'ferry' => $ferry, 'message' => 'Unsupported ferry service'];
    }


    public function thankYou(Request $request)
    {
        $bookingId = $request->booking_id;
        $payment = RazorpayTransactions::where('booking_id', $bookingId)->first();
        $itineraries = TempItinerary::with('tour.tourCategory')->where('search_hash', $bookingId)->get();
        $itinerary = $itineraries->first();
        $end_date = $itineraries->last()->start_date;
        $guests = json_decode($itinerary['guest'], true);
        $adults = array_sum(array_column($guests, 'Adults'));
        $child = array_sum(array_column($guests, 'Children'));

        $guest = [
            'adults' => $adults,
            'childrens' => $child ?? 0,
        ];

        $data = [
            'payment' => $payment,
            'itinerary' => $itinerary,
            'end_date' => $end_date,
            'guest' => $guest
        ];
        return view('tours.thank-you', compact('data'));
    }


    public static function Cancelremainder($booking_id)
    {
        $payment = RazorpayTransactions::where('booking_id', $booking_id)->first();
        $itineraries = TempItinerary::with('tour.tourCategory')->where('search_hash', $booking_id)->get();
        $itinerary = $itineraries->first();
        $data = [
            'guest_name' => $payment['name'],
            'email' => $payment['email'],
            'package_name' => $itinerary->tour->package_name . ',' . $itinerary->category . ', ' . $itinerary->tour->tourCategory->name,
            'booking_link' => 'travel-packages/preview/book?search_hash=' . $booking_id,
            'subject' => 'Don’t Miss Out: Secure Your' . $itinerary->tour->package_name . ',' . $itinerary->category . ', ' . $itinerary->tour->tourCategory->name . ' Tour Package',
        ];

        \Mail::send('emails.payment-remainder', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->subject($data['subject']);
        });
    }


    public static function CancelAlert($booking_id)
    {
        $payment = RazorpayTransactions::where('booking_id', $booking_id)->first();
        $itineraries = TempItinerary::with('tour.tourCategory')->where('search_hash', $booking_id)->get();
        $passengers = PassengerDetails::where('booking_id', $booking_id)
            ->where('purpose', 'Package booking')
            ->get();
        $itinerari = $itineraries->first();
        $data = [
            'guest_name' => $payment['name'],
            'pax' => $passengers,
            'package_name' => $itinerari->tour->package_name . ',' . $itinerari->category . ', ' . $itinerari->tour->tourCategory->name,
            'itinerary' => 'https://andamanbliss.com/travel-itinerary?trip_code=' . $booking_id,
            'email' => $payment['email'],
            'contact' => $payment['phone'],
            'subject' => '⚠️ Payment Failure Notification – Guest Booking Attempt (' . $itinerari->tour->package_name . ',' . $itinerari->category . ', ' . $itinerari->tour->tourCategory->name . ')',
        ];

        $pricing = PackagePricing::where('search_hash', $booking_id)->first();


        $itinerary = TempItinerary::with([
            'tour.tourCategory',
            'ferries',
            'accomodation',
            'tour.TourItinerary.activities.activity',
            'tour.TourItinerary.services',
        ])
            ->where('search_hash', $booking_id)
            ->get();

        $pdf = Pdf::loadView('tours.itinerary', compact('itinerary', 'pricing'))
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        \Mail::send('emails.payment-cancel', $data, function ($message) use ($data, $pdf) {
            $message->to('info@andamanbliss.com')
                ->subject($data['subject'])
                ->attachData($pdf->output(), 'itinerary.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });
    }


    public static function ConfirmToAdmin($booking_id)
    {
        $payment = RazorpayTransactions::where('booking_id', $booking_id)
            ->where('purpose', 'Package booking')
            ->first();
        $itineraries = TempItinerary::with('tour.tourCategory')->where('search_hash', $booking_id)->get();
        $iti = $itineraries->first();
        $data = [
            'guest_name' => $payment['name'],
            'package_name' => $iti->tour->package_name . ',' . $iti->category . ', ' . $iti->tour->tourCategory->name,
            'trip_id' => $booking_id,
            'subject' => 'Confirmed Package Booking',
            'email' => $payment['email'],
            'contact' => $payment['phone'],
        ];


        $itinerary = TempItinerary::with([
            'tour.tourCategory',
            'ferries',
            'accomodation',
            'tour.TourItinerary.activities.activity',
            'tour.TourItinerary.services',
            'tour.inclusions'
        ])
            ->where('search_hash', $booking_id)
            ->get();

        $pricing = PackagePricing::where('search_hash', $booking_id)->first();
        $passengers = PassengerDetails::where('booking_id', $booking_id)
            ->where('purpose', 'Package booking')
            ->get();


        $pdf = Pdf::loadView('tickets.package_payment', compact('itinerary', 'payment', 'pricing', 'passengers'))
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        \Mail::send('emails.tour_confirm', $data, function ($message) use ($data, $pdf) {
            $message->to('booking@andamanbliss.com')
                ->subject($data['subject'])
                ->attachData($pdf->output(), 'voucher.pdf', ['mime' => 'application/pdf']);
        });
    }
}
