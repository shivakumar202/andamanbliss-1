<?php

use App\Http\Controllers\TboHotelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CruiseController;
use App\Http\Controllers\CabController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BoatTripsController;
use App\Http\Controllers\BoatCharterFishing;
use App\Http\Controllers\FerryTickets;
use App\Http\Controllers\GoogleReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\upSaleController;
use App\Models\GoogleReview;
use App\Models\TourPackages;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('ajx-login', [LoginController::class, 'ajxlogin'])->name('axjlogin');

    // OTP Login
    Route::prefix('otp/{id}')->name('otp.')->group(function () {
        Route::get('/', [LoginController::class, 'showOtpForm'])->name('form');
        Route::get('generate', [LoginController::class, 'otpGenerate'])->name('generate');
        Route::post('login', [LoginController::class, 'otpLogin'])->name('login');
    });

    Route::prefix('password')->name('password.')->group(function () {
        // Forgot Password
        Route::get('reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('request');
        Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('email');

        // Reset Password
        Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset');
        Route::post('reset', [ResetPasswordController::class, 'reset'])->name('update');
    });
});

Route::middleware(['auth'])->group(function () {
    // Logout
    Route::any('logout', [LoginController::class, 'logout'])->name('logout');

    // Change Password
    Route::prefix('password')->name('password.')->group(function () {
        Route::get('change', [ChangePasswordController::class, 'showChangeForm'])->name('change');
        Route::post('change', [ChangePasswordController::class, 'change'])->name('store');
    });

    Route::get('profile', [DashboardController::class, 'showChangeForm'])->name('profile.show');
    Route::post('profile', [DashboardController::class, 'change'])->name('profile.update');

    Route::get('home', [DashboardController::class, 'index'])->name('home');

    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('tours', [BookingController::class, 'tours'])->name('tours');
        Route::get('tours/booking-detail/{tourId}', [BookingController::class, 'tourDetails'])->name('tours.details');
        Route::get('hotels', [BookingController::class, 'hotels'])->name('hotels');
        Route::get('activities', [BookingController::class, 'activities'])->name('activities');
        Route::get('cruises', [BookingController::class, 'cruises'])->name('cruises');
        Route::get('cabs', [BookingController::class, 'cabs'])->name('cabs');
        Route::get('bikes', [BookingController::class, 'bikes'])->name('bikes');
        Route::get('boat-trips', [BookingController::class, 'boatTrips'])->name('boat-trips');
    });
});


Route::middleware([])->group(function () {
    Route::prefix('andaman-tour-packages')->name('tours.')->group(function () {
        Route::post('booking', [TourController::class, 'booking'])->name('booking');
        Route::get('custom-booking-package', [TourController::class, 'customBooking'])->name('booking.custom');
        Route::get('/', [TourController::class, 'index'])->name('index');
    });


    Route::get('andaman-{slug}-tour-{subslug}', [TourController::class, 'show'])
        ->name('tour.dynamic.category');

    Route::get('andaman-{slug}-tour-{subslug}', [TourController::class, 'show'])->name('tour.dynamic.category');
    Route::get('andaman-{slug}-packages', [TourController::class, 'static'])
        ->where('slug', '[A-Za-z0-9\-]+')
        ->name('tour.home');


    Route::match(['get', 'post'], '/{category}/andaman-{slug}-tour-{subslug}/itinerary', [TourController::class, 'itinerary'])->name('tour.itinerary');

    Route::get('/{category?}/andaman-{slug}-tour-{subslug}', [TourController::class, 'show'])
        ->name('tour.static');


    Route::get('travel-packages/preview/book', [TourController::class, 'bookNow'])->name('tour.book');
    Route::post('/store-temp-itinerary', [TourController::class, 'storeTempItinerary']);
});
Route::get('travel-itinerary', [TourController::class, 'downloadItinerart'])->name('travel-itinerary');
Route::get('package-payment-voucher', [TourController::class, 'downloadPackageVoucher'])->name('package-voucher');
Route::post('booking-thank-you', [TourController::class, 'thankYou'])->name('thank-you');
Route::prefix('tbo')->group(function () {
    Route::get('/test-hotel-service', [TboHotelController::class, 'showHotel']);
});

Route::middleware([])->group(function () {
    Route::resource('hotels', controller: HotelController::class);
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotel.index');
    Route::prefix('hotels')->name('hotels.')->group(function () {
        Route::post('booking', [HotelController::class, 'booking'])->name('booking');
    });
    Route::post('hotels/search', [HotelController::class, 'show'])->name('hotels.search');
    Route::post('/hotel-search/fetch-chunk', [HotelController::class, 'fetchAllChunks'])->name('hotel.fetchChunk');

    Route::post('hotel/{slug}', [HotelController::class, 'static'])->name('hotel.static');
    Route::post('hotel/payment-review/submit', [HotelController::class, 'paymentSubmit'])->name('hotel.book.submit');
    Route::post('hotel/payment/update', [HotelController::class, 'updatePayment'])->name('hotel.payment.update');
    Route::get('hotel/payment-voucher/{book_id}', [HotelController::class, 'hotelPaymentVoucher'])->name('hotel.payment.voucher');
    Route::get('hotel/package-voucher/{book_id}', [HotelController::class, 'hotelPackagePaymentVoucher'])->name('hotel.package.voucher');

    Route::post('hotel/payment-review/{slug}', [HotelController::class, 'paymentReview'])->name('hotel.review');
});


Route::middleware([])->group(function () {
    Route::prefix('activities')->name('activities.')->group(function () {
        Route::post('booking', [ActivityController::class, 'booking'])->name('booking');
        Route::get('/', [ActivityController::class, 'index'])->name('index');
    });
    Route::get('activity/{url}', [ActivityController::class, 'dynamic'])->name('activity.view');
    Route::get('activities/{slug}', [ActivityController::class, 'devIndex'])->name('activity.static');
    Route::get('activity/booking/review', [ActivityController::class, 'PaymentReview'])->name('activity.review');
    Route::post('activity/paymentsubmit', [ActivityController::class, 'Paymentsubmit'])->name('activity.paymentsubmit');
    Route::post('activity/send-enquiry', [ActivityController::class, 'SendEnquiry'])->name('activity.send-enquiry');
    Route::post('activity/payment/update', [ActivityController::class, 'updatePayment'])->name('activity.payment.update');
    Route::get('activity/payment-voucher/{book_id}', [ActivityController::class, 'ActivityPaymentVoucher'])->name('activity.payment.voucher');
    Route::get('activity/package-voucher/{ticket_no}', [ActivityController::class, 'ActivityPackagePaymentVoucher'])->name('activity.package.voucher');
});

Route::get('andaman-tour-packages-from-{city}', function ($city) {
    if (View::exists('city-packages.' . $city)) {
        $tours = TourPackages::with(['tourPhotos', 'tourCategory', 'subCategories'])->inRandomOrder()->where('status', 1)->take(6)->get();
        $tours->each(function ($tour) {
            $tour->start_price = optional($tour->subCategories->first())->pivot_starts_from ?? $tour->package_cost;
        });
        $reviews = GoogleReview::where('comment', '!=', null)->take(10)->get();
        return view('city-packages.' . $city, compact('tours', 'reviews'));
    }
    abort(404);
})->name('city-packages');

Route::middleware([])->group(function () {
    Route::get('ferry-booking', [CruiseController::class, 'dev'])->name('cruises');


    Route::prefix('ferry-booking')->name('ferry-booking.')->group(function () {
        Route::post('booking', [CruiseController::class, 'booking'])->name('booking');
    });
});

Route::middleware([])->group(function () {
    Route::get('cabs', [CabController::class, 'index'])->name('cabs');
    Route::match(['post', 'get'], 'cab-checkout', [CabController::class, 'checkout'])->name('cab.checkout');
    Route::match(['post', 'get'], 'payment-confirmation', [CabController::class, 'paymentConfirm'])->name('cab.confirm');
    Route::post('cabs-locations', [CabController::class, 'cabLocations'])->name('cab.locationChange');
    Route::get('cab-voucher/{bookingId}', [CabController::class, 'cabVoucher'])->name('cab.voucher');
    Route::prefix('cabs')->name('cabs.')->group(function () {
        Route::post('booking', [CabController::class, 'booking'])->name('booking');
    });
});

Route::get('get-locations', [HomeController::class, 'getLocations'])->name('get.locations');
Route::post('/cabs/submit', [CabController::class, 'store'])->name('cabs.store');

Route::middleware([])->group(function () {
    Route::prefix('bikes')->name('bikes.')->group(function () {
        Route::post('booking', [BikeController::class, 'booking'])->name('booking');
    });

    Route::get('bike/booking-voucher/{bookingId}', [BikeController::class, 'voucher'])->name('bike.voucher');
    Route::match(['get', 'post'], '/bikes', [BikeController::class, 'bookBike'])->name('bike.book');
    Route::post('/book/bikes/review', [BikeController::class, 'bookingReview'])->name('bike.book.review');
});

Route::get('boat-trips-locations', [BoatTripsController::class, 'locations'])->name('boat-locations');
Route::get('boat-trips/{url}', [BoatTripsController::class, 'index'])->name('boat-trips');
Route::get('boat-trip-checkout', [BoatTripsController::class, 'checkout'])->name('boat-trip-checkout');
Route::post('boat-trip-pay', [BoatTripsController::class, 'pay'])->name('boat-trip-pay');
Route::post('boat-trip-pay-verify', [BoatTripsController::class, 'updatePayment'])->name('boat-trip-payment.success');
Route::get('boat-trip-voucher/{bookingId}', [BoatTripsController::class, 'bookingVoucher'])->name('boat-trip-voucher');

Route::prefix('islands')->name('islands.')->group(function () {
    Route::prefix('port-blair')->name('port-blair.')->group(function () {

        Route::get('/', function () {
            return view('islands.port-blair.index');
        })->name('index');

        Route::get('jolly-buoy-island', function () {
            return view('islands.port-blair.jolly-buoy-island');
        })->name('jolly-buoy-island');

        Route::get('cellular-jail', function () {
            return view('islands.port-blair.cellular-jail');
        })->name('cellular-jail');

        Route::get('north-bay-island', function () {
            return view('islands.port-blair.north-bay-island');
        })->name('north-bay-island');

        Route::get('ross-island', function () {
            return view('islands.port-blair.ross-island');
        })->name('ross-island');

        Route::get('chidiatapu', function () {
            return view('islands.port-blair.chidiatapu');
        })->name('chidiatapu');

        Route::get('corbyns-cove', function () {
            return view('islands.port-blair.corbyns-cove');
        })->name('corbyns-cove');

        Route::get('museums', function () {
            return view('islands.port-blair.museums');
        })->name('museums');

        Route::get('flag-point', function () {
            return view('islands.port-blair.flag-point');
        })->name('flag-point');

        Route::get('rajiv-gandhi-water-sports-complex', function () {
            return view('islands.port-blair.rajiv-gandhi-water-sports-complex');
        })->name('rajiv-gandhi-water-sports-complex');


        Route::get('chatham-saw-mill', function () {
            return view('islands.port-blair.chatham-saw-mill');
        })->name('chatham-saw-mill');

        Route::get('rutland-island', function () {
            return view('islands.port-blair.rutland-island');
        })->name('rutland-island');

        Route::get('cinque-island', function () {
            return view('islands.port-blair.cinque-island');
        })->name('cinque-island');

        Route::get('mahatma-gandhi-marine-national-park', function () {
            return view('islands.port-blair.mahatma-gandhi-marine-national-park');
        })->name('mahatma-gandhi-marine-national-park');
    });

    Route::prefix('havelock-swaraj-dweep')->name('havelock-swaraj-dweep.')->group(function () {
        Route::get('/', function () {
            return view('islands.havelock-swaraj-dweep.index');
        })->name('index');

        Route::get('radhanagar-beach', function () {
            return view('islands.havelock-swaraj-dweep.radhanagar-beach');
        })->name('radhanagar-beach');

        Route::get('elephant-beach', function () {
            return view('islands.havelock-swaraj-dweep.elephant-beach');
        })->name('elephant-beach');

        Route::get('kalapathar-beach', function () {
            return view('islands.havelock-swaraj-dweep.kalapathar-beach');
        })->name('kalapathar-beach');
    });

    Route::prefix('neil-shaheed-dweep')->name('neil-shaheed-dweep.')->group(function () {
        Route::get('/', function () {
            return view('islands.neil-shaheed-dweep.index');
        })->name('index');

        Route::get('laxmanpur-beach', function () {
            return view('islands.neil-shaheed-dweep.laxmanpur-beach');
        })->name('laxmanpur-beach');

        Route::get('bharatpur-beach', function () {
            return view('islands.neil-shaheed-dweep.bharatpur-beach');
        })->name('bharatpur-beach');

        Route::get('natural-rock', function () {
            return view('islands.neil-shaheed-dweep.natural-rock');
        })->name('natural-rock');

        Route::get('sitapur-beach', function () {
            return view('islands.neil-shaheed-dweep.sitapur-beach');
        })->name('sitapur-beach');
    });

    Route::prefix('barren-island')->name('barren-island.')->group(function () {
        Route::get('/', function () {
            return view('islands.barren-island.index');
        })->name('index');
    });

    Route::prefix('mayabunder')->name('mayabunder.')->group(function () {
        Route::get('/', function () {
            return view('islands.mayabunder.index');
        })->name('index');

        Route::get('karmatang-beach', function () {
            return view('islands.mayabunder.karmatang-beach');
        })->name('karmatang-beach');

        Route::get('avis-island', function () {
            return view('islands.mayabunder.avis-island');
        })->name('avis-island');

        Route::get('german-jetty', function () {
            return view('islands.mayabunder.german-jetty');
        })->name('german-jetty');
    });

    Route::prefix('little-andaman')->name('little-andaman.')->group(function () {
        Route::get('/', function () {
            return view('islands.little-andaman.index');
        })->name('index');

        Route::get('butler-bay-beach', function () {
            return view('islands.little-andaman.butler-bay-beach');
        })->name('butler-bay-beach');

        Route::get('kalapathar-limestone-caves', function () {
            return view('islands.little-andaman.kalapathar-limestone-caves');
        })->name('kalapathar-limestone-caves');

        Route::get('white-surf-waterfall', function () {
            return view('islands.little-andaman.white-surf-waterfall');
        })->name('white-surf-waterfall');

        Route::get('whisper-wave-waterfall', function () {
            return view('islands.little-andaman.whisper-wave-waterfall');
        })->name('whisper-wave-waterfall');

        Route::get('red-palm-oil-plantation', function () {
            return view('islands.little-andaman.red-palm-oil-plantation');
        })->name('red-palm-oil-plantation');

        Route::get('light-house', function () {
            return view('islands.little-andaman.light-house');
        })->name('light-house');
    });

    Route::prefix('baratang')->name('baratang.')->group(function () {
        Route::get('/', function () {
            return view('islands.baratang.index');
        })->name('index');

        Route::get('lime-stone-caves', function () {
            return view('islands.baratang.lime-stone-caves');
        })->name('lime-stone-caves');

        Route::get('mud-volcano', function () {
            return view('islands.baratang.mud-volcano');
        })->name('mud-volcano');

        Route::get('parrot-island', function () {
            return view('islands.baratang.parrot-island');
        })->name('parrot-island');
    });

    Route::prefix('long-island')->name('long-island.')->group(function () {
        Route::get('/', function () {
            return view('islands.long-island.index');
        })->name('index');

        Route::get('lalaji-bay-beach', function () {
            return view('islands.long-island.lalaji-bay-beach');
        })->name('lalaji-bay-beach');

        Route::get('guitar-island', function () {
            return view('islands.long-island.guitar-island');
        })->name('guitar-island');

        Route::get('merk-bay-beach-north-passage-island', function () {
            return view('islands.long-island.merk-bay-beach-north-passage-island');
        })->name('merk-bay-beach-north-passage-island');
    });

    Route::prefix('diglipur')->name('diglipur.')->group(function () {
        Route::get('/', function () {
            return view('islands.diglipur.index');
        })->name('index');

        Route::get('ross-and-smith-island', function () {
            return view('islands.diglipur.ross-and-smith-island');
        })->name('ross-and-smith-island');

        Route::get('saddle-peak', function () {
            return view('islands.diglipur.saddle-peak');
        })->name('saddle-peak');

        Route::get('kalipur-beach', function () {
            return view('islands.diglipur.kalipur-beach');
        })->name('kalipur-beach');

        Route::get('ramnagar-beach', function () {
            return view('islands.diglipur.ramnagar-beach');
        })->name('ramnagar-beach');

        Route::get('mud-volcanoes-of-shyamnagar', function () {
            return view('islands.diglipur.mud-volcanoes-of-shyamnagar');
        })->name('mud-volcanoes-of-shyamnagar');

        Route::get('alfred-caves', function () {
            return view('islands.diglipur.alfred-caves');
        })->name('alfred-caves');

        Route::get('lamiya-bay-beach', function () {
            return view('islands.diglipur.lamiya-bay-beach');
        })->name('lamiya-bay-beach');

        Route::get('aerial-bay', function () {
            return view('islands.diglipur.aerial-bay');
        })->name('aerial-bay');

        Route::get('patti-level', function () {
            return view('islands.diglipur.patti-level');
        })->name('patti-level');
    });

    Route::prefix('rangat')->name('rangat.')->group(function () {
        Route::get('/', function () {
            return view('islands.rangat.index');
        })->name('index');

        Route::get('dhaninallah-mangrove-walkway', function () {
            return view('islands.rangat.dhaninallah-mangrove-walkway');
        })->name('dhaninallah-mangrove-walkway');

        Route::get('morrice-dera-beach', function () {
            return view('islands.rangat.morrice-dera-beach');
        })->name('morrice-dera-beach');

        Route::get('yeratta-creek', function () {
            return view('islands.rangat.yeratta-creek');
        })->name('yeratta-creek');

        Route::get('ambkunj-beach', function () {
            return view('islands.rangat.ambkunj-beach');
        })->name('ambkunj-beach');

        Route::get('panchavati-waterfalls', function () {
            return view('islands.rangat.panchavati-waterfalls');
        })->name('panchavati-waterfalls');

        Route::get('curtbert-bay-beach', function () {
            return view('islands.rangat.curtbert-bay-beach');
        })->name('curtbert-bay-beach');
    });
});



Route::get('best-places-to-visit', function () {
    return view('pages.best-places');
})->name('best-places');


//Dev islands end


Route::middleware([])->group(function () {
    Route::resource('blogs', BlogController::class);

    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::post('comment', [BlogController::class, 'comment'])->name('comment');
    });
});
Route::get('/booking-ticket/{token}', [FerryTickets::class, 'index'])->name('ferry-ticket');
Route::get('/review', [PaymentController::class, 'index'])->name('review.pay');

Route::get('/', [HomeController::class, 'devindex'])->name('index');
Route::match(['get', 'post'], '/booking-details/{token}', [FerryTickets::class, 'bookings'])->name('booking-details');
Route::post('booking/confirm/{bookId}', [PaymentController::class, 'bill'])->name('booking.bill');

Route::any('contact', [HomeController::class, 'contact'])->name('contact')->middleware('throttle:5,1');;
Route::post('/cabs/search', [CabController::class, 'search']);
Route::match(['get', 'post'], '/bikes/search', [BikeController::class, 'search'])->name('bikes.search');
Route::get('about', [AboutController::class, 'index'])->name('about');

//boat activity z
Route::get('game-fishing-in-andaman', [BoatCharterFishing::class, 'gameFishing'])->name('game-fishing');
Route::get('charter-boat', [BoatCharterFishing::class, 'boatCharter'])->name('boat-chater');
Route::post('boat-activity/contact', [BoatCharterFishing::class, 'GameFishEnquiry'])->name('boat-contact');
Route::post('boat-activity/boat-chater/contact', [BoatCharterFishing::class, 'BoatChaterEnquiry'])->name('boat-chater-contact');
//end boat activity


Route::post('custom-trip.submit', [HomeController::class, 'customTripSubmit'])->name('custom-trip.submit');
Route::post('activity-enquiry', [ActivityController::class, 'activityEnquiry'])->name('activity.enquiry');


Route::get('/get-itinerary/{id}', [BoatCharterFishing::class, 'getItinerary']);
Route::get('/get-booking-form/{id}', [BoatCharterFishing::class, 'getBookingForm']);
Route::post('travel-packages/payment', [TourController::class, 'Payment'])->name('tour.pay');
Route::post('travel-packages/payment/success', [TourController::class, 'updatePayment'])->name('tour.success');


$pages = [
    'terms-conditions',
    'cancellation-policy',
    'privacy-policy',
    'press-media',
    'announcement',
    'visa-info',
    'bank-accounts',
    // 'payment',
    'faqs',
    'feedback',
    'weather',
    'how-to-reach',
    'photography-in-andaman',
    'videography',
    'careers',
    'students-educational-trip-to-andaman',
    'contact'
];


foreach ($pages as $page) {
    Route::get($page, function () use ($page) {
        $prefix = request()->is('dev/*') ? 'dev.' : '';
        return view($prefix . 'pages.' . $page);
    })->name($page);
}






// Route::get('/google/auth', [GoogleReviewController::class, 'redirectToGoogle'])->name('google.auth');
// Route::get('/google/callback', [GoogleReviewController::class, 'handleCallback'])->name('google.callback');
// Route::get('/google/accounts', [GoogleReviewController::class, 'listAccounts'])->name('google.accounts');
// Route::get('/google/locations/{accountId}', [GoogleReviewController::class, 'listLocations'])->name('google.locations');
// Route::get('/google/reviews', [GoogleReviewController::class, 'fetchReviews'])->name('google.reviews');
// Route::get('/google/place/reviews', [GoogleReviewController::class, 'fetchPlacesReviews'])->name('google.reviews');


Route::post('save-push-notification-sub', [PushNotificationController::class, 'saveSubscription']);
Route::post('send-push-notification', [PushNotificationController::class, 'sendNotification']);
Route::post('/track-duration', [PushNotificationController::class, 'duration']);

Route::get('/dev/update-review', [GoogleReviewController::class, 'fetchNewReviews'])->middleware('auth')->name('google.reviews.store');

Route::get('/auth/google/login', function () {
    session(['url.intended' => url()->previous()]);
    return Socialite::driver('google')
        ->scopes(['openid', 'email', 'profile'])
        ->stateless()
        ->redirect();
})->name('google.login');


Route::get('/auth/google/register', function () {
    session(['url.intended' => url()->previous()]);
    return Socialite::driver('google')
         ->scopes([
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
            'openid'
        ])
        ->with(['access_type' => 'offline', 'prompt' => 'consent'])
        ->stateless()
        ->redirect();
})->name('google.register');


Route::get('/auth/google/callback', function () {
    try {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->user();

        if (!$googleUser || !$googleUser->email) {
            return redirect('/login')->with('error', 'Unable to fetch Google account.');
        }

        if ($googleUser->refreshToken) {
            Cache::put('google_refresh_token', $googleUser->refreshToken, now()->addDays(365));
        }

        return app(\App\Http\Controllers\Auth\RegisterController::class)
            ->googleCallback($googleUser);

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Google login failed: ' . $e->getMessage());
    }
});



Route::get('/upsale', [upSaleController::class, 'index'])->name('upsale.index');
