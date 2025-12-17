<?php

use App\Http\Controllers\Admin\TourPackageBooking;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AddonController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\CruiseController;
use App\Http\Controllers\Admin\CabController;
use App\Http\Controllers\Admin\BikeController;
use App\Http\Controllers\Admin\BoatCharterController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\CabPackageController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BoatTripsController;
use App\Http\Controllers\Admin\DeleteController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\TagController;
use Google\Service\Spanner\Delete;
use Google\Service\TagManager;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return redirect('admin/login');
});

Route::middleware(['guest:admin'])->group(function () {
	// Login
	Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
	Route::post('login', [LoginController::class, 'login']);

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

Route::middleware(['auth:admin', 'admin'])->group(function () {
	// Logout
	Route::any('logout', [LoginController::class, 'logout'])->name('logout');

	// Change Password
	Route::prefix('password')->name('password.')->group(function () {
		Route::get('change', [ChangePasswordController::class, 'showChangeForm'])->name('change');
		Route::post('change', [ChangePasswordController::class, 'change'])->name('store');
	});

	Route::get('home', [HomeController::class, 'index'])->name('home');

	Route::middleware(['role:admin|manager'])->group(function () {
		Route::resource('employees', EmployeeController::class);
		Route::prefix('employees')->name('employees.')->group(function () {
			Route::post('changeStatus', [EmployeeController::class, 'changeStatus'])->name('changeStatus');
			Route::delete('{id}/destroy', [EmployeeController::class, 'destroy'])->name('employees.destroy');
			Route::get('{id}/resendMail', [EmployeeController::class, 'resendMail'])->name('resendMail');
		});

		Route::resource('cars', CarController::class);
		Route::prefix('cars')->name('cars.')->group(function () {
			Route::post('changeStatus', [CarController::class, 'changeStatus'])->name('changeStatus');
		});

		Route::resource('categories', CategoryController::class);
		Route::prefix('categories')->name('categories.')->group(function () {
			Route::any('{categoryId}/images/{id?}', [CategoryController::class, 'images'])->name('images');
			Route::any('{categoryId}/facilities/{id?}', [CategoryController::class, 'facilities'])->name('facilities');
			Route::any('{categoryId}/faqs/{id?}', [CategoryController::class, 'faqs'])->name('faqs');
			Route::any('{categoryId}/reviews/{id?}', [CategoryController::class, 'reviews'])->name('reviews');
			Route::any('{categoryId}/meta-headings', [CategoryController::class, 'metaTags'])->name('meta-headings');
			Route::any('{categoryId}/content-section', [CategoryController::class, 'contentSection'])->name('content-section');
		});

		Route::resource('addons', AddonController::class);
		Route::prefix('addons')->name('addons.')->group(function () {
			Route::any('{addonId}/images/{id?}', [AddonController::class, 'images'])->name('images');
		});


		Route::resource('tours', TourController::class);
		Route::prefix('tours')->name('tours.')->group(function () {
			Route::post('changeStatus', [TourController::class, 'changeStatus'])->name('changeStatus');
			Route::any('package/services', [TourController::class, 'tourServices'])->name('services');
			Route::any('package/activity-services', [TourController::class, 'activityServices'])->name('activityServices');
			Route::any('package/ferry-services', [TourController::class, 'ferryServices'])->name('ferryServices');
			Route::any('package/payment-breakup/{id?}', [TourController::class, 'priceBreakup'])->name('pricingBreakup');
			Route::any('{tourId}/images/{id?}', [TourController::class, 'images'])->name('images');
			Route::any('{tourId}/pricing/{id?}', [TourController::class, 'pricing'])->name('pricing');
			Route::any('{tourId}/roomtypes/{id?}', [TourController::class, 'roomtypes'])->name('roomtypes');
			Route::any('{tourId}/why-us/{id?}', [TourController::class, 'facilities'])->name('why-us');
			Route::any('{tourId}/policies/{id?}', [TourController::class, 'policies'])->name('policies');
			Route::any('{tourId}/faqs/{id?}', [TourController::class, 'faqs'])->name('faqs');
			Route::any('{tourId}/experiences/{id?}', [TourController::class, 'experiences'])->name('experiences');
			Route::any('{tourId}/reviews/{id?}', [TourController::class, 'reviews'])->name('reviews');
			Route::any('/{tourId}/inclusion-exclusions/{id?}', [TourController::class, 'inclusionExclusions'])->name('inclusion-exclusions');
			Route::any('/{tourId}/itinerary', [TourController::class, 'packageItinerary'])->name('itinerary');
			Route::any('{tourId}/meta-headings', [TourController::class, 'metaTags'])->name('meta-headings');
			Route::post('/{tourId}/itinerary/services/store', [TourController::class, 'storePackageItinerary'])->name('itinerary.store');
		});

		Route::resource('boat-trips', BoatTripsController::class);
		Route::any('/boat-locations/{id?}', [BoatTripsController::class, 'locations'])->name('trip-locations');
		Route::prefix('boat-trips')->name('boat-trips.')->group(function () {
			Route::get('location/{location?}', [BoatTripsController::class, 'index'])->name('location');
			Route::any('{tripId}/read-more-content', [BoatTripsController::class, 'readMoreContent'])->name('read-more-content');
			Route::any('{tripId}/faqs/{id?}', [BoatTripsController::class, 'faqs'])->name('faqs');
			Route::any('{tripId}/content-blocks/{id?}', [BoatTripsController::class, 'contentBlock'])->name('content-blocks');
			Route::any('{tripId}/meta-headings', [BoatTripsController::class, 'metaTags'])->name('meta-headings');
			Route::any('{tripId}/images/{id?}', [BoatTripsController::class, 'images'])->name('images');
		});

		// Route::resource('tours', TourController::class);
		// Route::prefix('tours')->name('tours.')->group(function () {
		// 	Route::post('changeStatus', [TourController::class, 'changeStatus'])->name('changeStatus');
		// 	Route::any('{tourId}/images/{id?}', [TourController::class, 'images'])->name('images');
		// 	Route::any('{tourId}/roomtypes/{id?}', [TourController::class, 'roomtypes'])->name('roomtypes');
		// 	Route::any('{tourId}/facilities/{id?}', [TourController::class, 'facilities'])->name('facilities');
		// 	Route::any('{tourId}/policies/{id?}', [TourController::class, 'policies'])->name('policies');
		// 	Route::any('{tourId}/faqs/{id?}', [TourController::class, 'faqs'])->name('faqs');
		// 	Route::any('{tourId}/reviews/{id?}', [TourController::class, 'reviews'])->name('reviews');
		// });

		Route::resource('hotels', HotelController::class);
		Route::prefix('hotels')->name('hotels.')->group(function () {
			Route::post('changeStatus', [HotelController::class, 'changeStatus'])->name('changeStatus');
			Route::any('{hotelId}/images/{id?}', [HotelController::class, 'images'])->name('images');
			Route::any('{hotelId}/roomtypes/{id?}', [HotelController::class, 'roomtypes'])->name('roomtypes');
			Route::any('{hotelId}/facilities/{id?}', [HotelController::class, 'facilities'])->name('facilities');
			Route::any('{hotelId}/policies/{id?}', [HotelController::class, 'policies'])->name('policies');
			Route::any('{hotelId}/faqs/{id?}', [HotelController::class, 'faqs'])->name('faqs');
			Route::any('{hotelId}/reviews/{id?}', [HotelController::class, 'reviews'])->name('reviews');
		});

		Route::resource('activities', ActivityController::class);
		Route::prefix('activities')->name('activities.')->group(function () {
			Route::any('{activityId}/images/{id?}', [ActivityController::class, 'images'])->name('images');
			Route::any('{activityId}/overview', [ActivityController::class, 'overview'])->name('overview');
			Route::any('{activityId}/day-schedules/{id?}', [ActivityController::class, 'daySchedule'])->name('daySchedule');
			Route::any('{activityId}/content-blocks/{id?}', [ActivityController::class, 'contentBlock'])->name('content-blocks');
			Route::any('{activityId}/meta-headings', [ActivityController::class, 'metaTags'])->name('meta-headings');
			Route::any('{activityId}/facilities/{id?}', [ActivityController::class, 'facilities'])->name('facilities');
			Route::any('{activityId}/info-blocks/{id?}', [ActivityController::class, 'quickBlocks'])->name('quickBlocks');
			Route::any('{activityId}/highlights/{id?}', [ActivityController::class, 'highlights'])->name('highlights');
			Route::any('{activityId}/faqs/{id?}', [ActivityController::class, 'faqs'])->name('faqs');
			Route::any('{activityId}/reviews/{id?}', [ActivityController::class, 'reviews'])->name('reviews');
			Route::any('{activityId}/slots/{id?}', [ActivityController::class, 'Slots'])->name('slots');
			Route::post('{activityId}/cange-status', [ActivityController::class, 'changeStatus'])->name('changeStatus');
		});


		Route::resource('reviews', ReviewsController::class);
		Route::prefix('reviews')->name('reviews')->group(function () {
			Route::post('reviews/{id}/destroy', [ReviewsController::class, 'destroy'])->name('reviews.destroy');

		});



		Route::resource('blogs', BlogController::class);

		Route::prefix('tag-manager')->name('tag-manager.')->group(function() {
			Route::get('/', [TagController::class,'index'])->name('index');
			Route::post('/',[TagController::class,'store'])->name('store');
			Route::get('{id}/edit',[TagController::class,'edit'])->name('edit');
			Route::put('{id}/update',[TagController::class,'update'])->name('update');
			Route::delete('{id}/delete',[TagController::class,'destroy'])->name('destroy');
			Route::get('/pages',[TagController::class,'tagPages'])->name('pages');
			Route::post('/pages',[TagController::class,'storePages'])->name('pages.store');
			Route::get('/pages/{id}/edit',[TagController::class, 'editPages'])->name('pages.edit');
			Route::put('/pages/{id}/update',[TagController::class, 'updatePages'])->name('pages.update');
			Route::delete('/pages/{id}/delete',[TagController::class , 'tagDestroy'])->name('pages.destroy');
			Route::get('pages/{id}/page-tags',[TagController::class , 'pageTags'])->name('pages.tags');
			Route::post('pages/{id}/page-tags',[TagController::class,'storePageTags'])->name('pages.tags.store');
		});

		Route::prefix('blogs')->name('blogs.')->group(function () {
			Route::post('/upload-image', [BlogController::class, 'uploadImage'])->name('upload-image');
			Route::post('/change-status', [BlogController::class, 'changeStatus'])->name('changeStatus');
			Route::post('/change-featured', [BlogController::class, 'changeFeatured'])->name('changeFeatured');
			Route::delete('{id}/destroy', [BlogController::class, 'destroy'])->name('destroy');
		});


		Route::resource('cruises', CruiseController::class);
		Route::prefix('cruises')->name('cruises.')->group(function () {
			Route::post('changeStatus', [CruiseController::class, 'changeStatus'])->name('changeStatus');
			Route::any('{cruiseId}/images/{id?}', [CruiseController::class, 'images'])->name('images');
			Route::any('{cruiseId}/roomtypes/{id?}', [CruiseController::class, 'roomtypes'])->name('roomtypes');
			Route::any('{cruiseId}/facilities/{id?}', [CruiseController::class, 'facilities'])->name('facilities');
			Route::any('{cruiseId}/policies/{id?}', [CruiseController::class, 'policies'])->name('policies');
			Route::any('{cruiseId}/faqs/{id?}', [CruiseController::class, 'faqs'])->name('faqs');
			Route::any('{cruiseId}/reviews/{id?}', [CruiseController::class, 'reviews'])->name('reviews');
		});

		Route::resource('cabs', CabController::class);
		Route::prefix('cabs')->name('cabs.')->group(function () {
			Route::post('changeStatus', [CabController::class, 'changeStatus'])->name('changeStatus');
			Route::any('{cabId}/images/{id?}', [CabController::class, 'images'])->name('images');
			Route::any('{cabId}/pricing/{id?}', [CabController::class, 'pricing'])->name('pricing');
			Route::any('{cabId}/roomtypes/{id?}', [CabController::class, 'roomtypes'])->name('roomtypes');
			Route::any('{cabId}/facilities/{id?}', [CabController::class, 'facilities'])->name('facilities');
			Route::any('{cabId}/policies/{id?}', [CabController::class, 'policies'])->name('policies');
			Route::any('{cabId}/faqs/{id?}', [CabController::class, 'faqs'])->name('faqs');
			Route::any('{cabId}/reviews/{id?}', [CabController::class, 'reviews'])->name('reviews');
		});


		Route::prefix('cab/packages')->group(function () {
			Route::get('/', [CabPackageController::class, 'index'])->name('cab-package.index');
			Route::get('/create', [CabPackageController::class, 'create'])->name('cab-package.create');
			Route::post('/', [CabPackageController::class, 'store'])->name('cab-package.store');
			Route::get('/{id}/edit', [CabPackageController::class, 'edit'])->name('cab-package.edit');
			Route::put('/{id}', [CabPackageController::class, 'update'])->name('cab-package.update');
			Route::delete('/{id}', [CabPackageController::class, 'destroy'])->name('cab-package.destroy');
			Route::get('/pricing', [CabPackageController::class, 'pricing'])->name('cab-package.pricing');
			Route::post('/pricing/store', [CabPackageController::class, 'pricingStore'])->name('cab-package.pricing.store');
			Route::put('/admin/cab-pricing/{id}', [CabPackageController::class, 'pricingUpdate'])->name('cab-package.pricing.update');
			Route::get('/pricing/{id}/edit', [CabPackageController::class, 'pricingEdit'])->name('cab-package.pricing.edit');
			Route::get('/pricing/create', [CabPackageController::class, 'pricingCreate'])->name('cab-package.pricing.create');
			Route::delete('/pricing/{id}', [CabPackageController::class, 'pricingDestroy'])->name('cab-package.pricing.destroy');
		});

		Route::resource('push-notifications', NotificationController::class);

		Route::prefix('boat-charter')->group(function () {
			Route::get('/', [BoatCharterController::class, 'index'])->name('boat-charter.index');
			Route::get('/create', [BoatCharterController::class, 'create'])->name('boat-charter.create');
			Route::post('/', [BoatCharterController::class, 'store'])->name('boat-charter.store');
			Route::get('/{id}', [BoatCharterController::class, 'show'])->name('boat-charter.show');
			Route::get('/{id}/edit', [BoatCharterController::class, 'edit'])->name('boat-charter.edit');
			Route::put('/{id}', [BoatCharterController::class, 'update'])->name('boat-charter.update');
			Route::delete('/{id}', [BoatCharterController::class, 'destroy'])->name('boat-charter.destroy');

			Route::get('/{id}/seasonal-prices', [BoatCharterController::class, 'seasonalPrice'])->name('boat-charter.seasonal-prices.create');
			Route::post('/{id}/seasonal-prices', [BoatCharterController::class, 'storeSeasonalPrice'])->name('boat-charter.seasonal-prices.store');
			Route::put('/{id}/seasonal-prices/{price_id}', [BoatCharterController::class, 'updateSeasonalPrice'])->name('boat-charter.seasonal-prices.update');
			Route::delete('/{id}/seasonal-prices/{price_id}', [BoatCharterController::class, 'destroySeasonalPrice'])->name('boat-charter.seasonal-prices.destroy');

			Route::get('/{id}/inclusion-exclusions', [BoatCharterController::class, 'inclusionExclusions'])->name('boat-charter.inclusion-exclusions');
			Route::get('/{id}/inclusion-exclusions/create', [BoatCharterController::class, 'createInclusionExclusion'])->name('boat-charter.inclusion-exclusions.create');
			Route::post('/{id}/inclusion-exclusions', [BoatCharterController::class, 'storeInclusionExclusion'])->name('boat-charter.inclusion-exclusions.store');
			Route::put('/{id}/inclusion-exclusions/{item_id}', [BoatCharterController::class, 'updateInclusionExclusion'])->name('boat-charter.inclusion-exclusions.update');
			Route::delete('/{id}/inclusion-exclusions/{item_id}', [BoatCharterController::class, 'destroyInclusionExclusion'])->name('boat-charter.inclusion-exclusions.destroy');

			Route::get('/{id}/fishes-found', [BoatCharterController::class, 'fishesFound'])->name('boat-charter.fishes-found');
			Route::get('/{id}/fishes-found/create', [BoatCharterController::class, 'createFishesFound'])->name('boat-charter.fishes-found.create');
			Route::post('/{id}/fishes-found', [BoatCharterController::class, 'storeFishesFound'])->name('boat-charter.fishes-found.store');
			Route::put('/{id}/fishes-found/{fish_id}', [BoatCharterController::class, 'updateFishesFound'])->name('boat-charter.fishes-found.update');
			Route::delete('/{id}/fishes-found/{fish_id}', [BoatCharterController::class, 'destroyFishesFound'])->name('boat-charter.fishes-found.destroy');

			Route::get('/{id}/boat-itineraries', [BoatCharterController::class, 'boatItineraries'])->name('boat-charter.boat-itineraries');
			Route::get('/{id}/boat-itineraries/create', [BoatCharterController::class, 'createBoatItinerary'])->name('boat-charter.boat-itineraries.create');
			Route::post('/{id}/boat-itineraries', [BoatCharterController::class, 'storeBoatItinerary'])->name('boat-charter.boat-itineraries.store');
			Route::put('/{id}/boat-itineraries/{itinerary_id}', [BoatCharterController::class, 'updateBoatItinerary'])->name('boat-charter.boat-itineraries.update');
			Route::delete('/{id}/boat-itineraries/{itinerary_id}', [BoatCharterController::class, 'destroyBoatItinerary'])->name('boat-charter.boat-itineraries.destroy');

			Route::get('/{id}/images', [BoatCharterController::class, 'ShowImages'])->name('boat-charter.images');
			Route::post('/{id}/images/store', [BoatCharterController::class, 'storeImages'])->name('boat-charter.images.store');
			Route::put('/{id}/images/{image_id}/update', [BoatCharterController::class, 'updateImages'])->name('boat-charter.images.update');
			Route::delete('/{id}/images/{image_id}', [BoatCharterController::class, 'destroyImages'])->name('boat-charter.images.destroy');
		});

		Route::resource('bikes', BikeController::class);
		Route::prefix('bikes')->name('bikes.')->group(function () {
			Route::post('changeStatus', [BikeController::class, 'changeStatus'])->name('changeStatus');
			Route::any('{bikeId}/images/{id?}', [BikeController::class, 'images'])->name('images');
			Route::any('{bikeId}/pricing/{id?}', [BikeController::class, 'pricing'])->name('pricing');
			Route::any('{bikeId}/roomtypes/{id?}', [BikeController::class, 'roomtypes'])->name('roomtypes');
			Route::any('{bikeId}/facilities/{id?}', [BikeController::class, 'facilities'])->name('facilities');
			Route::any('{bikeId}/policies/{id?}', [BikeController::class, 'policies'])->name('policies');
			Route::any('{bikeId}/faqs/{id?}', [BikeController::class, 'faqs'])->name('faqs');
			Route::any('{bikeId}/reviews/{id?}', [BikeController::class, 'reviews'])->name('reviews');
		});

		Route::resource('users', UserController::class);
		Route::prefix('users')->name('users.')->group(function () {
			Route::post('changeStatus', [UserController::class, 'changeStatus'])->name('changeStatus');
			Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
		});

		Route::get('/visitors', [UserController::class, 'visitors'])->name('visitors');
		Route::get('/analytics', [UserController::class, 'heatmap'])->name('analytics');

		Route::resource('teams', TeamController::class);
		Route::prefix('teams')->name('teams.')->group(function () {
			Route::post('changeStatus', [TeamController::class, 'changeStatus'])->name('changeStatus');
			Route::delete('{id}/destroy', [TeamController::class, 'destroy'])->name('destroy');
		});
	});

	Route::middleware(['role:admin|manager|telecaller'])->group(function () {
		// Route::resource('bookings', BookingController::class);
		Route::prefix('bookings')->name('bookings.')->group(function () {
			Route::get('tours', [BookingController::class, 'tours'])->name('tours');
			Route::get('hotels', [BookingController::class, 'hotels'])->name('hotels');
			Route::get('activities', [BookingController::class, 'activities'])->name('activities');
			Route::get('cruises', [BookingController::class, 'cruises'])->name('cruises');
			Route::get('cruises-bookings', [BookingController::class, 'cruiseBookings'])->name('cruises.bookings');
			Route::get('boat-trips', [BookingController::class, 'boatTrips'])->name('boat-trips.bookings');
			Route::get('cabs', [BookingController::class, 'cabs'])->name('cabs');
			Route::get('bikes', [BookingController::class, 'bikes'])->name('bikes');
			Route::delete('enquiry/{id}/destroy', [BookingController::class, 'destroy'])->name('destroy');
			Route::delete('bike-book-destroy/{id}/destroy', [BookingController::class, 'deleteBooking'])->name('destroyBike');
			Route::get('tour-packages', [TourPackageBooking::class, 'index'])->name('tour-package');
			Route::get('tour-packages/{id}/details', [TourPackageBooking::class, 'show'])->name('tour-package-show');
		});

		Route::prefix('delete')->name('delete.')->group(function() {
			Route::post('boat-trips/{id}',[DeleteController::class,'deleteBtrip'])->name('boat-trip');
			Route::post('bike-rent/{id}',[DeleteController::class,'deleteBikeR'])->name('bike-rent');
			Route::post('cab-delete/{id}',[DeleteController::class,'deleteCab'])->name('cab-delete');
			Route::post('ferry-delete/{id}',[DeleteController::class,'deleteFerry'])->name('ferry-delete');
			Route::post('activity-delete/{id}',[DeleteController::class,'deleteActivity'])->name('activity-delete');
			Route::post('hotel-delete/{id}',[DeleteController::class,'deleteHotel'])->name('hotel-delete');
			Route::post('tour-delete/{id}',[DeleteController::class,'deleteTour'])->name('tour-delete');
		});
	});



	Route::middleware(['role:admin|manager|telecaller'])->group(function () {
		Route::resource('leads', LeadController::class);
		Route::prefix('leads')->name('leads.')->group(function () {
			Route::post('changeStatus', [LeadController::class, 'changeStatus'])->name('changeStatus');
		});
	});
});
