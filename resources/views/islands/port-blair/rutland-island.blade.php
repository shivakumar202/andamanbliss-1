@extends('layouts.app')
@section('title', 'Explore Rutland - Andaman Island With Andaman Bliss™')
@section('keywords', ' Cellular Jail In Port Blair, Light And Sound Show In Cellular Jail, Cellular Jail In Andaman
Islands')
@section('description', ' Looking for the best package for Andaman? Travel to Rutland Island with Andaman Bliss™ - expert tour operators with top-rated island experiences.')
@section('content')
<!-- Hero Section -->
<section class="island-hero-section">
    <div class="hero-slider">
        <div class="hero-slide active"
            style="background-image: url('{{asset("/site/img/islands/port-blair/rutland/rutland-island.jpg")}}')">
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
                                        <li class="breadcrumb-item active" aria-current="page">Rutland Island</li>
                                    </ol>
                                </nav>
                            </div>
                            <h1 class="hero-title">Rutland <span> Island</span></h1>
                            <p class="hero-subtitle">Step Into Nature and Discover the Untouched Beauty of Rutland Island.
                            </p>
                            <div class="hero-buttons">
                                <a href="#tour_details" class="btn btn-primary">Explore Rutland Island<i
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
                                            <span>Adventure</span>
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
                        <i class="fas fa-map-marker-alt"></i> Chidiyatapu, Sri Vijaya Puram
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
                                <h3 class="content-title">Welcome to Rutland Island - The Quiet Soul of the Andamans

                                </h3>
                                <div class="content-text">
                                    <p>
                                        Just about 20 kilometers south of the bustling capital city of Port Blair lies one of the Andaman Islands most enchanting yet overlooked treasures-Rutland Island. This pristine haven which is spread over an area of approximately 110 square kilometers, remains untouched by mass tourism and offers a soul-stirring escape into nature. Wrapped in the quietude of the sea and blanketed by lush green forests. </p>

                                    <p> Rutland is a sanctuary for those yearning to disconnect from the chaos of everyday life and reconnect with the raw, unfiltered essence of the natural world. Life here moves to the rhythm of nature and the island is home to six charming villages-Rutland Village, R.M. Point, Bamboo Nallah, Kichad Nallah, Bada Khari, and Dani Nallah. Together, they contain a small community of around 350 people where most of whom live by the sea, fishing and farming as generations before them have done.The landscape is gently rolling with two notable hills-Mount Ford to the north rising up to 433 meters and Mount Mayo to the south at 227 meters. </p>

                                    <p>At <a href="{{route('index')}}" target="_blank">Andaman Bliss™</a>, we don’t just see Rutland as a travel destination-we see it as an experience, a feeling and a memory waiting to be made. It’s the kind of place where time slows down where every sunrise feels like a personal invitation from nature and where every wave whispers stories of untouched shores and unexplored wonders. Whether you’re a nature lover, an adventure seeker or simply someone chasing tranquility. Rutland Island offers a deep and authentic connection that stays with you long after you’ve left its shores.</p>

                                    <div class="image-feature">
                                        <img src="{{ asset('site/img/islands/port-blair/rutland/rutland.jpg') }}" class="d-block img-fluid"
                                            alt="Photography banner">
                                        <div class="image-caption">Visit the iconic Rutland Island.
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="content-card">
                                <h3 class="content-title">Accessibility: Journeying to Rutland Island
                                </h3>
                                <div class="content-text">
                                    <p>
                                        At <a href="{{route('index')}}" target="_blank"> Andaman Bliss™ </a>, we believe that getting to your destination should be just as magical as the destination itself. And when it comes to Rutland Island, that belief holds true in every sense. Nestled approximately 20 kilometers south of Port Blair, Rutland Island is a serene haven that offers a blend of untouched natural beauty and rich marine biodiversity. Getting to this remote paradise is an adventure that includes both driving and a beautiful boat ride.
                                    </p>


                                </div>
                            </div>

                            <div class="content-card">
                                <h3 class="content-title">From City Streets to Coastal Retreats: The Route to Chidyatapu
                                </h3>
                                <div class="content-text">
                                    <p class="mt-3">Your unforgettable journey to Rutland Island doesn’t begin at sea- it begins on land, in the vibrant heart of the Andaman archipelago. A city where colonial architecture meets tropical rhythm. Port Blair is the perfect starting point for what lies ahead. From here, you’ll travel to <a href="{{route('islands.port-blair.chidiatapu')}}" target="_blank">Chidiya Tapu</a>, a picturesque coastal village known for its panoramic sunset views, lush mangroves and as the name suggests- abundant birdlife. With its buzzing markets, coastal promenades and views that stretch across the Bay of Bengal, it’s the perfect prologue to the story that is about to unfold. </p>

                                    <p><a href="{{route('islands.port-blair.chidiatapu')}}" target="_blank">Chidiyatapu </a> is named “bird island” situated approximately 25 kilometers south of port blair.The route to Chidiya Tapu can be taken by private taxi, rental vehicle or public transport that will give you a visual feast and a sensory experience. The drive itself is a scenic prelude to your island adventure with thick forests flanking the roads, occasional glimpses of the ocean and the fresh scent of salt in the air. </p>

                                    <p>As you fall into the final stretch of the drive and approach the shores of <a href="{{route('islands.port-blair.chidiatapu')}}" target="_blank">Chidiya Tapu</a>, a sense of serenity begins to take hold. The air grows noticeably fresher, cooler and charged with possibility. The golden hour light softens everything it touches, bathing the coast in hues of amber and coral.The mangrove-fringed beaches, tide pools, and hillside viewpoints promise more than scenic beauty—they promise stillness, perspective, and renewal.</p>

                                    <p>At <a href="{{route('index')}}" target="_blank"> Andaman Bliss™</a>, we redefine this passage not as a commute but as a transformative experience to every traveler that bridges the known and the unknown, preparing your heart and mind for the raw of untouched wonder that awaits just beyond the waves at Rutland Island.</p>

                                    <div class="feature-box">
                                        <div class="feature-icon">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>Did You Know?</h4>
                                            <p>Just 20 km south of Port Blair lies Rutland Island, a lesser known paradise of the Andaman archipelago. Spanning 110 sq km, this tranquil island features lush tropical forests,coral-lined shores and a remote village with slightly over 350 inhabitants. As part of the Mahatma Gandhi Marine National Park, Rutland is a sanctuary for marine biodiversity-ideal for snorkeling,nature walks and offbeat exploration.The unspoiled waters were once used for Indian Navy scuba training, adding to its unique legacy. Climb Mount Ford (433 m) for sweeping sea views and keep an eye out for flying fish,dolphins and sea eagles on your scenic boat ride from Chidiya Tapu. </p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="content-card">
                                <h3 class="content-title">Chidiya Tapu Jetty - Gateway to Untouched Paradise</h3>
                                <div class="content-text">
                                    <p class="mt-3">From the Chidiya Tapu Jetty, Embark on a boat journey to Rutland Island.This is where your true immersion into the Andaman wilderness begins.The boat journey to Rutland Island takes around 45 minutes to an hour which depends on sea conditions. But what an hour it is! The water here is a rich gradient of blue and green and as the boat carves its way across the sea, you’ll find yourself entranced by the ever changing canvas of colors, clouds and light.</p>
                                    <p class="mt-3">What begins as a simple boat ride from Chidiya Tapu to Rutland transforms into something far more profound- a cinematic journey through a living marine paradise where you witness the sea come alive in the most enchanting ways.Flying fish leap joyfully across the surface,catching the sunlight like silver elements. Dolphins often make a graceful appearance playfully arching through the water as if welcoming you to their ocean home. Overhead sea eagles glide with effortless majesty their wide wings casting fleeting shadows across the shimmering sea. Rutland has become a moving postcard, a real-time documentary directed by nature herself, where every wave is a frame, every splash a moment worth remembering.</p>


                                    <p class="mt-3">At <a href="{{route('index')}}" target="_blank"> Andaman Bliss™</a>, reaching Rutland is not merely a passage - it is a voyage through nature’s living canvas, where every moment reflects the soul of the Andaman archipelago.</p>

                                </div>
                            </div>
                            <div class="content-card overview-card">
                                <h3 class="content-title">Rutland Island - A Journey Unlike Any Other


                                </h3>
                                <div class="content-text">
                                    <p>
                                        Reaching Rutland Island isn’t just about getting from one point to another-it’s the start of a transformation. From the moment you leave the mainland behind, the journey becomes more than a matter of travel logistics. It becomes a subtle shift in energy, pace, and perspective. </p>

                                    <p> The sea breeze grows cooler,the sky feels wider and the rhythm of life becomes gentler with every passing wave. This is where the real magic begins, it is not just upon arrival but in the journey itself. It is about tuning into the sounds of nature, watching flying fish skip across the surface or spotting a sea eagle gliding effortlessly above. These quiet and almost meditative moments set the tone for what lies ahead, a destination that thrives in simplicity and celebrates nature in its purest form.
                                    </p>

                                    <p>With Andaman Bliss™, your journey to Rutland Island is more than just travel- it is a thoughtful introduction to Andaman island's unspoiled beauty and peaceful atmosphere that sets the stage for a truly paradisiacal experience.</p>

                                    <div class="image-feature">
                                        <img src="{{ asset('site/img/islands/port-blair/rutland/rutland-island.jpg') }}" class="d-block img-fluid"
                                            alt="Photography banner">
                                        <div class="image-caption">Disocver the stunning Rutland Island.
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="content-card">
                                <h3 class="content-title">Entry to a Protected Paradise: Permit Requirements-
                                </h3>
                                <div class="content-text">
                                    <p class="mt-3">
                                        It is important to acknowledge that Rutland Island forms an integral part of the Mahatma Gandhi Marine National Park, one of India’s foremost marine biodiversity reserves. This designation underscores the island's critical ecological importance, safeguarding vibrant coral reefs, rare marine species and delicate coastal ecosystems. Therefore, visitors are expected to observe all legal guidelines and embrace responsible travel practices that support the ongoing conservation and protection of this unique natural heritage.

                                    </p>
                                    <p class="mt-3">As Rutland Island falls under the protected area of the National Park, you may need official permits to access specific zones, especially if you’re planning to explore marine ecosystems, participate in diving or snorkeling activities or venture into conservation-sensitive areas. </p>

                                    <p class="mt-2">
                                        Permissions can be obtained from the following departments.-
                                    </p>
                                    <ul class="styled-li">
                                        <li>The Forest Department Office in Port Blair</li>
                                        <li>The Directorate of Tourism (for some marine activities)</li>
                                        <li>Authorized tour operator (such as Andaman Bliss™, who facilitate permits as part of your package)</li>
                                    </ul>
                                    <p>While the process to get permission is usually smooth, we strongly advise securing your permits well in advance especially during peak seasons (November to March), when visitor attendance is exhibiting a growth trend.</p>
                                    <p>During your visit, if you plan on participating in <a href="{{route('activities.index')}}" target="_blank">activities</a> such as scuba diving, underwater photography, turtle watching, or guided eco-trails make sure to mention them when applying as permits may vary based on the environmental sensitivity of the activity.</p>
                                    <p>At Andaman Bliss™, we help simplify the process which includes handling your permits, coordinating boat schedules and ensuring that your entire experience is seamless and stress-free.</p>
                                </div>
                            </div>

                            <div class="content-card">
                                <h3 class="content-title">Rutland Island Uncovered: Nature, Adventure & Culture-</h3>
                                <div class="content-text">
                                    <p class="mt-3">
                                        Rutland Island tucked just south of Port Blair, is a hidden treasure where nature still whispers in its purest form. With crystal-clear waters, vibrant coral reefs and lush greenery, the island offers a peaceful escape far from the usual tourist trail. Activity like snorkeling here is a dream-colorful fish dart around healthy reefs just beneath the surface. For those who love to explore on land, gentle treks through forested trails lead to panoramic viewpoints like Mount Ford offering sweeping views of the Andaman Sea.
                                    </p>
                                    <p>
                                        At Andaman Bliss™, Experience Rutland beyond the ordinary. it is not just a destination, it’s a place to reconnect with nature, slow down and soak in serenity.
                                    </p>
                                    <ol class="info-visitor">
                                        <li><b>Beach Hopping: Discovering Secluded Shores
                                            </b>
                                        </li>
                                        <ul class="styled-li">
                                            <p class="mb-0">Rutland Island is home to a collection of untouched beaches, each with its own distinct atmosphere:</p>
                                            <li>Bada Khari Beach: Nestled in Woodmason Bay, the beach boasts immaculate white sands and turquoise waters.</li>
                                            <li>Jahaji Beach: South Andaman's largest beach pavilion, covering 11 hectares, boasts shallow teal waters and is bordered by littoral forests.</li>
                                            <li>Niranjan Balu and Hathi Level Beach: Located on the northwestern side, these beaches provide tranquil scenery perfect for unwinding.</li>
                                            <li>Katla Dera, Photo Nallah 1 & 2, Dhani Khari, and Bakra Balu: These beaches provide diverse coastal experiences, from rocky shores to calm coves.</li>
                                            <li>Pharsa Dera and Machi Dera: Situated on the southeastern flank, these shores are recognized for their distinctive locales and serene atmospheres.</li>
                                        </ul>
                                        <li><b>Snorkeling and Scuba Diving: Exploring Underwater Wonders
                                            </b>
                                        </li>
                                        <ul class="styled-li">
                                            <p class="mb-0">The waters surrounding Rutland Island are a diver's paradise, housing more than 300 species of stony corals.Notable diving sites include:</p>
                                            <li>Southwestern Peninsula: Near Jahaji Beach and Woodsman Bay, this site offers vibrant coral reefs and diverse marine life.
                                            </li>
                                            <li>Portman Bay Beach: A small sandy shore with crystal clear waters and visibility up to 60 meters which is ideal for spotting sea turtles and eagle rays.
                                            </li>
                                        </ul>
                                        <p>Rutland Island is ideal for beginner open water diving training offering depths between 5 and 20 meters.</p>
                                        <li><b>Glass-Bottom Boat Rides: A Window to the Marine World
                                            </b>
                                        </li>
                                        <p>For those hesitant to fully engage, glass-bottom boat rides offer a glimpse into the vibrant marine ecosystem. These rides give opportunities to observe colorful corals, sea turtles and various fish species in their natural habitat.</p>
                                        <li><b>Kayaking: Navigating Through Mangroves
                                            </b>
                                        </li>
                                        <p>Kayaking in the sea of Rutland Island allows visitors to explore its tranquil waters and mangrove lined coasts. Paddling through these tranquil environments offer a unique perspective of the island's biodiversity.</p>
                                        <li><b>Trekking: Journeying Through Lush Forests
                                            </b>
                                        </li>
                                        <p>The islands interior is crisscrossed with trails leading through dense forests and up gentle hills. These treks provide opportunities to spot endemic bird species and enjoy panoramic views of the surrounding seascape.</p>
                                        <li><b>Fishing: Engaging in Traditional Practices
                                            </b>
                                        </li>
                                        <p>Rutland Island is a well liked destination for fishing. Tourists have many options to participate in conventional fishing techniques or embark on organized excursions to catch fish such as Yellow Fin Tuna, Barracuda and Red Snapper.</p>
                                        <li><b>Turtle Watching: Witnessing Nature's Miracle
                                            </b>
                                        </li>
                                        <p>Dani Nallah one of the island's villages which is known for its turtle nesting sites. During the nesting season, visitors can observe turtles laying eggs and hatchlings making their way to the sea-a truly mesmerizing experience.</p>
                                        <li><b>Visiting the Lighthouse: A Historical Perspective
                                            </b>
                                        </li>
                                        <p>Rutland Island houses a lighthouse situated on the slopes of a hill in the northern part of the island, covering about 2 kilometers from the landing point. This lighthouse not only aids in navigation but also offers visitors a glimpse into the island's maritime history</p>
                                        <li><b>Bird Watching: A Paradise for Ornithologists
                                            </b>
                                        </li>
                                    </ol>
                                    <p>The island's diverse island habitats support many bird species, making it a haven for bird watchers. From endemic species to migratory birds, the avian diversity adds to the island's ecological richness.</p>

                                    <div class="image-feature">
                                        <img src="{{ asset('site/img/islands/port-blair/rutland/rutland-and.jpg') }}" class="d-block img-fluid"
                                            alt="Photography banner">
                                        <div class="image-caption">Explore the hidden gem of Andaman Island.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-card">
                                <h3 class="content-title">Before You Go: Essential Tips for a Smooth Rutland Adventure:</h3>
                                <div class="content-text">
                                    <p> Heading to Rutland Island? Take note of these important tips to ensure a smooth and well-prepared journey.</p>
                                    <ul class="styled-li">
                                        <li><b>Plan your boat charter in advance-</li></b>
                                        <p class="mb-0">There isn't a fixed public timetable for boats traveling between Chidiya Tapu and Rutland Island. Typically, these boats are either privately chartered via local services or arranged as part of a guided tour.</p>
                                        <p>At Andaman Bliss™, we offer transportation options including private transfers, group charters and for a luxurious experience, catamarans are available upon request.</p>

                                        <li><b>Travel light but smart-</li></b>
                                        <p class="mb-0">Due to Rutland's isolated location and scarce commercial facilities, it is advisable to bring necessary items like water, sunscreen, biodegradable toiletries, insect repellent and any personal medications.</p>
                                        <p>Wear comfortable clothes and shoes that are suitable for beach landings and forest walks.</p>
                                        <li><b> Respect Local Regulations-</li></b>
                                        <p class="mb-0">Entry into restricted zones is prohibited without the necessary authorization.</p>
                                        <p>Opt for reusable water bottles and eco-conscious equipment to reduce your reliance on single-use plastics.If you are driving, please adhere to reef-friendly diving practices.</p>
                                        <li><b>Travel light but smart-</li></b>
                                        <p class="mb-0">Although the island is accessible year-round, the best time to visit is October to April, during these months Andaman Sea typically exhibits significantly calmer conditions, making it ideal for various water-based activities such as swimming, snorkeling and scuba diving. The skies are also generally clearer, offering enhanced visibility both above and below the water's surface and providing stunning panoramic views of the island's lush landscapes and pristine beaches.</p>

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
                    <p class="faq-subtitle">Everything you need to know about visiting Rutland Island</p>
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
                        <h3>Where is Rutland Island located?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer1">
                        <p>Rutland island is located approximately 20 km south of Port Blair, the capital of the Andaman and Nicobar Islands. It is a part of the Rutland Archipelago and is separated from Little Andaman by the Duncan Passage and from North Cinque Island by the Manner Straits. </p>
                    </div>
                </div>

                <div class="faq-item" id="faq2">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer2">
                        <div class="faq-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h3>How to reach Rutland Island?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer2">
                        <p>To reach Rutland island, you need to travel Port Blair first. From there, you need to take a boat or ferry to reach rutland island. The journey usually takes around 2.5 hours. If you are coming from Havelock Island, you will first need to head towards Port Blair by ferry. Once you reach Port Blair, you can buy your tourist permit and can complete all the necessary formalities required to visit Rutland Island.</p>
                    </div>
                </div>

                <div class="faq-item" id="faq3">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer3">
                        <div class="faq-icon">
                            <i class="fas fa-swimmer"></i>
                        </div>
                        <h3>Do I need a permit to visit Rutland Island?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer3">
                        <p>Yes, visitors are required a Restricted Area Permit (RAP) to visit Rutland Island. You can obtain this permit from the District Mangistrate office in Port Blair. We recommend you to apply well in advance because the process may take some time.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="faq-item" id="faq4">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer4">
                        <div class="faq-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <h3>What is the best time to visit Rutland Island?
                        </h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer4">
                        <p>The best time to visit Rutland island is between October and April. During these month, the weather is pleasant with clear skies and perfect for sightseeing and outdoor activities.</p>
                    </div>
                </div>

                <div class="faq-item" id="faq5">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer5">
                        <div class="faq-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>What are the top attractions on Rutland Island?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer5">
                        <p>The top attractions on Rutland Island includes Dani Nallah, which is known for its vibrant marine life and turtle breeding grounds. Jahaji Beach & Bada Balu, which is known for its crystal clear beach and its ideal for relaxation. Manner Strait, a scenic path that separates Rutland island from North Cinque Island. Photo Nallah, which is a perfect spot for photography lovers.</p>
                    </div>
                </div>

                <div class="faq-item" id="faq6">
                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faqAnswer6">
                        <div class="faq-icon">
                            <i class="fas fa-umbrella-beach"></i>
                        </div>
                        <h3> Are there accommodations on the island?</h3>
                        <div class="faq-toggle">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="collapse faq-answer" id="faqAnswer6">
                        <p>Accommodation options on Rutland Islands are limited. There is one basic guesthouse available for visitors. Its recommended to book your accommodation well in advance and be prepared for minimal amenities.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection

@push('styles')
<style type="text/css">
    .styled-li>li {
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