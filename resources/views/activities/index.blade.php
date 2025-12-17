@extends('layouts.app')
@section('title', 'Water Activities In Andaman Islands|Book Today')
@section('keywords', 'water activities in andaman, andaman tour packages, Thrilling water activities')
@section('description', 'Andaman Islands is famous for various water activities. Take part in the thrilling and adventerous activites, Book your water activities today with Andaman Bliss')

@section('content')
<section class="tour-page-banner">
    <img src="{{ asset('site/img/travelbg.webp') }}" alt="Andaman Tours Banner" />
    <div class="tour-banner-content">
        <h1>Explore the various <span style="color: #f9680f;">Water Activites In Andaman</span></h1>
        <div class="subtitle">
            <i class="fas fa-compass me-2"></i>Let's Dive into Adventure & Explore the Depths of Ocean Life!
        </div>
    </div>
</section>

@include('common.search2')

<!-- Andamanbliss Tour Packages Section -->
<div class="container">
    <div class="tour-andamanbliss-section mt-3">
        <h2 class="tour-andamanbliss-title">Water Activities In Andaman | <span>Upto 20% Off</span></h2>
        <p class="tour-andamanbliss-text">
            The Andaman Islands are a collection of diverse and picturesque islands located like a string of emeralds in the azure waters of the Bay of Bengal. They are one of India’s best-kept secrets and are a truly tropical paradise with over 500 Islands and each of them has a story to tell.
            <a href="#" class="tour-andamanbliss-read-more" data-bs-toggle="modal"
                data-bs-target="#andamanblissModal">Read More</a>
        </p>
    </div>
</div>

<section id="tour-listing" class="py-5">
    <!-- <div class="tour-section-title">
        <h2>Best Packages<span> For You</span></h2>
    </div> -->

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 d-none d-md-block">
                @include('common.filter')
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="row activity-container">
                    @forelse ($activities as $activity)
                    @php
                    $rate = $activity->adult_cost ?? 0;
                    $price = $activity->adult_cost ?? 0;
                    $hasDiscount = $activity->discount > 0;
                    $discount = $activity->discount;
                    $currency = $activity->currency ?? '₹';
                    $discountAmount = ($rate * $discount) / 100;
                    $price = $rate - $discountAmount;
                    @endphp
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="ab-tour-card">
                            <div class="ab-tour-card-header">
                                @if($hasDiscount)
                                <div class="ab-tour-card-deal">
                                    <span>Exclusive Deal upto {{ $discount }}% <em>-off</em></span>
                                </div>
                                @endif
                                <div class="ab-tour-card-image">
                                    <img src="{{ $activity->activityPhotos[0]->file ?? asset('/placeholder.jpg') }}" alt="{{ __($activity->service_name ?? 'Unnamed Activity') }}">
                                    <div class="ab-tour-card-map-btn">
                                        <span
                                            class="ab-tour-card-duration">{{ ucwords($activity->category->name ?? 'Unknown Category') }} - {{ preg_replace('/(\d)(?=[A-Za-z])/', '$1 ', __($activity->service_name ?? 'Unnamed Activity')) }}</span>
                                        <button class="ab-tour-card-map-button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="{{ $activity->location }}">
                                            <i class="fas fa-map-marker-alt"></i> Map
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="ab-tour-card-content">
                                
                                <h3 class="ab-tour-card-title">
                                   <span class="cat"> {{ ucwords($activity->category->name ?? 'Unknown Category') }}</span>
                                    {{ preg_replace('/(\d)(?=[A-Za-z])/', '$1 ', __($activity->service_name ?? 'Unnamed Activity')) }}
                                </h3>

                                <div class="ab-tour-card-includes">
                                    <div class="ab-tour-includes-header">
                                        <div class="ab-tour-card-icons ">

                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="{{ $activity->duration . '-mins' }}"><i class="fa-solid fa-hourglass-start"></i></span>
                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Guide"><i class="fa-solid fa-user-group"></i></span>
                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Safety"><i class="fa-solid fa-shield-heart"></i></span>
                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Photos"><i class="fas fa-camera"></i></span>
                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="{{ $activity->rating .' star rating' }}"><i class="fa-solid fa-star text-warning"></i></span>
                                        </div>


                                    </div>
                                </div>

                                <div class="ab-tour-card-pricing">
                                    <div class="ab-tour-card-price-info">
                                        <span class="ab-tour-card-price-label">All inclusive price</span>
                                        <div class="ab-tour-card-price">
                                            <span class="ab-tour-card-price-currency">₹</span>
                                            <span class="ab-tour-card-price-amount">{{ number_format($rate, 2) }}</span>
                                            <span class="ab-tour-card-price-asterisk">*</span>
                                        </div>
                                    </div>
                                    <div class="ab-tour-card-emi">
                                        <div class="ab-tour-card-emi-icon">
                                            <i class="fas fa-credit-card text-success"></i>
                                        </div>
                                        <div class="ab-tour-card-emi-details">
                                            <span class="ab-tour-card-emi-label">Instant Confirmation</span>
                                            <span class="ab-tour-card-emi-amount">Available</span>
                                        </div>
                                    </div>
                                </div>

                                @php
                                $activityUrl = $activity->url ?? $activity->slug;
                                @endphp

                                <div class="ab-tour-card-actions">
                                    <a href="{{ route('activity.view', ['url' => $activityUrl]) }}"
                                        class="ab-tour-card-btn ab-tour-view-btn">View Tour</a>
                                    <a href="{{ route('activity.view', ['url' => $activityUrl]) }}" class="ab-tour-card-btn ab-tour-book-btn">Book Online</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p>No activities found.</p>
                    @endforelse
                </div>

                <div class="text-center mt-4 mb-5 {{ $activities->hasMorePages() ? '' : 'd-none' }}"
                    id="load-more-container">
                    <button class="tour-load-more" id="load-more-btn" aria-label="Load more activities">
                        <i class="fas fa-spinner fa-spin d-none" id="load-spinner" aria-hidden="true"></i> Load more
                        activities
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Contact Offcanvas -->
<div class="offcanvas tour-contact-offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel" class="fw-bold">Contact Us</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="tour-contact-item">
            <h6><i class="fas fa-users"></i> Group Tours</h6>
            <p>+91 8900909900</p>
        </div>
        <div class="tour-contact-item">
            <h6><i class="fas fa-heart"></i> Honeymoon Packages</h6>
            <p>+91 9933202248</p>
        </div>
        <div class="tour-contact-item">
            <h6><i class="fas fa-building"></i> Corporate Travel</h6>
            <p>+91 9679503320</p>
        </div>
        <div class="tour-contact-item">
            <h6><i class="fas fa-headset"></i> 24x7 Support</h6>
            <p>+91 9531972987</p>
        </div>
        <div class="tour-contact-item">
            <h6><i class="fas fa-clock"></i> Office Hours</h6>
            <p>9:00 AM to 7:00 PM</p>
        </div>
        <div class="tour-contact-links">
            <a href="#" class="tour-contact-link">Contact Us</a>
            <a href="#" class="tour-contact-link">Our Branches</a>
        </div>
    </div>
</div>

<!-- Andamanbliss Tour Packages Modal -->
<div class="modal fade" id="andamanblissModal" tabindex="-1" aria-labelledby="andamanblissModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable tour-andamanbliss-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="andamanblissModalLabel">Water Activites In Andaman Islands | Upto 20% Off
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="tour-andamanbliss-packages m-0">
                    <div class="tour-andamanbliss-packages-header">
                        <h3>Activity</h3>
                        <div class="duration-price">
                            <div class="col">Duration</div>
                            <div class="col">Price</div>
                        </div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="/water-sports/scuba-diving/scuba-diving-in-havelock-island">Scuba Diving in Havelock</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">45 Minutes</div>
                        <div class="tour-andamanbliss-package-price">INR 3,500</div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="/water-sports/sea-walk/sea-walk-in-elephanta-beach">Sea Walk in Elephanta</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">45 Minutes</div>
                        <div class="tour-andamanbliss-package-price">INR 3,500</div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="/water-sports/glass-bottom-boat-ride/andaman-dolphin-glass-bottom-luxury-boat-ride">Glass Bottom Boat Ride in Havelock</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">45 Minutes</div>
                        <div class="tour-andamanbliss-package-price">INR 3,500</div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="/water-sports/kayaking/night-kayaking-in-port-blair">Kayaking in Portblair</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">1 - 2 Hours</div>
                        <div class="tour-andamanbliss-package-price">INR 3,800</div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="/water-sports/parasailing/parasailing-in-havelock">Parasailing in Havelock</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">30 Minutes</div>
                        <div class="tour-andamanbliss-package-price">INR 3,500</div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="/water-sports/candle-light-dinner/candle-light-dinner-havelock">Candle Light in Havelock</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">3 Hours</div>
                        <div class="tour-andamanbliss-package-price">INR 4,500</div>
                    </div>
                </div>

                <div class="tour-andamanbliss-description">
                    <p>The Andaman Islands are a collection of diverse and picturesque islands located like a string of emeralds in the azure waters of the Bay of Bengal. They are one of India’s best-kept secrets and are a truly tropical paradise with over 500 Islands and each of them has a story to tell. In this enchanting island group, you can see the world-renowned beaches of Radhanagar beach amongst the untouched beauty of lesser-known secret beaches.</p>

                    <p>Each island tells a unique story of nature’s beauty, adventure and tranquility. Whether you are an adventure seeker looking to dive into the waters for Scuba Diving in the Andaman island or a family looking for Safe Water Sports while enjoying your Family trip to the Andaman or a couple seeking romantic Couple Water Adventures on their Honeymoon, the Andaman Islands has something for everyone. Our goal at Andaman Bliss is to be your gateway of escaping to this beautiful world with thoughtfully designed Andaman Tour Packages to offer you memories that last a lifetime!</p>
                    <p>
                        In this guide, we will take you beyond the postcard perfect beaches and show you the hidden gems of Andaman adventure activities, historical sites and natural wonders that elevates this destination to a level above the rest. We will explore the Best Water Sports in Andaman Island and learn about the rich history and discover why Andaman Bliss is the perfect partner for your journey.</p>

                    <h2 class="fs-6 fw-bold mt-2">Why Andaman Should Be On Your Next Destination To Visit</h2>
                    <p>Andaman Island is not just a place to visit but a life experience. Here's what makes this stunning archipelago so special:</p>
                    <h3 class="fs-6 fw-bold mt-2">Visit The Best Beaches to Have An Unforgettable Experience</h3>
                    <p>The beaches of Andaman island are remarkable and they form a large part of attractions. take the well known Radhanagar beach on Havelock island, a crescent stretch of powdery white sand hugged by flourishing green that makes it crowned jewels of Asia. A stroll along its shores at sunsets reveals a golden skyline with waves washing ashore. Its thriving beauty makes it the preferred choice for that instant of escapism. Then you can explore Elephant Beach which is a haven for Water Activities in Andaman, where the crystal clear waters teem with colorful fish and it is perfect for Snorkeling in Andaman Islands or a thrilling Sea Walk in Andaman.</p>

                    <p>If you truly want to be enchanted, visit Havelock at night and walk along its bioluminescence beaches. The water will sparkle with every footstep glowing from the tiniest glow in the water that will create an effect that looks like you are walking through a starry surface. This is an experience that turns an evening walk into a moment from a storybook. If you are relaxing by the shore or enjoying Water Adventures in Havelock, Andaman's beaches are for every occasion.
                    </p>

                    <h3 class="fs-6 fw-bold mt-2">Explore The History & Culture:</h3>
                    <p>More than just its natural beauty, Andaman provides a journey into India's history. The Cellular Jail in Port Blair is a bone chilling reminder of India's past struggle for freedom. Also known as "Kaala Paani," this colonial era jail housed independence fighters in solitary confinement. </p>
                    <p>Nowadays you can get lost in its dark hallways as a national memorial for just Rs. 30 (Indians) or Rs. 100 (foreigners). The evening Light and Sound Show (Rs. 50–200, depending on your seat) brings the past to life with a touching story told under the stars—a real treat for history buffs.</p>
                    <p>Ross Island now called Netaji Subhas Chandra Bose Island has more history to offer. This was once the headquarters of the British administration, and now it is an evocative ruin reclaimed by nature churches, ballrooms and bungalows inextricably joined to the roots of gigantic banyans. A brief ferry ride from Port Blair, it is a dreamland where history and wilderness coexist, loading you into another era.</p>
                    <ul class="under-wtr-itm px-3">
                        <li><strong>Sagarika Emporium</strong>: Free entry, 8:45 AM–6:45 PM (handicrafts and souvenirs)</li>
                        <li><strong>Anthropological Museum</strong>: Rs. 20, 9:30 AM–4:30 PM</li>
                        <li><strong>Naval Marine Museum (Samudrika)</strong>: Rs. 50, 9:00 AM–4:30 PM</li>
                        <li><strong>Fisheries Museum</strong>: Rs. 10, 9:00 AM–4:30 PM</li>
                        <li><strong>Kalapani Museum</strong>: Rs. 150–250 (with complimentary DVD and drink), 9:00 AM–7:00 PM</li>
                        <li><strong>Chatham Saw Mill</strong>: Rs. 10, 8:30 AM–2:00 PM</li>
                    </ul>
                    <p>These stops offer a deep dive into Andaman cultural and ecological heritage with a blend of education with exploration.</p>
                    <h3 class="fs-6 fw-bold mt-2">Thrilling Adventure:</h3>
                    <p>Andaman is an adventurer paradise with an extensive collection of Adventure Water Sports in Andaman to suit all exploration levels. From the depths of Scuba Diving in Andaman to the heights of Parasailing in Andaman the islands provide challenge and excitement. Imagine yourself skimming along the surface on a Jet Ski Ride in Andaman, paddling through the mangroves during Kayaking in Andaman, or taking in incredible coral reefs on a Glass Bottom Boat Ride in Andaman. With options available for individual travelers, family travelers and couple travelers, Andaman island ensures that everyone finds their perfect thrill.</p>

                    <h2 class="fs-6 fw-bold mt-2">Top Activities to Experience with Andaman Bliss</h2>
                    <p>Andaman activities are as unique and different as its landscapes. Here's a look at the best activities to enjoy including costs and where it is available:</p>

                    <ul class="under-wtr-itm px-3">
                        <li><strong>Scuba Diving in Andaman:</strong> Dive into the coral gardens and tropical fish at Havelock, Neil or North Bay. Prices will vary from Rs.3,500–6,500 depending on duration and dive site.</li>
                        <li><strong>Snorkeling in Andaman Islands:</strong> A budget-friendly adventure that is available for Rs.600-800, snorkeling on Elephant Beach or Jolly Buoy Island would be the ideal locations for snorkeling on shallow reefs.</li>
                        <li><strong>Sea Walk in Andaman:</strong> Explore the ocean floor at North Bay or Elephant Beach for Rs.4,000–4,500, an unmatched experience.</li>
                        <li><strong>Jet Ski Ride in Andaman:</strong> Speed across Corbyn's Cove Beach for between Rs. 600 – 1,000 which is just a quick bit of fun.</li>
                        <li><strong>Kayaking in Andaman:</strong> Paddle through mangroves or glowing waters for Rs. 3,500 – 4,000 which is best around Havelock or for Mayabunder.</li>
                        <li><strong>Parasailing in Andaman:</strong> Experience soaring above the sea at North Bay for Rs. 3,000 – 3,500 and look at paradise from above.</li>
                        <li><strong>Banana Boat Ride in Andaman:</strong> Bounce over waves with friends starting at Rs. 500 – 600 and offered at Elephant Beach.</li>
                        <li><strong>Glass Bottom Boat Ride in Andaman:</strong> For those who do not want to get wet and want to see the ocean depth it is offered at North Bay for Rs. 3,000 – 3,500.</li>
                        <li><strong>Speed Boat Ride in Andaman:</strong> Go across the ocean at Corbyn's Cove for Rs. 500 – 600.</li>
                        <li><strong>These Water Sports Packages in Andaman</strong> are for the young, old and everyone in between. They are perfect for family, couples or solo.</li>
                    </ul>
                    <h2 class="fs-6 fw-bold mt-2">Explore The Hidden Gems of Andaman</h2>
                    <p>As the iconic attraction of the Andaman island is always fascinating and lesser known destination of Andaman can present some uncommon experiences:
                    </p>
                    <p><strong>Mangrove Kayaking:</strong> Andaman gives you a chance to experience this journey for 2.5 hours (Rs. 3,500) through mangrove tunnels on a kayak. The still waters, the flutter of the wind through the trees and an experience of entering a remarkable secret world only a few minutes from the open ocean. Great for this experience are the months from October to April.</p>
                    <p><strong>Sea Karting:</strong> Another unforgettable experience is sea karting (Rs. 3,700 adult, Rs. 2,500 kids) which you can do at Corbyn's Cove Beach. This is where you can operate a mini speedboat for 20 minutes. This could be your highlight of several Water Activities shipped to Port Blair and is definitely for the adventure-oriented crowd.</p>
                    <p><strong>Limestone Caves of Baratang:</strong> Baratang Limestone Caves are natural wonders with beautiful stalagmites and stalactites presenting an untouched underground showcase. The adventure begins with a thrilling speedboat ride (with an entry fee of Rs. 300) and then in about a 2-hour trek in the forest. The best time to see this geological wonder is from October to March as it makes sure to spark your adventurous spirit.</p>
                    <p><strong>Seaplane Rides:</strong> Sea plane ride is not operational right now. If you want to travel with a touch of luxury you can add a Seaplane Ride as operated by Pawan Hans, which flies from Port Blair to Havelock. These start at as low as Rs 4,100 and are a 2 hour trip with only 8 other passengers. A Seaplane Ride will surely show you a beautiful aerial view of the islands. It is a great experience for honeymooners with the best times are in October until May during the best weather.</p>
                    <p><strong>Island Hopping:</strong> Island hopping is a classic Andaman experience, where you can boat back and forth between treasures of the Andaman, such as North Bay, Viper Island, Long Island and Ross and Smith Islands. Each island has its own uniqueness, whether it is history, beaches and water sports. Havelock and Neil Islands have these activities such as Snorkeling in Andaman Islands. In addition, the months from April to June have moderate temperatures to enjoy a multi-island trip.</p>

                    <h2 class="fs-6 fw-bold mt-2">Best Places To Participate In Water Based Activities</h2>
                    <p>Each of the Andaman Islands has its unique water adventures:</p>
                    <h3 class="fs-6 fw-bold mt-2">Havelock Island:</h3>
                    <p>Havelock Island is the best water sports destination in the Andaman Islands. Havelock Island has many aquatic adventures including the Best Water Sports in Havelock Island such as Scuba Diving in Andaman and kayaking at night. Elephant Beach on Havelock Island is a famous location for underwater experience.</p>
                    <h3 class="fs-6 fw-bold mt-2"> Port Blair:</h3>
                    <p>Port Blair is sparkling with Water Activities in Port Blair, with Jet Ski Rides in Andaman at Corbyn’s Cove and marine Sea Karting rides all in one stop. North Bay will provide coral viewing options.</p>
                    <h3 class="fs-6 fw-bold mt-2"> Neil Island:</h3>
                    <p>Neil is quiet and lovely, providing Snorkeling in Andaman Islands and a romantic beach vibe— a great choice to relax.</p>

                    <h2 class="fs-6 fw-bold mt-2">Why Travel Tourister Stands Out?</h2>
                    <p>At Travel Tourister, we recognize that every traveler is different. Our Andaman Tour Packages accommodate a variety of travelers, budgets and personal preferences. Whether you are:</p>
                    <p><strong>On a budget:</strong> Our shorter packages, for example, our 2 Night 3 Days packages, provide excellent value whilst ensuring you don’t miss out on an enriching experience.</p>

                    <p><strong>Planning a luxurious honeymoon</strong> Our more premium package is the 5 Nights 6 Days Andaman Package that has a special feature to make your romantic escape an unforgettable occasion.</p>
                    <p><strong>Planning an adventure:</strong> Every package can also be customized with adventures like scuba diving, snorkeling or parasailing.</p>
                    <p>Travel Tourister will ensure a smooth trip from start to end. We take care of everything like accommodation, meals, sightseeing and transfers so that you can focus on creating unforgettable moments. Our experienced team is available every time to offer local tips and help you customize an itinerary to suit your basic needs.</p>

                    <h2 class="fs-6 fw-bold mt-2">Conclusion</h2>
                    <p>The Andaman Islands are a quilt of magical turquoise seas, cradled in history providing an abundance of adventure. Whether you want to dive into some Water Adventures in Havelock or just lay on a glowing beach, Andaman Bliss is here to make your perfect getaway! Book now and allow the magic of your islands to unfold!</p>

                    <h2 class="fs-6 fw-bold mt-2">Are You Ready To Book Your Dream Trip?</h2>
                    <p>Your adventure in the Andaman Islands awaits just a click away! It does not matter whether you are planning a short weekend getaway or you are island hopping through the archipelago, Travel Tourister is able to offer you the Best Andaman Tour Packages and also offer you all the information you need for your memories to last long after your tan has faded away. We encourage you to Enquiry Now, and let us build you the Andaman holiday you are dreaming of. The islands are calling you – are you ready to pick up the phone?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">View All Activities</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style type="text/css">
    /* Modern Tours Page Styles */
    .tour-page-banner {
        position: relative;
        height: 500px;
        overflow: hidden;
    }

    .tour-page-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.8);
    }

    .tour-banner-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 100%;
        max-width: 800px;
        z-index: 2;
    }

    .tour-banner-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .tour-banner-content .subtitle {
        font-size: 0.875rem;
        color: white;
        background-color: rgba(17, 157, 213, 0.8);
        display: inline-block;
        padding: 0.5rem 1.5rem;
        border-radius: 30px;
        margin-top: 1rem;
    }

    .tour-section-title {
        position: relative;
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .tour-section-title h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: rgb(17, 157, 213);
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-block;
    }

    .tour-section-title h2 span {
        color: #f9680f;
    }

    .tour-section-title h2:after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(to right, rgb(17, 157, 213), rgb(0, 206, 255));
    }

    /* Filter Sidebar Styles */
    .tour-filter-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        overflow: hidden;
        border: none;
    }

    .tour-filter-header {
        background-color: rgba(17, 157, 213, 0.1);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(17, 157, 213, 0.1);
    }

    .tour-filter-header h3 {
        font-size: 1rem;
        font-weight: 600;
        color: rgb(17, 157, 213);
        margin: 0;
        display: flex;
        align-items: center;
    }

    .tour-filter-header h3 i {
        margin-right: 0.5rem;
    }

    .tour-filter-body {
        padding: 1.5rem;
    }

    .tour-filter-search .form-control {
        border-radius: 50px 0 0 50px;
        border: 1px solid #e0e0e0;
        padding-left: 1rem;
    }

    .tour-filter-search .btn {
        border-radius: 0 50px 50px 0;
        background-color: rgb(17, 157, 213);
        color: white;
        border: none;
        width: 67px !important;
        padding: 0px 10px !important;
    }

    .tour-filter-price .form-control {
        border-radius: 4px;
        border: 1px solid #e0e0e0;
    }

    .tour-filter-price .input-group-text {
        background-color: rgba(17, 157, 213, 0.1);
        border: 1px solid #e0e0e0;
        color: rgb(17, 157, 213);
    }

    .tour-filter-price .btn {
        border-radius: 50px;
        background-color: rgb(17, 157, 213);
        color: white;
        border: none;
        padding: 0.375rem 1.5rem;
        margin-top: 0.75rem;
        width: 100%;
    }

    .tour-filter-checkbox {
        margin-bottom: 0.5rem;
    }

    .form-check {
        display: flex !important;
    }

    .tour-filter-checkbox .form-check-input {
        border-color: #e0e0e0;
        margin-right: 15px;
    }

    .tour-filter-checkbox .form-check-input:checked {
        background-color: rgb(17, 157, 213);
        border-color: rgb(17, 157, 213);
    }

    .tour-filter-checkbox .form-check-label {
        font-size: 0.9rem;
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .tour-category-count {
        background-color: rgba(17, 157, 213, 0.1);
        color: rgb(17, 157, 213);
        font-size: 0.75rem;
        padding: 0.1rem 0.5rem;
        border-radius: 50px;
        font-weight: 600;
    }

    .tour-star {
        color: #FFD700;
    }

    .tour-star-empty {
        color: #e0e0e0;
    }

    .tour-rating-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .tour-rating-text {
        font-weight: 600;
        color: #333;
    }

    .tour-rating-count {
        background-color: rgba(17, 157, 213, 0.1);
        color: rgb(17, 157, 213);
        font-size: 0.75rem;
        padding: 0.1rem 0.5rem;
        border-radius: 50px;
        font-weight: 600;
    }

    /* Tour Card Styles */
    .tour-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        border: none;
    }

    .tour-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .tour-card-image {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .tour-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .tour-card:hover .tour-card-image img {
        transform: scale(1.05);
    }

    .tour-card-content {
        padding: 1.25rem;
    }

    .tour-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
        line-height: 1.4;
    }

    .tour-card-rating {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .tour-card-stars {
        margin-right: 0.5rem;
    }

    .tour-card-reviews {
        font-size: 0.8rem;
        color: #777;
    }

    .tour-card-price {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .tour-card-price-label {
        font-size: 0.8rem;
        color: #777;
        margin-right: 0.5rem;
    }

    .tour-card-price-old {
        font-size: 0.9rem;
        color: #999;
        text-decoration: line-through;
        margin-right: 0.5rem;
    }

    .tour-card-price-new {
        font-size: 1.1rem;
        font-weight: 700;
        color: rgb(17, 157, 213);
    }

    .tour-card-actions {
        display: flex;
        gap: 0.5rem;
    }

    .tour-card-btn {
        flex: 1;
        text-align: center;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .tour-card-btn-primary {
        background-color: rgb(17, 157, 213);
        color: white;
        box-shadow: 0 4px 10px rgba(17, 157, 213, 0.3);
    }

    .tour-card-btn-primary:hover {
        background-color: rgb(15, 140, 190);
        color: white;
    }

    .tour-card-btn-outline {
        background-color: white;
        color: rgb(17, 157, 213);
        border: 1px solid rgb(17, 157, 213);
    }

    .tour-card-btn-outline:hover {
        background-color: rgba(17, 157, 213, 0.1);
        color: rgb(17, 157, 213);
    }

    .tour-card-badge {
        position: absolute;
        top: 1rem;
        padding: 0.25rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 0 50px 50px 0;
        z-index: 1;
    }

    .tour-card-badge-discount {
        left: 0;
        background-color: #f9680f;
        color: white;
    }

    .tour-card-badge-bestseller {
        right: 0;
        background-color: rgb(17, 157, 213);
        color: white;
        border-radius: 50px 0 0 50px;
    }

    .tour-load-more {
        background-color: white;
        color: rgb(17, 157, 213);
        border: 1px solid rgb(17, 157, 213);
        border-radius: 50px;
        padding: 0.5rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .tour-load-more:hover {
        background-color: rgb(17, 157, 213);
        color: white;
    }

    .tour-load-more i {
        margin-right: 0.5rem;
    }



    /* Andamanbliss Tour Packages Section */
    .tour-andamanbliss-section {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        border: 1px solid #e0e0e0;
    }

    .tour-andamanbliss-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .tour-andamanbliss-title span {
        color: #f9680f;
    }

    .tour-andamanbliss-text {
        color: #666;
        margin-bottom: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .tour-andamanbliss-read-more {
        color: rgb(17, 157, 213);
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .tour-andamanbliss-read-more:hover {
        color: #f9680f;
        text-decoration: underline;
    }

    /* Andamanbliss Modal */
    .tour-andamanbliss-modal {
        max-width: 960px;
    }

    .tour-andamanbliss-modal .modal-header {
        border-bottom: 1px solid #eee;
        padding: 1rem 1.5rem;
        background-color: #fff;
    }

    .tour-andamanbliss-modal .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
    }

    .tour-andamanbliss-modal .modal-body {
        padding: 0;
        max-height: 70vh;
        overflow-y: auto;
    }

    .tour-andamanbliss-modal .modal-footer {
        border-top: 1px solid #eee;
        padding: 1rem 1.5rem;
        background-color: #fff;
    }

    .tour-andamanbliss-packages {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .tour-andamanbliss-packages-header {
        display: flex;
        justify-content: space-between;
        background-color: #f8f9fa;
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid #e0e0e0;
    }

    .tour-andamanbliss-packages-header h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .tour-andamanbliss-packages-header .duration-price {
        display: flex;
        gap: 8rem;
    }

    .tour-andamanbliss-packages-header .col {
        font-size: 1rem;
        font-weight: 600;
        color: #666;
        text-align: center;
    }

    .tour-andamanbliss-package-item {
        display: flex;
        align-items: center;
        padding: 0rem 1.5rem;
        transition: all 0.3s ease;
    }

    .tour-andamanbliss-package-item:last-child {
        border-bottom: none;
    }

    .tour-andamanbliss-package-item:hover {
        background-color: rgba(249, 104, 15, 0.05);
    }

    .tour-andamanbliss-package-name {
        flex: 1;
    }

    .tour-andamanbliss-package-name a {
        color: #f9680f;
        font-weight: 600;
        text-decoration: none;
        font-size: 12px;
    }

    .tour-andamanbliss-package-name a:hover {
        color: rgb(17, 157, 213);
        text-decoration: underline;
    }

    .tour-andamanbliss-package-duration,
    .tour-andamanbliss-package-price {
        width: 150px;
        text-align: right;
        font-weight: 500;
        font-size: 12px;
    }

    .tour-andamanbliss-package-duration {
        color: #666;
    }

    .tour-andamanbliss-package-price {
        color: #666;
    }

    .tour-andamanbliss-description {
        padding: 1.5rem;
        color: #666;
        line-height: 1.6;
    }

    .tour-andamanbliss-description p {
        margin-bottom: 1rem;
        font-size: 14px;
    }

    .tour-andamanbliss-description a {
        color: rgb(17, 157, 213);
        font-weight: 600;
        text-decoration: none;
    }

    .tour-andamanbliss-description a:hover {
        color: #f9680f;
        text-decoration: underline;
    }

    .tour-andamanbliss-modal .btn-primary {
        background-color: rgb(17, 157, 213);
        border-color: rgb(17, 157, 213);
    }

    .tour-andamanbliss-modal .btn-primary:hover {
        background-color: #0e8bc0;
        border-color: #0e8bc0;
    }

    .tour-andamanbliss-modal .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .tour-andamanbliss-modal .close {
        font-size: 1.5rem;
        color: #000;
        opacity: 0.5;
    }

    /* Contact Offcanvas */
    .tour-contact-offcanvas .offcanvas-header {
        background-color: rgb(17, 157, 213);
        color: white;
    }

    .tour-contact-offcanvas .btn-close {
        filter: brightness(0) invert(1);
    }

    .tour-contact-item {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .tour-contact-item h6 {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .tour-contact-item h6 i {
        color: rgb(17, 157, 213);
        margin-right: 0.5rem;
    }

    .tour-contact-item p {
        font-size: 1.1rem;
        font-weight: 700;
        color: rgb(17, 157, 213);
        margin-bottom: 0;
        padding-left: 1.5rem;
    }

    .tour-contact-links {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .tour-contact-link {
        color: rgb(17, 157, 213);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .under-wtr-itm li {
        list-style-type: disc !important;
        font-size: 14px;
        color: #002246;
    }

    .tour-contact-link:hover {
        color: #f9680f;
    }

    /* Responsive Styles */
    @media (max-width: 991px) {
        .tour-banner-content h1 {
            font-size: 2.5rem;
        }

        .tour-banner-content .subtitle {
            font-size: 1rem;
        }

        .tour-section-title h2 {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 767px) {
        .tour-page-banner {
            height: 350px;
        }

        .tour-banner-content h1 {
            font-size: 2rem;
        }

        .tour-banner-content .subtitle {
            font-size: 0.9rem;
        }

        .tour-section-title h2 {
            font-size: 1.5rem;
        }

        .tour-card-image {
            height: 180px;
        }

    }


    /* Tour includes header style */
    .ab-tour-includes-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }
..ab-tour-card {
    height: fit-content !important ;
}
    .ab-tour-card-deal {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        padding: 6px 10px;
        font-size: 14px;
        font-weight: 500;
        z-index: 1;
    }

    .ab-tour-card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .ab-tour-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .ab-tour-card:hover .ab-tour-card-image img {
        transform: scale(1.05);
    }

    .ab-tour-card-map-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ab-tour-card-location {
        background-color: #2196F3;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
    }

    .ab-location-sn {
        background-color: #E91E63;
    }

    .ab-location-sy {
        background-color: #FF9800;
    }

    .ab-location-sm {
        background-color: #2196F3;
    }

    .ab-tour-card-duration {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
    }

    .ab-tour-card-map-button {
        background-color: white;
        border: none;
        color: #333;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .ab-tour-card-content {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .ab-tour-card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .ab-tour-tag {
        background-color: #f0f0f0;
        color: #555;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .ab-tour-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .ab-tour-card-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .ab-tour-card-stats {
        display: flex;
        gap: 10px;
    }

    .ab-tour-card-stats span {
        font-size: 13px;
        color: #666;
    }

    .ab-tour-card-highlights {
        font-size: 13px;
        color: #2196F3;
        font-weight: 600;
    }

    .ab-tour-card-includes {
        margin-bottom: 5px;
    }

    .ab-tour-card-includes h4 {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .ab-tour-card-icons {
        display: flex;
        gap: 30px;
    }

    .ab-tour-icon {
        width: 30px;
        height: 30px;
        background-color: #f5f5f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        font-size: 14px;
    }

    .ab-tour-card-pricing {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .ab-tour-card-price-label {
        display: block;
        font-size: 12px;
        color: #666;
        margin-bottom: 3px;
    }

    .ab-tour-card-price {
        display: flex;
        align-items: baseline;
    }

    .ab-tour-card-price-currency {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .ab-tour-card-price-amount {
        font-size: 24px;
        font-weight: 700;
        color: #333;
    }

    .ab-tour-card-price-asterisk {
        font-size: 14px;
        color: #FF6B00;
        font-weight: 600;
    }

    .ab-tour-card-emi {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ab-tour-card-emi-icon {
        width: 24px;
        height: 24px;
        background-color: rgba(33, 150, 243, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2196F3;
    }

    .ab-tour-card-emi-details {
        display: flex;
        flex-direction: column;
    }

    .ab-tour-card-emi-label {
        font-size: 9px;
        color: #666;
    }

    .ab-tour-card-emi-amount {
        font-size: 13px;
        font-weight: 600;
        color: #2196F3;
    }

    .ab-tour-card-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
    }

    .ab-tour-card-btn {
        flex: 1;
        padding: 10px;
        text-align: center;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .ab-tour-view-btn {
        background-color: white;
        color: #2196F3;
        border: 1px solid #2196F3;
    }

    .ab-tour-view-btn:hover {
        background-color: rgba(33, 150, 243, 0.1);
    }

    .ab-tour-book-btn {
        background-color: #2196F3;
        color: white;
        border: 1px solid #2196F3;
    }

    .ab-tour-book-btn:hover {
        background-color: #1976D2;
    }

    .ab-tour-card-contact {
        display: flex;
        justify-content: center;
    }

    .ab-tour-card-whatsapp {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #4CAF50;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }

    .ab-tour-card-whatsapp:hover {
        text-decoration: underline;
    }

    .ab-tour-card-itinerary {
        margin-left: 15px;
        display: flex;
        align-items: center;
        gap: 5px;
        color: #FF6B00;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }

    .ab-tour-card-itinerary:hover {
        text-decoration: underline;
    }

    /* Responsive Styles */
    @media (max-width: 991px) {
        .ab-tour-card-image {
            height: 180px;
        }

        .ab-tour-card-title {
            font-size: 16px;
        }

        .ab-tour-card-price-amount {
            font-size: 20px;
        }
    }

    @media (max-width: 767px) {
        .ab-tour-card-actions {
            flex-direction: column;
        }

        .ab-tour-card-contact {
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .ab-tour-card-itinerary {
            margin-left: 0;
        }
    }

    .ab-tour-card-badge {
        position: absolute;
        top: 10px;
        left: 0;
        z-index: 2;
        padding: 5px 15px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        border-radius: 0 4px 4px 0;
    }

    .ab-badge-sn {
        background-color: #FF6B00;
    }

    .ab-badge-sy {
        background-color: #FF6B00;
    }

    .ab-badge-sm {
        background-color: #FF6B00;
    }

    .ab-tour-card-deal {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        padding: 6px 10px;
        font-size: 14px;
        font-weight: 500;
        z-index: 1;
    }

    .ab-tour-card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .ab-tour-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .ab-tour-card:hover .ab-tour-card-image img {
        transform: scale(1.05);
    }

    .ab-tour-card-map-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ab-tour-card-location {
        background-color: #2196F3;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
    }

    .ab-location-sn {
        background-color: #E91E63;
    }

    .ab-location-sy {
        background-color: #FF9800;
    }

    .ab-location-sm {
        background-color: #2196F3;
    }

    .ab-tour-card-duration {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
    }

    .ab-tour-card-map-button {
        background-color: white;
        border: none;
        color: #333;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .ab-tour-card-content {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .ab-tour-card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .ab-tour-tag {
        background-color: #f0f0f0;
        color: #555;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .ab-tour-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .ab-tour-card-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .ab-tour-card-stats {
        display: flex;
        gap: 10px;
    }

    .ab-tour-card-stats span {
        font-size: 13px;
        color: #666;
    }

    .ab-tour-card-highlights {
        font-size: 13px;
        color: #2196F3;
        font-weight: 600;
    }

    .ab-tour-card-includes {
        margin-bottom: 5px;
    }

    .ab-tour-card-includes h4 {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .ab-tour-card-icons {
        display: flex;
        gap: 30px;
    }

    .ab-tour-icon {
        width: 30px;
        height: 30px;
        background-color: #f5f5f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        font-size: 14px;
    }

    .ab-tour-card-pricing {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .ab-tour-card-price-label {
        display: block;
        font-size: 12px;
        color: #666;
        margin-bottom: 3px;
    }

    .ab-tour-card-price {
        display: flex;
        align-items: baseline;
    }

    .ab-tour-card-price-currency {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .ab-tour-card-price-amount {
        font-size: 24px;
        font-weight: 700;
        color: #333;
    }

    .ab-tour-card-price-asterisk {
        font-size: 14px;
        color: #FF6B00;
        font-weight: 600;
    }

    .ab-tour-card-emi {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: #f5f9ff;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .ab-tour-card-emi-icon {
        color: #2196F3;
        font-size: 14px;
    }

    .ab-tour-card-emi-details {
        display: flex;
        flex-direction: column;
    }

    .ab-tour-card-emi-label {
        font-size: 9px;
        color: #666;
    }

    .ab-tour-card-emi-amount {
        font-size: 13px;
        font-weight: 600;
        color: #333;
    }

    .ab-tour-card-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .ab-tour-card-btn {
        flex: 1;
        text-align: center;
        padding: 10px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .ab-tour-view-btn {
        background-color: #f5f5f5;
        color: #333;
        border: 1px solid #ddd;
    }

    .ab-tour-view-btn:hover {
        background-color: #eee;
        color: #333;
    }

    .ab-tour-book-btn {
        background-color: #FF6B00;
        color: white;
        border: 1px solid #FF6B00;
    }

    .ab-tour-book-btn:hover {
        background-color: #e65c00;
        border-color: #e65c00;
        color: white;
    }

    .ab-tour-card-contact {
        display: flex;
        justify-content: space-between;
    }

    .ab-tour-card-whatsapp,
    .ab-tour-card-itinerary {
        font-size: 13px;
        color: #666;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ab-tour-card-whatsapp i {
        color: #25D366;
    }

    .ab-tour-card-itinerary i {
        color: #2196F3;
    }

    .ab-tour-card-whatsapp:hover,
    .ab-tour-card-itinerary:hover {
        color: #333;
    }

    /* Responsive styles */
    @media (max-width: 991px) {
        .ab-tour-card-pricing {
            flex-direction: row;
            align-items: flex-start;
            gap: 10px;
        }

        .ab-tour-card-emi {
            align-self: flex-start;
        }
    }

    @media (max-width: 767px) {
        .ab-tour-card-image {
            height: 180px;
        }

        .ab-tour-card-actions {
            flex-direction: column;
        }

        .ab-tour-card-title {
            font-size: 16px;
        }

        .ab-tour-card-price-amount {
            font-size: 20px;
        }
    }

    @media (max-width: 575px) {
        .ab-tour-card-details {
            flex-direction: row;
            gap: 8px;
        }

        .ab-tour-card-contact {
            flex-direction: row;
            gap: 10px;
        }
    }

    .itinerary-modal-content {
        display: flex;
        flex-direction: column;
    }

    .itinerary-modal-image img {
        width: 100%;
        height: auto;
    }

    #getItineraryModal .modal-dialog {
        max-width: 400px;
        margin: 1.75rem auto;
    }

    #getItineraryModal .modal-content {
        border: none;
        border-radius: 8px;
        overflow: hidden;
    }

    #getItineraryModal .btn-danger {
        background-color: #FF6B00;
        border-color: #FF6B00;
    }

    #getItineraryModal .form-control {
        padding: 10px;
        border-radius: 4px;
    }

    .tour-andamanbliss-text {
        color: #666;
        margin-bottom: 0;
        display: block;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // Debugging: Confirm script initialization
        console.log('Activities Load More script initialized at', new Date().toLocaleString());

        // Selectors
        var nextPageUrl = '{{ $activities->nextPageUrl() }}';
        var $loadMoreBtn = $('#load-more-btn');
        var $loadSpinner = $('#load-spinner');
        var $loadMoreContainer = $('#load-more-container');
        var $activitiesContainer = $('.activity-container');
        var $errorContainer = $('#error-container');

        // Debugging: Verify elements
        console.log('Load More button found:', $loadMoreBtn.length ? 'Yes' : 'No');
        console.log('Load More container found:', $loadMoreContainer.length ? 'Yes' : 'No');
        console.log('Error container found:', $errorContainer.length ? 'Yes' : 'No');
        console.log('Initial nextPageUrl:', nextPageUrl);

        function escapeHTML(str) {
            return str.replace(/[&<>"']/g, function(match) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [match];
            });
        }

        function showError(message) {
            if (!$errorContainer.length) {
                console.error('Error container not found in DOM!');
                alert(message);
                return;
            }
            $errorContainer.html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${escapeHTML(message)}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `).removeClass('d-none');
        }

        function generateActivityCard(activity) {
            var photo = activity.activity_photos?.[0]?.file ?? '/placeholder.jpg';
            var categoryName = activity.category?.name ?? 'Unknown Category';
            var categorySlug = activity.category?.slug ?? '';
            var name = activity.service_name ? escapeHTML(activity.service_name) : 'Unnamed Activity';
            var ratings = parseInt(activity.ratings) || 0;
            var reviewsCount = activity.reviews_count || 0;
            var rate = parseFloat(activity.adult_cost) || 0;
            var hasDiscount = activity.discount > 0;
            var url = activity.url ?? activity.slug;
            var location = activity.location;
            var price = hasDiscount ? rate - ((rate * activity.discount) / 100) : rate;
            var discount = hasDiscount ? activity.discount : 0;
            var duration = activity.duration ?? 0;

            var activitySlug = activity.slug || '';
            var currency = activity.currency || '₹';

            var stars = '';
            for (var i = 1; i <= ratings; i++) {
                stars += '<i class="fas fa-star tour-star"></i>';
            }
            const activityRouteTemplate = @json(route('activity.view', ['url' => '__URL__']));

            var viewDetailsButton = '';

            if (url) {
                const viewUrl = activityRouteTemplate.replace('__URL__', encodeURIComponent(url));
                viewDetailsButton = `

                <div class="ab-tour-card-actions">
                    <a href="${viewUrl}" class="ab-tour-card-btn ab-tour-view-btn">View Tour</a>
                    <a href="${viewUrl}" class="ab-tour-card-btn ab-tour-book-btn">Book Online</a>
                </div>
                `;
            } else {
                viewDetailsButton = `
         <div class="ab-tour-card-actions">
                <a href="${viewUrl}" class="ab-tour-card-btn ab-tour-view-btn">View Tour</a>
                <a href="${viewUrl}" class="ab-tour-card-btn ab-tour-book-btn">Book Online</a>
        </div>`;
            }

            return `
            <div class="col-lg-4 col-md-6 mb-4">
                        <div class="ab-tour-card">
                                                    <div class="ab-tour-card-header">

                ${hasDiscount ? `<div class="ab-tour-card-deal">
                                    <span>Exclusive Deal upto ${discount}% <em>-off</em></span>
                                </div>` : ''}
                <div class="ab-tour-card-image">
                    <img src="${photo}" alt="${name}">


                     <div class="ab-tour-card-map-btn">
                                        <span
                                            class="ab-tour-card-duration">${escapeHTML(categoryName.charAt(0).toUpperCase() + categoryName.slice(1))} - ${name.replace(/(\d)(?=[A-Za-z])/g, '$1 ')}</span>
                                            <button class="ab-tour-card-map-button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="${location}">
                                                <i class="fas fa-map-marker-alt"></i> Map
                                            </button>
                                    </div>

                </div>
                </div>
                <div class="ab-tour-card-content">
                                
                                <h3 class="ab-tour-card-title">
                       <span class="cat">${escapeHTML(categoryName.charAt(0).toUpperCase() + categoryName.slice(1))}</span> - 
                        ${name.replace(/(\d)(?=[A-Za-z])/g, '$1 ')}
                    </h3>
                     <div class="ab-tour-card-includes">
                                    <div class="ab-tour-includes-header">
                                        <div class="ab-tour-card-icons ">

                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title=" ${duration} -mins"><i class="fa-solid fa-hourglass-start"></i></span>
                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Guide"><i class="fa-solid fa-user-group"></i></span>
                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Safety"><i class="fa-solid fa-shield-heart"></i></span>
                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Photos"><i class="fas fa-camera"></i></span>
                                            <span class="ab-tour-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="${ratings}"><i class="fa-solid fa-star text-warning"></i></span>
                                        </div>


                                    </div>
                                </div>




                                 <div class="ab-tour-card-pricing">
                                    <div class="ab-tour-card-price-info">
                                        <span class="ab-tour-card-price-label">All inclusive price</span>
                                        <div class="ab-tour-card-price">
                                            <span class="ab-tour-card-price-currency">₹</span>
                                            <span
                                                class="ab-tour-card-price-amount">${currency}${rate.toFixed(2)}</span>
                                            <span class="ab-tour-card-price-asterisk">*</span>
                                        </div>
                                    </div>
                                    <div class="ab-tour-card-emi">
                                        <div class="ab-tour-card-emi-icon">
                                            <i class="fas fa-credit-card text-success"></i>
                                        </div>
                                        <div class="ab-tour-card-emi-details">
                                            <span class="ab-tour-card-emi-label">Instant Confirmation</span>
                                            <span class="ab-tour-card-emi-amount">Available</span>
                                        </div>
                                    </div>
                                </div>

                    
                    
                        ${viewDetailsButton}
                </div>
            </div>
        </div>
    `;
        }


        // Event listener with delegation
        $(document).on('click', '#load-more-btn', function(e) {
            e.preventDefault();
            console.log('Load More button clicked at', new Date().toLocaleString());
            console.log('Current nextPageUrl:', nextPageUrl);

            if (!nextPageUrl) {
                console.warn('No next page URL available.');
                $loadMoreContainer.addClass('d-none');
                showError('No more activities to load.');
                return;
            }

            $loadSpinner.removeClass('d-none');
            $loadMoreBtn.prop('disabled', true);
            $errorContainer.addClass('d-none');

            $.ajax({
                url: nextPageUrl,
                type: 'GET',
                data: window.location.search.slice(1), // Preserve filter parameters
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(data) {
                    console.log('AJAX success:', data);
                    if (data.error) {
                        showError(data.error);
                        return;
                    }
                    if (data.activities && data.activities.length > 0) {
                        data.activities.forEach(function(activity) {
                            $activitiesContainer.append(generateActivityCard(activity));
                        });
                    } else {
                        console.warn('No activities returned in response');
                        showError('No more activities to load.');
                    }

                    nextPageUrl = data.next_page;
                    console.log('Updated nextPageUrl:', nextPageUrl);
                    if (!data.has_more) {
                        $loadMoreContainer.addClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error, xhr.responseText);
                    var message = xhr.responseJSON?.error || 'Failed to load more activities. Please try again.';
                    showError(message);
                },
                complete: function() {
                    $loadSpinner.addClass('d-none');
                    $loadMoreBtn.prop('disabled', false);
                }
            });
        });
    });

    function setCallNowHref() {
        var callNowButtons = document.querySelectorAll('.callNowButton');
        callNowButtons.forEach(function(button) {
            if (window.innerWidth <= 768) {
                button.href = 'tel:+918900909900';
                button.removeAttribute('data-bs-toggle');
                button.removeAttribute('data-bs-target');
                button.removeAttribute('aria-controls');
            } else {
                button.href = 'javascript:void(0);';
                button.addEventListener('click', openOffcanvas);
            }
        });
    }

    function openOffcanvas() {
        console.log('Opening offcanvas for desktop');
    }

    document.addEventListener('DOMContentLoaded', setCallNowHref);
    window.addEventListener('resize', setCallNowHref);

    // Andamanbliss Modal Script
    document.addEventListener('DOMContentLoaded', function() {
        var andamanblissModal = document.getElementById('andamanblissModal');
        if (andamanblissModal) {
            andamanblissModal.addEventListener('shown.bs.modal', function() {
                console.log('Andamanbliss modal opened');
            });
        }
        
    const slider = document.getElementById("priceRange");
    const output = document.getElementById("priceRangeValue");
    const durationCheckboxes = document.querySelectorAll("input[name='duration[]']");
    const categoryCheck = document.querySelectorAll("input[name='categories[]']");
    const cards = document.querySelectorAll(".ab-tour-card");

    function applyFilters() {
        let maxPrice = parseInt(slider.value);

        let durations = [...durationCheckboxes]
            .filter(cb => cb.checked)
            .map(cb => cb.value.toLowerCase());

        let categories = [...categoryCheck]
            .filter(cb => cb.checked)
            .map(cb => cb.value.toLowerCase());

        cards.forEach(card => {

            let cardWrapper = card.closest(".col-lg-4");

            let priceEl = card.querySelector(".ab-tour-card-price-amount");
            let durEl = card.querySelector(".ab-tour-card-duration");
            let catEl = card.querySelector(".cat");

            if (!priceEl || !durEl || !catEl) return;

            let price = parseInt(priceEl.textContent.replace(/[,₹ ]/g, ""));
            let durationText = durEl.textContent.trim().toLowerCase().replace("/", "");
            let categoryText = catEl.textContent.trim().toLowerCase();

            let passPrice = price <= maxPrice;
            let passDuration = durations.length === 0 || durations.includes(durationText);
            let passCategory = categories.length === 0 || categories.includes(categoryText);

            if (passPrice && passDuration && passCategory) {
                cardWrapper.style.display = "block";
            } else {
                cardWrapper.style.display = "none";
            }
        });
    }

    slider.addEventListener("input", function () {
        output.textContent = "₹" + parseInt(this.value).toLocaleString('en-IN');
        applyFilters();
    });

    durationCheckboxes.forEach(cb => cb.addEventListener("change", applyFilters));
    categoryCheck.forEach(cb => cb.addEventListener("change", applyFilters));

    });


</script>
@endpush