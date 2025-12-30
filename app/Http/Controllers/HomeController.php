<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Blog;
use App\Models\Cabs;
use App\Models\Category;
use App\Models\GoogleReview;
use App\Models\Review;
use App\Models\TourPackages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Service;
use App\Models\Hotel;
use App\Models\IslandLocation;
use App\Models\ReviewImage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $tours = Service::with('category')
            ->where('type', 'tour')
            ->where('featured', 1)
            ->inRandomOrder()
            ->take(8)
            ->get();
        $cruises = Service::with('category')
            ->where('type', 'cruise')
            ->inRandomOrder()
            ->get();

        return view('welcome')->with(compact('tours', 'cruises'));
    }


    public function devindex(Request $request)
    {
        $allOffers = Category::distinct()->pluck('type');




        $tourOffers = TourPackages::with('tourCategory', 'tourPhotos')
            ->where('featured', 1)->where('status', 1)
            ->whereHas('tourCategory', function ($q) {
                $q->whereNotIn('slug', ['best-seller', 'budget', 'luxury', 'premium']);
            })
            ->inRandomOrder()
            ->get()
            ->map(function ($tour) {
                $tour->type = 'tour';
                $tour->name = $tour->package_name;
                $tour->OfferPhotos = $tour->tourPhotos;
                $tour->category = $tour->tourCategory;
                $tour->meta_title = $tour->page_heading;
                $tour->adult_price = $tour->package_cost ?? 0;
                $tour->adult_rate = $tour->package_cost - ($tour->package_cost * ($tour->discount / 100));
                $tour->route_slug = optional($tour->tourCategory)->slug;

                // ✅ add route_params
                $tour->route_params = [
                    'slug' => optional($tour->tourCategory)->slug,
                    'subslug' => $tour->slug,
                ];

                return $tour;
            });

        $activityOffers = Activities::with(['category', 'activityPhotos'])
            ->where('featured', 1)->where('status', 1)
            ->inRandomOrder()
            ->get()
            ->map(function ($activity) {
                $activity->type = 'activity';
                $activity->name = $activity->service_name;
                $activity->OfferPhotos = $activity->activityPhotos;
                $activity->meta_title = $activity->title;
                $activity->adult_price = $activity->adult_cost ?? 0;
                $activity->adult_rate = $activity->adult_cost - ($activity->adult_cost * ($activity->discount / 100));
                $activity->route_slug = $activity->slug;

                $activity->route_params = [
                    'url' => $activity->slug,
                ];

                return $activity;
            });

        $hotels = Hotel::where('status', 1)
            ->where('hotel_rating', '>=', 4)
            ->inRandomOrder()
            ->take(8)
            ->get()
            ->map(function ($hotel) {
                $hotel->type = 'hotel';
                $hotel->name = $hotel->hotel_name;
                $hotel->meta_title = $hotel->hotel_name;
                $hotel->OfferPhotos = !empty($hotel->hotel_image) ? $hotel->hotel_image : (!empty($hotelGallery[0]) ? $hotelGallery[0] : 'https://andamanbliss.com/site/img/hotel_image.png');
                $hotel->adult_price = 0;
                $hotel->adult_rate = 0;
                $hotel->route_slug = $hotel->slug;

                $hotel->route_params = [
                    'url' => $hotel->slug,
                ];

                return $hotel;
            });


        $cruises = Service::with('cruisePhotos', 'category')->where('type', 'cruise')->inRandomOrder()->get()->map(function ($cruise) {
            $cruise->type = 'cruise';
            $cruise->name = $cruise->name;
            $cruise->OfferPhotos = $cruise->cruisePhotos;
            $cruise->meta_title = $cruise->title;
            $cruise->adult_price = $cruise->adult_price ?? 0;
            $cruise->adult_rate = $cruise->adult_rate ?? 0;
            $cruise->route_slug = optional($cruise->category)->slug;

            $cruise->route_params = [
                'slug' => optional($cruise->category)->slug,
                'subslug' => $cruise->slug,
            ];
            return $cruise;
        });


        $cabs = Cabs::with('cabPhotos')->get()->map(function ($cab) {
            $cab->type = 'cab';
            $cab->name = $cab->name;
            $cab->meta_title = $cab->name;
            $cab->OfferPhotos = $cab->cabPhotos; // Assuming no photos for cabs
            $cab->adult_price = $cab->start_price ?? 0;
            $cab->adult_rate = $cab->start_price ?? 0;
            $cab->route_slug = Str::slug($cab->name);

            // ✅ add route_params
            $cab->route_params = [
                'url' => Str::slug($cab->name),
            ];

            return $cab;
        });

        $bikes = Service::with('bikePhotos', 'category')->where('type', 'bike')->where('featured', 1)->inRandomOrder()->get()->map(function ($bike) {
            $bike->type = 'bike';
            $bike->name = $bike->name;
            $bike->OfferPhotos = $bike->bikePhotos ? $bike->bikePhotos : '';
            $bike->meta_title = $bike->title;
            $bike->adult_price = $bike->adult_price ?? 0;
            $bike->adult_rate = $bike->adult_rate ?? 0;
            $bike->route_slug = optional($bike->category)->slug;

            // ✅ add route_params
            $bike->route_params = [
                'slug' => optional($bike->category)->slug,
                'subslug' => $bike->slug,
            ];

            return $bike;
        });


        $allOffers->put('bike', $bikes);
        $allOffers->put('cab', $cabs);
        $allOffers->put('cruise', $cruises);
        $allOffers->put('tour', $tourOffers);
        $allOffers->put('hotel', $hotels);
        $allOffers->put('activity', $activityOffers);
        $specialOffers = $allOffers;

        if ($request->has('dump')) {
            dd($allOffers['bike']);
        }

        $tours = TourPackages::with('tourCategory')
            ->where('featured', 1)
            ->inRandomOrder()
            ->take(8)
            ->get();

        $cruises = Service::with('cruisePhotos', 'category')
            ->where('type', 'cruise')
            ->inRandomOrder()
            ->take(4)->get();

        $hotDeals = TourPackages::with('tourCategory', 'tourPhotos')
            ->where('featured', 1)
            ->get()
            ->groupBy(fn($package) => $package->tourCategory->id)
            ->map(function ($group) {
                return $group->sortByDesc('package_cost')->first();
            })
            ->filter(function ($package) {
                return !in_array($package->tourCategory->slug, ['best-seller', 'budget']);
            })
            ->shuffle()
            ->take(4);





        $CelebsReviews = Review::with('reviewPhotos')->where('table_type', 'home-page-postcards')->where('status', 1)->get();
        $blogs = Blog::with('photo')->where('status', '1')->orderBy('id', 'DESC')->take(6)->get();

        $featuredHotels = Hotel::where('hotel_rating', '>', 3)->inRandomOrder()->take(4)->get();


        $categoryIds = Activities::select('category_id')
            ->distinct()
            ->limit(8)
            ->pluck('category_id');

        $activities = Activities::with('category', 'activityPhotos')
            ->whereIn('category_id', $categoryIds)
            ->get()
            ->groupBy('category_id')->take(6)
            ->map(fn($group) => $group->first());


        $reviews = GoogleReview::orderBy('review_date', 'DESC')->where('comment', '!=', null)->where('rating', 5)->take(8)->get();
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

        $faqs = [
            [
                'question' => 'Why Andaman Is the Perfect Holiday Destination for All Travelers?',
                'answer' => 'Andaman offers peaceful beaches, water sports, scenic landscapes, romantic spots, and family-friendly attractions, making it ideal for every type of traveler.'
            ],
            [
                'question' => 'How to Reach the Andaman & Nicobar Islands?',
                'answer' => 'You can reach Andaman by flight to Port Blair from cities like Delhi, Kolkata, Chennai, Hyderabad, and Bangalore. Ships operate from a few Indian ports but are not recommended for regular tourism.'
            ],
            [
                'question' => 'Do You Need a Passport to Visit Andaman?',
                'answer' => 'Indian citizens do not need a passport to visit Andaman. Foreign nationals require a valid Indian visa.'
            ],
            [
                'question' => 'Is Andaman Safe for Tourists?',
                'answer' => 'Yes, Andaman is very safe for tourists with low crime rates, well-regulated beaches, and trained water sports operators.'
            ],
            [
                'question' => 'What Is the Best Time to Visit Andaman?',
                'answer' => 'October to May is the ideal time to visit Andaman due to pleasant weather and calm seas.'
            ],
            [
                'question' => 'When Is the Cheapest Time to Visit Andaman?',
                'answer' => 'June to September is the most budget-friendly time because of the monsoon season and lower travel demand.'
            ],
            [
                'question' => 'Top Attractions in Andaman & Nicobar Islands?',
                'answer' => 'Key attractions include Radhanagar Beach, Cellular Jail, Havelock Island, Neil Island, Elephant Beach, Baratang Caves, and Ross Island.'
            ],
            [
                'question' => 'What Are the Best Water Sports Activities in Andaman?',
                'answer' => 'Popular water activities include scuba diving, snorkeling, sea walk, parasailing, jet skiing, and kayaking.'
            ],
            [
                'question' => 'Best Things to Do in Andaman for Every Type of Traveler?',
                'answer' => 'Families can enjoy beach hopping, couples can opt for romantic dinners, adventure lovers can dive and trek, and solo travelers can explore scenic nature trails.'
            ],
            [
                'question' => 'How Much Does an Andaman Trip Cost?',
                'answer' => 'Budget trips start at ₹12,000–₹18,000 per person. Standard packages cost ₹20,000–₹35,000, and luxury trips start at ₹40,000+ depending on hotels and season.'
            ],
            [
                'question' => 'How Many Days Are Enough for an Andaman Trip?',
                'answer' => 'Four to six days is ideal to cover Port Blair, Havelock, Neil Island, and major attractions.'
            ],
            [
                'question' => 'What Is the Best Itinerary for an Andaman Trip?',
                'answer' => 'A common itinerary is: Port Blair → Havelock → Elephant Beach → Neil Island → Port Blair sightseeing.'
            ],
            [
                'question' => 'Can I Customize My Andaman Family Tour?',
                'answer' => 'Yes, Andaman Bliss allows full customization based on travel dates, budget, and preferences.'
            ],
            [
                'question' => 'Can I Choose or Book My Own Hotels for the Trip?',
                'answer' => 'Yes, you can choose your preferred hotels, or we can suggest the best options based on comfort and price.'
            ],
            [
                'question' => 'Where to Eat in Andaman During My Tour?',
                'answer' => 'Port Blair, Havelock, and Neil Island offer restaurants serving Indian, continental, seafood, and vegetarian meals.'
            ],
            [
                'question' => 'Pure Vegetarian Restaurants in Andaman?',
                'answer' => 'Popular vegetarian options include Annapurna, Icy Spicy, Vegetarian Paradise, and several veg-friendly cafes.'
            ],

            [
                'question' => 'How Is the Nightlife in Andaman Islands?',
                'answer' => 'Nightlife is calm and nature-friendly with beach cafes, candlelight dinners, music nights, and night kayaking.'
            ],

            [
                'question' => 'What Are the Best Andaman Tour Packages? ',
                'answer' => 'Andaman Bliss offers honeymoon, family, group, adventure, luxury, and customizable packages.'
            ],
            [
                'question' => 'How Do I Plan an Andaman Trip Easily?',
                'answer' => 'Choose your dates, select islands, decide activities, book flights, and let Andaman Bliss arrange hotels, transfers, ferries, and sightseeing.'
            ],
            [
                'question' => 'What Should I Pack for an Andaman Trip?',
                'answer' => 'Carry light clothing, sunscreen, flip-flops, sunglasses, waterproof bags, and swimwear.'
            ],
            [
                'question' => 'Do’s and Don’ts for an Andaman Vacation?',
                'answer' => 'Do carry ID, follow safety guidelines, and pre-book ferries. Don’t touch corals, litter, or enter protected tribal areas.'
            ],
            [
                'question' => 'Essential Travel Tips for Visiting Andaman?',
                'answer' => 'Book ferries early, keep some cash, expect limited network on remote islands, and follow water sports instructions.'
            ],
            [
                'question' => 'Why Book Your Andaman Trip With Andaman Bliss?',
                'answer' => 'With years of expertise, thousands of happy travelers, and 200+ curated packages, Andaman Bliss ensures smooth planning, expert guidance, and stress-free travel.'
            ],
            [
                'question' => 'Andaman Tour Packages Offered by Andaman Bliss?',
                'answer' => 'We provide a wide range of Andaman tour packages for couples, families, groups, adventure seekers, and luxury travelers.'
            ],

        ];


        return view('welcome2')->with(compact('tours', 'blogs', 'CelebsReviews', 'cruises', 'activities', 'specialOffers', 'hotDeals', 'featuredHotels', 'reviews', 'rating', 'review_images', 'faqs'));
    }

    public function contact(Request $request)
    {

        if ($request->isMethod('post')) {

            if (!$request->has('website') || !empty($request->website)) {
                return back()->with('error', 'Spam detected. Submission blocked.');
            }

            foreach ($request->all() as $key => $value) {
                if (is_string($value) && preg_match('/<[^>]*>/', $value)) {
                    return back()->with('error', 'Spam detected. HTML input is not allowed.');
                }
            }

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'email' => 'sometimes|email|max:255',
                'mobile' => 'sometimes|numeric|digits:10',
                'adult' => 'sometimes|numeric|integer|digits:1',
                'child' => 'sometimes|numeric|integer|digits:1',
                'infant' => 'sometimes|numeric|integer|digits:1',
                'code' => 'sometimes|string',
                'url' => 'sometimes|url',
                'tour' => 'sometimes|string',
                'month' => 'sometimes|string',
                'travellers' => 'sometimes|string',
                'date' => 'sometimes|date|date_format:Y-m-d|after:' . date('Y-m-d'),
                'message' => 'sometimes|string|max:1000|regex:/^[a-zA-Z0-9\s.,!?-]+$/',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }


            $mailData['subject'] = $request->subject ?? 'Contact Form';
            $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
            $mailData['name'] = env('MAIL_FROM_NAME', 'AndamanBliss');
            $mailData['body'] = "";
            if ($request->name) {
                $mailData['body'] .= "Name: {$request->name}<br/>";
            }
            if ($request->email) {
                $mailData['body'] .= "Email: {$request->email}<br/>";
            }
            if ($request->mobile) {
                $mailData['body'] .= "Mobile: {$request->code}-{$request->mobile}<br/>";
            }
            if ($request->tour) {
                $mailData['body'] .= "Tour: {$request->tour}<br/>";
            }
            if ($request->address) {
                $mailData['body'] .= "Address: {$request->address}<br/>";
            }
            if ($request->adult) {
                $mailData['body'] .= "Adult: {$request->adult}<br/>
                                    Child: {$request->child}<br/>
                                    Infant: {$request->infant}<br/>";
            }
            if ($request->has('travellers')) {
                $mailData['travellers'] = "Travellers : {$request->travellers}<br/>";
            }

            if ($request->date) {
                $mailData['body'] .= "Date: {$request->date}<br/>";
            }
            if ($request->date) {
                $mailData['body'] .= "Travel Month: {$request->month}<br/>";
            }
            if ($request->package) {
                $mailData['body'] .= "Package: {$request->package}<br/>";
            }
            if ($request->services) {
                $mailData['body'] .= "Service(s): " . implode(', ', $request->services) . "<br/>";
            }
            if ($request->message) {
                $mailData['body'] .= "Message:<br/>
                                    {$request->message}";
            }
            if ($request->url) {
                $mailData['body'] .= "<br/>LEAD URL: {$request->url}";
            }
            // $mailData['url'] = url('login');
            // $mailData['button'] = 'Login';
            // $mailData['subbody'] = "You can also use your registered email & mobile as username.";
            $mailData['info'] = 'Note: don\'t share your login credentials & keep it confedential.';

            \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
                $message->subject($mailData['subject'])
                    // ->to($mailData['email'], $mailData['name'])
                    ->to('info@andamanbliss.com')
                    ->cc(['amitmandal@andamanbliss.com']);
            });

            if ($request->ajax()) {
                $statusCode = 200;
                return response()->json([
                    'status' => $statusCode,
                    'message' => __('Enquiry form submitted successfully!'),
                    'data' => $mailData,
                ], $statusCode);
            }

            return back()->with('success', __('Enquiry form submitted successfully!'));
        }

        return view('pages.contact');
    }



    public function photoEnq(Request $request)
    {

        if (!$request->has('website') || !empty($request->website)) {
                return back()->with('error', 'Spam detected. Submission blocked.');
            }

            foreach ($request->all() as $key => $value) {
                if (is_string($value) && preg_match('/<[^>]*>/', $value)) {
                    return back()->with('error', 'Spam detected. HTML input is not allowed.');
                }
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'contact' => 'required|digits:10',
                'date' => 'date|date_format:Y-m-d|after:'. date('Y-m-d'),
                'type' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }

            $mailData['subject'] = $request->subject ?? '📨 Photoshoot enquiry';
            $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
            $mailData['name'] = env('MAIL_FROM_NAME', 'AndamanBliss');
            $mailData['body'] = "";
            if ($request->name) {
                $mailData['body'] .= "Name: {$request->name}<br/>";
            }
           
            if ($request->contact) {
                $mailData['body'] .= "Mobile: {$request->code}-{$request->contact}<br/>";
            }
            if ($request->type) {
                $mailData['body'] .= "Shoot Type: {$request->type}<br/>";
            }
            if ($request->date) {
                $mailData['body'] .= "Date: {$request->date}<br/>";
            }
            $mailData['info'] = 'Note: don\'t share your login credentials & keep it confedential.';

            \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
                $message->subject($mailData['subject'])
                    // ->to($mailData['email'], $mailData['name'])
                    ->to('info@andamanbliss.com')
                    ->cc(['amitmandal@andamanbliss.com']);
            });

            return back()->with('success', __('Enquiry form submitted successfully!'));

    }


    public function customTripSubmit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'duration' => 'required|in:3-4,5-7,8-10,10+',
            'adults' => 'required|integer|min:0',
            'children' => 'required|integer|min:0',
            'infants' => 'required|integer|min:0',
            'min_price' => 'required|numeric|min:5000|max:100000',
            'max_price' => 'required|numeric|min:5000|max:100000|gte:min_price',
            'flight_option' => 'required|in:have_tickets,need_tickets',
            'trip_type' => 'required|in:family,honeymoon,friends,solo',
            'itinerary' => 'required|array|min:1',
            'itinerary.*.location' => 'required|string',
            'itinerary.*.activities' => 'nullable|string',
            'hotel' => 'required|array|min:1',
            'hotel.*.location' => 'required|string',
            'hotel.*.category' => 'required|string',
            'hotel.*.nights' => 'required|integer|min:1',
            'hotel.*.requests' => 'nullable|string',
            'ferry' => 'required|array|min:1',
            'ferry.*.from' => 'required|string',
            'ferry.*.to' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'special_requests' => 'nullable|string',

        ]);
        if (!$request->has('website') || !empty($request->website)) {
            return back()->with('error', 'Spam detected. Submission blocked.');
        }

        foreach ($request->all() as $key => $value) {
            if (is_string($value) && preg_match('/<[^>]*>/', $value)) {
                return back()->with('error', 'Spam detected. HTML input is not allowed.');
            }
        }
        try {
            // Prepare mail data in the specified format
            $mailData = [
                'subject' => 'New Trip Plan Submission',
                'email' => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
                'name' => env('MAIL_FROM_NAME', 'AndamanBliss'),
                'body' => '',
                'info' => 'Note: don\'t share your login credentials & keep it confidential.',
            ];

            // Add validated data to the body
            if ($validated['name']) {
                $mailData['body'] .= "Name: {$validated['name']}<br/>";
            }
            if ($validated['email']) {
                $mailData['body'] .= "Email: {$validated['email']}<br/>";
            }
            if ($validated['phone']) {
                $mailData['body'] .= "Phone: {$validated['phone']}<br/>";
            }
            if ($validated['duration']) {
                $mailData['body'] .= "Trip Duration: {$validated['duration']} Days<br/>";
            }
            if ($validated['adults'] || $validated['children'] || $validated['infants']) {
                $mailData['body'] .= "Adults: {$validated['adults']}<br/>";
                $mailData['body'] .= "Children: {$validated['children']}<br/>";
                $mailData['body'] .= "Infants: {$validated['infants']}<br/>";
            }
            if ($validated['min_price'] && $validated['max_price']) {
                $mailData['body'] .= "Budget Per Person: ₹{$validated['min_price']} - ₹{$validated['max_price']}<br/>";
            }
            if ($validated['flight_option']) {
                $flightOption = $validated['flight_option'] === 'have_tickets' ? 'Already have tickets' : 'Need flight tickets';
                $mailData['body'] .= "Flight Option: {$flightOption}<br/>";
            }
            if ($validated['trip_type']) {
                $mailData['body'] .= "Trip Type: " . ucfirst($validated['trip_type']) . "<br/>";
            }
            if (!empty($validated['itinerary'])) {
                $mailData['body'] .= "Itinerary:<br/>";
                foreach ($validated['itinerary'] as $index => $item) {
                    $day = $index + 1;
                    $mailData['body'] .= "Day {$day}: {$item['location']}";
                    if ($item['activities']) {
                        $mailData['body'] .= " - Activities: {$item['activities']}";
                    }
                    $mailData['body'] .= "<br/>";
                }
            }
            if (!empty($validated['hotel'])) {
                $mailData['body'] .= "Hotel Preferences:<br/>";
                foreach ($validated['hotel'] as $index => $hotel) {
                    $mailData['body'] .= "Hotel " . ($index + 1) . ": {$hotel['location']} - {$hotel['category']} ({$hotel['nights']} nights)";
                    if ($hotel['requests']) {
                        $mailData['body'] .= " - Requests: {$hotel['requests']}";
                    }
                    $mailData['body'] .= "<br/>";
                }
            }
            if (!empty($validated['ferry'])) {
                $mailData['body'] .= "Ferry Requirements:<br/>";
                foreach ($validated['ferry'] as $index => $ferry) {
                    $mailData['body'] .= "Ferry " . ($index + 1) . ": From {$ferry['from']} to {$ferry['to']}<br/>";
                }
            }
            if ($validated['special_requests']) {
                $mailData['body'] .= "Special Requests:<br/>{$validated['special_requests']}<br/>";
            }

            // Send the email
            \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
                $message->subject($mailData['subject'])
                    ->to('info@andamanbliss.com')
                    ->cc(['amitmandal@andamanbliss.com']);
            });

            // Return success response
            return redirect()->back()->with('success', 'Your trip plan has been submitted successfully! We will contact you soon.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Email sending failed: ' . $e->getMessage());

            // Return error response
            return redirect()->back()->with('error', 'There was an issue submitting your trip plan. Please try again later.');
        }
    }


    public function getLocations(Request $request)
    {
        $locationName = $request->input('q');
        $location = strtolower(trim($request->input('location')));

        $map = [
            'havelock islands' => 'havelock',
            'havelock island' => 'havelock',
            'neil island' => 'neil',
        ];

        $location = $map[$location] ?? $location;

        $locations = Cache::rememberForever('island_locations', function () {
            return IslandLocation::get();
        });

        $filtered = $locations->filter(function ($item) use ($locationName, $location) {
            return stripos($item->island_name, $location) !== false
                && stripos($item->name, $locationName) !== false;
        })->values();

        return response()->json($filtered);
    }
}
