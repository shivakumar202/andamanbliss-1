@extends('layouts.app')
@section('title', 'Mahatma Gandhi Marine National Park | Travel Guide')
@section('keywords', ' Cellular Jail In Port Blair, Light And Sound Show In Cellular Jail, Cellular Jail In Andaman
Islands')
@section('description', ' Plan your trip to Mahatma Gandhi Marine National Park, Andaman. Experience snorkeling, coral reefs and serene beaches in this marine paradise.')
@section('content')
<!-- Hero Section -->
<section class="island-hero-section">
    <div class="hero-slider">
        <div class="hero-slide active"
            style="background-image: url('{{asset("site/img/islands/port-blair/mgmnp.jpeg")}}')">
            <div class="hero-overlay"></div>
            <div class="container">
                <div class="row mt-5">
                    <div class="col-lg-7">
                        <div class="hero-content">
                            <div class="hero-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i> Home</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="/islands">Islands</a></li>
                                        <li class="breadcrumb-item"><a href="/islands/baratang">Sri Vijiya Puram</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Marine National Park</li>
                                    </ol>
                                </nav>
                            </div>
                            <h1 class="hero-title">Mahatma Gandhi <span> Marine National Park</span></h1>
                            <p class="hero-subtitle">A vibrant underwater paradise in Wandoor, Port Blair
                            </p>
                            <div class="hero-buttons">
                                <a href="#tour_details" class="btn btn-primary">Explore Marine National Park<i
                                        class="fas fa-arrow-right"></i></a>
                                <a href="#cellular-pkg-lst" class="btn btn-outline">Book Now <i
                                        class="fas fa-calendar-check"></i></a>
                            </div>

                            <div class="hero-features mt-4">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-6">
                                        <a href="#underwater-exploration" class="feature-card">
                                            <div class="feature-icon">
                                                <i class="fas fa-water"></i>
                                            </div>
                                            <span>Sightseeing</span>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6">
                                        <a href="#adventure-activities" class="feature-card">
                                            <div class="feature-icon">
                                                <i class="fas fa-hiking"></i>
                                            </div>
                                            <span>Underwater Paradise</span>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6">
                                        <a href="#entry-ticket" class="feature-card">
                                            <div class="feature-icon">
                                                <i class="fas fa-ticket-alt"></i>
                                            </div>
                                            <span>Entry Ticket Info</span>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6">
                                        <a href="#visitor-guidelines" class="feature-card">
                                            <div class="feature-icon">
                                                <i class="fas fa-info-circle"></i>
                                            </div>
                                            <span>Guidelines</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="booking-card hero-booking-card">
                            <div class="section-title text-center mb-3">
                                <h2>Want to Go For A <span>Memorable Holiday?</span></h2>
                                <p>Provide Your Details to Know Best Tour Options</p>
                            </div>
                              <livewire:islands-form></livewire:islands-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section id="tour_details" class="main-content-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="location-header">
                    <div class="location-badge">
                        <i class="fas fa-map-marker-alt"></i> Wandoor Beach, Sri Vijaya Puram
                    </div>
                    <div class="location-actions">
                        <a href="https://maps.app.goo.gl/gDWnVCizS214fw5J8" target="_blank" class="map-link">
                            <i class="fas fa-map-marked-alt"></i> View on Map
                        </a>
                        <a href="#" class="share-link">
                            <i class="fas fa-share-alt"></i> Share
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="content-card overview-card">
                                <h3 class="content-title">Mahatma Gandhi Marine National Park: A Complete Andaman Adventure

                                </h3>
                                <div class="content-text">
                                    <p>
                                        The <strong>Mahatma Gandhi Marine National Park</strong> is a true paradise of Andaman Islands. This Marine National Park is a home to 17 small island and each of this island are known for its different specialities like crystal clear water, vibrant coral reefs and lush mangrove forest, all these islands of Marine National Park are spread over 281.5 square kilometers of protected marine habitat. This Marine National Park was established in 1983 and it is a sanctuary for marine life and a peaceful retreat for travelers who want to reconnect with nature. Whether you are planning a family trip, a honeymoon vacation or a solo adventurous trip, this destination offers you an unforgettable experience and will give you a chance to immerse yourself in the wonders of the Andaman Islands. </p>

                                    <div class="image-feature">
                                        <img src="{{asset('site/img/islands/port-blair/MGMNP1.jpeg')}}" class="d-block img-fluid"
                                            alt="Photography banner">
                                        <div class="image-caption">Visit The Mahatma Gandhi Marine National Park.
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="content-card">
                                <h3 class="content-title">Where is Mahatma Gandhi Marine National Park Located?</h3>
                                <div class="content-text">
                                    <p>
                                        The <strong>Mahatma Gandhi Marine National Park</strong> is a destination you should not miss if you are traveling to Andaman Islands. This National Park is located near the Wandoor village which is approximately 25 kilometers away from the main city Port Blair. The drive from Port Blair to Wandoor is a scenic delight through lush green forest that makes your journey to Wandoor beach a memorable experience.</p>
                                    <p>The moment you arrive in Marine National Park, you will be welcomed by a rich and diverse ecosystem. You will be surrounded by coral reefs, seagrass beds, mangrove forest and tropical rainforest and though this island is a home to an incredible variety of flora and fauna. The Marine National Park offers a perfect blend of peace and adventure for every nature lover.</p>

                                    
                                </div>
                            </div>

                            <div class="content-card">
                                <h3 class="content-title">Islands Near Mahatma Gandhi Marine National Park</h3>
                                <div class="content-text">
                                    <p class="mt-3">The National Park is a home of 17 island and each of its has its own unique speciality. For simplicity, this falls into two main categories:</p>
                                    <ul class="styled-li">
                                        <li><strong>Labyrinth Islands:</strong> These islands are full of waterways and dense mangroves, this islands are rich in biodiversity. They provide habitats for many bird species and marine life.</li>
                                        <li><strong>Twin Islands:</strong> Famous for its sea turtle nesting and vibrant coral reefs. These island are a paradise for snorkelers and underwater photographers.</li>
                                    <p class="mt-2">Some islands stand out for visitors:</p>
                                    <ul class="styled-li">
                                        <li><strong>Jolly Buoy Island:</strong> This island is a crown jewel of the park. Jolly Buoy island is famous for its clear water and coral reefs. Snorkeling here feels like swimming through a living aquarium.</li>
                                        <li><strong>Red Skin Island:</strong> This beach is smaller than Jolly Buoy Island but its equally stunning. This island is ideal for a day trip that offers shallow reef and its perfect for beginners.</li>
                                        <li><strong>Tarmugli Island:</strong> This island is known for its lush mangrove forest and peaceful beach. It is less crowded and great for nature walks and photography.</li>
                                    </ul>
 
                                    </ul>

                                    <div class="image-feature">
                                        <img src="{{asset('site/img/islands/port-blair/marine-park.jpeg')}}"class="d-block img-fluid"
                                            alt="Photography banner">
                                        <div class="image-caption">Visit The Mahatma Gandhi Marine National Park.
                                        </div>
                                    </div>

                                    <div class="feature-box">
                                        <div class="feature-icon">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>Did You Know?</h4>
                                            <p>Mahatma Gandhi Marine National Park is a home to over 50 speices of corals and serves as a vital nesting ground for Olive Ridley and Green turtles. Islands like Jolly Buoy and Red Skin Islands are famous for its crystal clear water. You can even spot colorful fishes near the shore that offers a magical glimpse of underwater life without even diving.  </p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="content-card">
                                <h3 class="content-title">A Peek Into the Underwater World</h3>
                                <div class="content-text">
                                    <p class="mt-3">One of the most magical aspects of the park is its underwater life. The coral reefs are alive with colors and movement, housing over 50 species of corals and countless fish species, from clownfish to parrotfish. You may also spot tutles gliding gracefully, starfish resting on the seabed and crabs scuttling along the shore</p>
                                    
                                    <p class="mt-2">Above water, the mangrove creeks are alive with activity that provides shelter for small fish and crustaceans. Rare birds like the Andaman teal and the majestic White Bellied Sea Eagle soar above the island that makes every moment a treat for nature lovers. </p>

                                    <p class="mt-2">It is a fragile ecosystem, so visitors are encouraged to enjoy it responsibly that means no touching corals, no littering and no disturbing wildlife. </p>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">


                            <div class="content-card">
                                <h3 class="content-title">Adventures to Try in National Park:
                                </h3>
                                <div class="content-text">
                                    <p class="mt-2">
                                        Whether you are a thrill seeker or someone who just want to relax, this national park offers something for everyone:</p>
                                    <ul class="styled-li">
                                        <li><strong>Snorkeling & Diving:</strong> The water clarity and colorful reefs makes snorkeling here unforgettable. If you are a diver, exploring the deeper water opens up a whole new dimension of marine life.</li>
                                        <li><strong>Glass Bottom Boat Rides:</strong> If you dont know how to swim. Then, this activity will let you enjoy the underwater world without getting wet.</li>
                                        <li><strong>Beaches & Relaxation:</strong> Each island offers peaceful beaches and its perfect for sunbathing, reading books or simply enjoying the peaceful surroundings.</li>
                                        <li><strong>Trekking & Nature Walks:</strong> Some islands like Tarmugli have trails through dense forest where you can spot birds, lizards and other wildlife.</li>
                                        <li><strong>Wildlife Spotting:</strong> Keep your eyes open for sea turtles crawling ashore, monitor lizards on the sand and the occasional playful dolphin in the distance. </li>
                                    </ul>
                                         
                                </div>
                            </div>

                            <div class="content-card">
                                <h3 class="content-title">Protecting Sea Turtles</h3>
                                <div class="content-text">
                                    <p class="mt-2">
                                        The Mahatma Gandhi Marine National Park is not just famous for its corals and clear water but it also serves as a nesting ground for sea turtles that includes Olive Ridley and Green Turtles and both of them are listed as endangered species. Every year, these marine creatures return to the sandy shores of Wandoor Beach and sometimes in other nearby islands to lay their eggs.</p>
                                    <p>
                                        To safeguard this marine creatures, our dedicated conservation teams work tirelessly to their nesting sites and turtle eggs are safe and protected. Even during the nesting season, travelers can get the chance to witness tiny turtles taking their first step towards the ocean. It is one of the most heartwarming experience that you will never forget.</p>

                                    <p>
                                        If you are traveling during this season, then we recommend you to be mindful and responsible while exploring this place. We request you to avoid bright lights near nesting beaches, do not litter and do not disturb or touch the turtles.All these small actions like walking carefully and keeping noise level low can make a huge difference in protecting these magnificent creatures.</p>

                                    <p>By following these park eco guidelines, each and every visitors can enjoy this beautiful experience and make a small effort to protect life under the sea and make sure that our future generation will also get the chance to enjoy the magic of the marine creatures as well. </p>
                                    
                                    <div class="image-feature">
                                        <img src= "{{asset('site/img/islands/port-blair/mgmnp.jpeg')}}" class="d-block img-fluid"
                                            alt="Photography banner">
                                        <div class="image-caption">Visit The Stunning National Park.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-card">
                                <h3 class="content-title">When is the Best Time to Visit Marine National Park?</h3>
                                <div class="content-text">
                                    <p>
                                        The best time to enjoy the park is from October to February. During these month, the weather is pleasant, water is calm and humidity low. This beach is perfect for boating, snorkeling and beach exploration. Avoid the monsoon season that starts from June to September as it may lead to rough seas and heavy rainfall.
                                    </p>
                                    <div class="image-feature">
                                        <img src="{{asset('site/img/islands/port-blair/mgmnp4.jpeg')}}" class="d-block img-fluid"
                                            alt="Photography banner">
                                        <div class="image-caption">Visit The Marine National Park.
                                        </div>
                                    </div>

                                <div class="content-card">
                                <h3 class="content-title">How to Reach Mahatma Gandhi Marine National Park
                                </h3>
                                
                                <div class="content-text">
                                    <p class="mt-2">
                                        Reaching this National Park is quite easy from Port Blair. Here is how you can reach this park:</p>
                                    <ul class="styled-li">
                                        <li><strong>By Air:</strong> The nearest airport is Veer Savarkar International Airport in Port Blair which is connected with many major Indian cities like Chennai, Kolkata, Delhi, Bangalore and Hyderabad. The moment you land in Port Blair airport, you can simply continue your journey towards Wandoor Beach by road.</li>
                                        <li><strong>By Road:</strong>Wandoor Beach is about 25 km away from Port Blair. You can simply hire a private cab, rent a two wheeler or can take a government or private bus that operates from Aberdeen Bazaar and other parts of Port Blair. It will take you around 45 minutes to reach Wandoor Beach from Aberdeen Bazar.</li>
                                        <li><strong>By Sea:</strong> From Wandoor Jetty, you can take a government authorized boat or ferry that takes visitors to nearby famous islands like Jolly Buoy and Red Skin Island, which is eventually a part of the Marine National Park. All the boat trips are usually organized by the Forest Department and to enter this park, a permit is mandatory.</li>
                                    </ul>
                                         
                                </div>
                            </div>
                        
                            <div class="content-card">
                                <h3 class="content-title">Tips for an Enjoyable Trip</h3>
                                <div class="content-text">
                                    <ol class="info-visitor">
                                        <li>Bring all the essentials like water, hats, sunscreens and snorkeling gear.</li>
                                        <li>Kindly respect the environment and dont touch the corals and marine creatures.</li>
                                        <li>Hire a local guide that will enhance your experience and learn more about the island ecology.</li>
                                        <li>If you are going on a boat trip, start early in the morning and avoid rough afternoon seas.</li>
                                        <li>Use reef safe sunscreen to protect marine life while enjoying the sun.</li>
                                        
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
<!-- Popular Packages Section -->
<section class="packages-section" id="cellular-pkg-lst">
    <div class="container">
        <div class="section-title text-center mb-4">
            <h2>Popular Packages in <span>Andaman</span></h2>
            <p>Choose from our awesome selling packages for your Andaman adventure</p>
        </div>

         @php
        use App\Models\TourPackages;

        $tours = TourPackages::with(['tourCategory', 'subCategories','tourPhotos'])
            ->where(function($q) {
                $q->where('best_seller', 1)
                ->orWhere('featured', 1);
            })
            ->inRandomOrder()
            ->take(3)
            ->get();

        foreach ($tours as $tour) {
            $subCat = $tour->subCategories->sortBy('rating')->first();
            if ($subCat) {
                $tour->price = $subCat->pivot->starts_from ?? 0;
                $tour->sub_cat = $subCat->name;
            } else {
                $tour->price = 0;
                $tour->sub_cat = null;
            }
        }
        @endphp

        <div class="row">

        @foreach($tours as $tour)
            <div class="col-lg-4 col-md-6">
                <div class="package-card">
                    <div class="package-image">
                        <img src="{{ @$tour->tourPhotos[0]->file }}"
                            alt="{{ Str::slug($tour->package_name) }}">
                        <div class="package-price">
                            <span>₹{{ number_format($tour['price']) }}</span>
                            <small>per person</small>
                        </div>
                    </div>
                    <div class="package-content">
                        <h3> Andaman {{$tour->tourCategory->name}} Package</h3>
                        <div class="package-meta">
                            <span><i class="fas fa-clock"></i>{{ $tour->package_name }}</span>
                            <span><i class="fas fa-user-friends"></i> Min 2 Pax</span>
                        </div>
                        <p>{{ Str::words(strip_tags(Str::replace('&nbsp;', '' ,$tour->description)),30) }}</p>
                        <div class="package-features">
                            <span><i class="fas fa-check-circle"></i> Ferry Tickets</span>
                            <span><i class="fas fa-check-circle"></i> Cab Transfers</span>
                            <span><i class="fas fa-check-circle"></i> Guide</span>
                        </div>
                        <a href="{{ route('tour.static', ['category' => Str::slug($tour['sub_cat']), 'slug' => $tour['tourCategory']['slug'], 'subslug' => $tour['slug']]) }}"
                            class="btn btn btn-sm btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        @endforeach
          
        </div>
    </div>
</section>

<!-- Sightseeing in Portblair Section -->
<section class="sightseeing-section">
    <div class="container">
        <div class="row">
            <div class="section-title text-center mb-4">
                <h2>Sightseeing in <span>Port Blair</span></h2>
                <p>Explore the natural wonders and attractions of Port Blair</p>
            </div>
            <!-- Jolly Buoy Island -->
            <div class="col-lg-4 col-md-6">
                <div class="package-card">
                    <div class="package-image">
                        <img src="https://andamanbliss.com/site/img/jolly1.jpg"
                            alt="jolly bouy" class="img-fluid">
                        <div class="package-price">
                            <span>Contact Us</span>
                            
                        </div>
                    </div>
                    <div class="package-content">
                        <h3>Jolly Buoy Island</h3>
                        <div class="package-meta">
                            <span><i class="fas fa-clock"></i> 3 Hours</span>
                            
                        </div>
                        <p>Jolly Buoy is a paradise near Port Blair, known for it's crystal clear waters, vibrant corals which is perfect for nature lovers.</p>
                        <div class="package-features">
                            <span><i class="fas fa-car"></i> Pickup & Drop</span>
                            <span><i class="fas fa-ship"></i> Ferry Tickets</span>
                            <span><i class="fas fa-user-tie"></i> Tour Guide</span>
                            <span><i class="fas fa-camera"></i> Sightseeing</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/port-blair/jolly-buoy-island" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Cellular Jail -->
            <div class="col-lg-4 col-md-6">
                <div class="package-card">
                    <div class="package-image">
                        <img src="https://andamanbliss.com/site/img/rossisland.avif"
                            alt="Ross Island" class="img-fluid">
                        <div class="package-price">
                            <span>Contact Us</span>
                           
                        </div>
                    </div>
                    <div class="package-content">
                        <h3>Ross Island</h3>
                        <div class="package-meta">
                            <span><i class="fas fa-clock"></i> 1 Hour</span>
                           
                        </div>
                        <p>Ross Island is a historical site located near Port Blair, which is famous for its colonial ruins and it also takes you to the past by offering you a chance to see the British era.</p>
                        <div class="package-features">
                            <span><i class="fas fa-car"></i> Pickup & Drop</span>
                            <span><i class="fas fa-user-tie"></i> Tour Guide</span>
                            <span><i class="fas fa-camera"></i> Sightseeing</span>
                        </div>
                        <a href="/islands/port-blair/ross-island" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Chidiyatapu Beach -->
            <div class="col-lg-4 col-md-6">
                <div class="package-card">
                    <div class="package-image">
                        <img src="https://andamanbliss.com/site/img/chidiyatapu-bg2.jpg" class="img-fluid rounded"
                            alt="Chidiyatapu Beach">
                        <div class="package-price">
                            <span>Contact Us</span>
                            
                        </div>
                    </div>
                    <div class="package-content">
                        <h3>Chidiyatapu Beach</h3>
                        <div class="package-meta">
                            <span><i class="fas fa-clock"></i> 3 Hours</span>
                            
                        </div>
                        <p>Chidiyatapu beach is located in Port Blair, which is a peaceful spot for sunset and various bird life paradise, perfect for nature walks and a peaceful escape.</p>
                        <div class="package-features">
                            <span><i class="fas fa-car"></i> Pickup & Drop</span>
                            <span><i class="fas fa-user-tie"></i> Tour Guide</span>
                            <span><i class="fas fa-coffee"></i> Refreshments</span>
                        </div>
                        <a href="/islands/port-blair/chidiatapu" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="faq-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="faq-header mb-5">
                    <h2 class="section-title-h2">Frequently Asked <span>Questions</span></h2>
                    <p class="faq-subtitle">Everything you need to know about visiting Mahatma Gandhi Marine National Park</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="faq-item" id="faq1">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer1">
                        <div class="faq-icon">
                            <i class="fas fa-water"></i>
                        </div>
                        <h3>Where is Mahatma Gandhi Marine National Park located?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer1">
                        <p>The Mahatma Gandhi Marine National Park is located about 29 kilometer west of Port Blair, which is near the coastal village of Wandoor in the Andaman and Nicobar Islands. </p>
                    </div>
                </div>

                <div class="faq-item" id="faq2">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer2">
                        <div class="faq-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h3>How can I reach this park?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer2">
                        <p>You need to take a cab or bus to reach Wandoor. From there, many Forest Department speedboat and ferries operates that take you to the island like Jolly Buoy and Red Skin island.</p>
                    </div>
                </div>

                <div class="faq-item" id="faq3">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer3">
                        <div class="faq-icon">
                            <i class="fas fa-swimmer"></i>
                        </div>
                        <h3>When is the best time to visit?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer3">
                        <p>The most ideal way to visit this island is between October to February. During these month, the weather is comfortable, seas are calm and all the outdoor adctivities like snorkeling and trekking are ideal.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="faq-item" id="faq4">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer4">
                        <div class="faq-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <h3>Which are the islands open for visitors near National Park?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer4">
                        <p>Some of the most popular islands includes Jolly Buoy which is known for its vibrant coral reefs and snorkeling. Red skin island which is smaller and perfect for a day trip and Tarmugli which is known as quieter island and its surrounded by mangroves and pristine beaches.</p>
                    </div>
                </div>

                <div class="faq-item" id="faq5">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer5">
                        <div class="faq-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>What are the entry fees and permits required?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer5">
                        <p>Visitors need to pay a nominal fee to enter the park. Adults are charged INR 50, children INR 25, while the Foreign National are required to pay INR 500 per person. There is also a camera fee of INR 25. To visit Red Skin island it will cost you around INR 300 per person and Jolly Buoy will cost you around INR 650 per person. Permits and tickets are generally obtained at the Wandoor jetty before boarding the boat.</p>
                    </div>
                </div>

                <div class="faq-item" id="faq6">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer6">
                        <div class="faq-icon">
                            <i class="fas fa-umbrella-beach"></i>
                        </div>
                        <h3> What activities can I enjoy at the park?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer6">
                        <p>The National Park offers a variety of activities like snorkeling and scuba diving that will let you explore the colorful coral reefs and marine life. The glass bottom boat ride will let you explore the underwater world without getting wet. Guest can relax on the beaches or go for a short trek where you can spot wildlife that includes turtles, monitor lizards and endemic birds.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection

@push('styles')
<style type="text/css">
    .styled-li > li{
        list-style: disc !important;
    }
  
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    // FAQ functionality
    $(document).ready(function() {
        $('.faq-question').on('click', function() {
            // Toggle aria-expanded attribute
            var isExpanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', !isExpanded);

            // Get the target collapse element
            var targetId = $(this).data('bs-target');

            // Toggle the collapse
            $(targetId).collapse('toggle');

            // Close other FAQs when opening a new one
            if (!isExpanded) {
                $('.faq-question').not(this).attr('aria-expanded', 'false');
                $('.collapse.faq-answer').not(targetId).collapse('hide');
            }
        });

        // Set initial state for FAQ items
        $('.faq-question').attr('aria-expanded', 'false');

        // Counter functionality for travelers count
        $('.counter-btn.minus').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var counterValue = $(this).siblings('.counter-value');
            var currentValue = parseInt(counterValue.text());
            var hiddenInput = $(this).closest('.counter-group').find('input[type="hidden"]');

            // Don't allow negative values, minimum is 0
            // For Adult, minimum is 1
            var isAdult = $(this).closest('.counter-group').find('.counter-label').text() === 'Adult';
            var minValue = isAdult ? 1 : 0;

            if (currentValue > minValue) {
                counterValue.text(currentValue - 1);
                hiddenInput.val(currentValue - 1);
            }
            return false;
        });

        $('.counter-btn.plus').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var counterValue = $(this).siblings('.counter-value');
            var currentValue = parseInt(counterValue.text());
            var hiddenInput = $(this).closest('.counter-group').find('input[type="hidden"]');

            // Maximum value (optional, can be adjusted)
            var maxValue = 10;

            if (currentValue < maxValue) {
                counterValue.text(currentValue + 1);
                hiddenInput.val(currentValue + 1);
            }
            return false;
        });
    });
</script>
@endpush