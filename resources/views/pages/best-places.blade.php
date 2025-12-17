@extends('layouts.app')

@section('title', 'Best Places to Visit in Andaman - 52 Must-See Destinations (2023 Guide)')
@section('meta_description', 'Discover the 52 most beautiful places to visit in Andaman Islands. From pristine beaches
like Radhanagar to historical sites like Cellular Jail, plan your perfect Andaman trip with our comprehensive guide.')
@section('meta_keywords', 'Andaman places to visit, best places in Andaman, Andaman tourist spots, Andaman islands
travel guide, Andaman beaches, Radhanagar beach, Cellular Jail, Havelock Island, Neil Island, Port Blair attractions')

@section('canonical')
<link rel="canonical" href="{{ url('best-places-to-visit') }}" />
@endsection

@section('meta_schema')

{
"@context": "https://schema.org",
"@type": "WebPage",
"name": "Best Places to Visit in Andaman Islands",
"url": "https://www.andamanbliss.com/best-places-to-visit-in-andaman",
"mainEntity": {
"@type": "TravelGuide",
"headline": "24 Best Places to Visit in Andaman Islands (2023 Ultimate Guide)",
"description": "Discover the 24 most beautiful places to visit in Andaman Islands with our comprehensive travel guide. From pristine beaches like Radhanagar to historical sites like Cellular Jail, plan your perfect Andaman trip.",
"keywords": "Andaman places to visit, best places in Andaman, Andaman tourist spots, Radhanagar Beach, Cellular Jail, Havelock Island, Neil Island, Port Blair attractions, Baratang Island, Little Andaman, North Andaman",
"itemListElement": [
{ "@type": "TouristAttraction", "name": "Cellular Jail", "location": { "@type": "Place", "name": "Port Blair" } },
{ "@type": "TouristAttraction", "name": "Ross Island", "location": { "@type": "Place", "name": "Port Blair" } },
{ "@type": "TouristAttraction", "name": "Chidiya Tapu", "location": { "@type": "Place", "name": "Port Blair" } },
{ "@type": "TouristAttraction", "name": "North Bay", "location": { "@type": "Place", "name": "Port Blair" } },
{ "@type": "TouristAttraction", "name": "Corbyn's Cove Beach", "location": { "@type": "Place", "name": "Port Blair" } },
{ "@type": "TouristAttraction", "name": "Jolly Buoy Beach", "location": { "@type": "Place", "name": "Port Blair" } },
{ "@type": "TouristAttraction", "name": "Radhanagar Beach", "location": { "@type": "Place", "name": "Havelock Island" } },
{ "@type": "TouristAttraction", "name": "Elephant Beach", "location": { "@type": "Place", "name": "Havelock Island" } },
{ "@type": "TouristAttraction", "name": "Kalapathar Beach", "location": { "@type": "Place", "name": "Havelock Island" } },
{ "@type": "TouristAttraction", "name": "Bharatpur Beach", "location": { "@type": "Place", "name": "Neil Island" } },
{ "@type": "TouristAttraction", "name": "Laxmanpur Beach", "location": { "@type": "Place", "name": "Neil Island" } },
{ "@type": "TouristAttraction", "name": "Natural Bridge (Howrah Bridge)", "location": { "@type": "Place", "name": "Neil Island" } },
{ "@type": "TouristAttraction", "name": "Limestone Caves", "location": { "@type": "Place", "name": "Baratang" } },
{ "@type": "TouristAttraction", "name": "Mud Volcano", "location": { "@type": "Place", "name": "Baratang" } },
{ "@type": "TouristAttraction", "name": "Parrot Island", "location": { "@type": "Place", "name": "Baratang" } },
{ "@type": "TouristAttraction", "name": "Ross and Smith Islands", "location": { "@type": "Place", "name": "North & Middle Andaman" } },
{ "@type": "TouristAttraction", "name": "Saddle Peak National Park", "location": { "@type": "Place", "name": "North & Middle Andaman" } },
{ "@type": "TouristAttraction", "name": "Kalipur Beach", "location": { "@type": "Place", "name": "North & Middle Andaman" } },
{ "@type": "TouristAttraction", "name": "Butler Bay Beach", "location": { "@type": "Place", "name": "Little Andaman" } },
{ "@type": "TouristAttraction", "name": "White Surf Waterfall", "location": { "@type": "Place", "name": "Little Andaman" } },
{ "@type": "TouristAttraction", "name": "Kalapathar Crocodile Sanctuary", "location": { "@type": "Place", "name": "Little Andaman" } },
{ "@type": "TouristAttraction", "name": "Lalaji Bay Beach", "location": { "@type": "Place", "name": "Long Island" } },
{ "@type": "TouristAttraction", "name": "Guitar Island", "location": { "@type": "Place", "name": "Long Island" } },
{ "@type": "TouristAttraction", "name": "Merk Bay", "location": { "@type": "Place", "name": "Long Island" } }
]
},
"publisher": {
"@type": "Organization",
"name": "Andaman Bliss™ Pvt Ltd",
"url": "https://www.andamanbliss.com",
"logo": {
"@type": "ImageObject",
"url": "https://www.andamanbliss.com/logo.png"
},
"contactPoint": [
{
"@type": "ContactPoint",
"telephone": "+91-8900909900",
"contactType": "Customer Service"
},
{
"@type": "ContactPoint",
"telephone": "+91-9933202248",
"contactType": "Customer Service"
}
]
}
}


@endsection

@section('content')
<!-- Back to Top Button -->
<a href="#" id="back-to-top" class="back-to-top">
    <i class="fas fa-arrow-up"></i>
</a>

<!-- Breadcrumb -->


<!-- Hero Section -->
<div class="andaman-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class=" text-white">24 Best Places to Visit in Andaman</h1>
                <p class="lead">A comprehensive guide to help you plan your perfect Andaman vacation</p>
                <div class="hero-buttons">
                    <a href="#places-list"  class="btn btn-primary">Explore All Places</a>
                    <a href="{{ route('tours.index') }}" class="btn btn-outline-light">Plan Your Trip</a>
                </div>
            </div>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb" class="bg-light py-2 shadow">
    <div class="container">
        <ol class="breadcrumb mb-0 mt-3 ">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Best Places to Visit</li>
        </ol>
    </div>
</nav>
<!-- Introduction Section -->
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-8">
            <div class="intro-content">
                <h2>Best Places to visit Andaman and Nicobar islands in 8 Days</h2>
                <p>
                    The <a href="https://en.wikipedia.org/wiki/Andaman_Islands" target="_blank" rel="noopener">Andaman
                        and Nicobar islands</a> are where crystal blue waters meet soft white sands and each wave is a
                    little slower than the one before. They are often called India's island paradise made up of
                    untouched beaches, rainforests, coral reefs and ancient culture.
                    From the peaceful beauty of Radhanagar beach to the mysterious withering limestone caves in
                    Baratang, there are magic moments everywhere on the island. Whether swimming with colorful fish,
                    walking in a forest, or watching the serene sunsets, Andaman island has experiences that you will
                    cherish forever.
                    If you are looking for a paradise of nature, adventure, and solitude, you have found one. Here is a
                    list of handpicked destinations for you to consider visiting in the Andaman and Nicobar islands;
                    each one will provide a memory that stays with you for a lifetime.
                </p>

                <div class="quick-facts mt-4 mb-4">
                    <h3>Quick Facts About Andaman</h3>
                    <ul>
                        <li><strong>Location:</strong> Bay of Bengal, India</li>
                        <li><strong>Capital:</strong> Port Blair</li>
                        <li><strong>Best Time to Visit:</strong> October to May</li>
                        <li><strong>Known For:</strong> Pristine beaches, coral reefs, water sports, indigenous tribes
                        </li>
                        <li><strong>Major Islands:</strong> South Andaman, North Andaman, Middle Andaman, Little
                            Andaman, Havelock (Swaraj Dweep), Neil Island (Shaheed Dweep)</li>
                        <li><strong>Popular Activities:</strong> Scuba diving, snorkeling, sea walking, glass-bottom
                            boat rides, trekking</li>
                        <li><strong>Languages Spoken:</strong> Hindi, English, Bengali, Tamil</li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="toc-sidebar sticky-top" style="top: 100px; z-index: 1000;">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-warning" style="background-color: #ff8c00 !important;">
                        <h3 class="text-white mb-0 fs-4"><i class="fas fa-map-marked-alt me-2"></i>Explore Destinations
                        </h3>
                    </div>
                    <div class="card-body px-3">
                        <nav id="table-of-contents" class="table-of-contents">
                            <div class="p-3 border-bottom">
                                <!-- <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="fas fa-search"></i></span>
                                    <input type="text" id="toc-search"
                                        class="form-control form-control-sm border-0 bg-light"
                                        placeholder="Search destinations..." aria-label="Search destinations">
                                </div> -->
                            </div>
                            <ul class="toc-list list-group list-group-flush" aria-label="Table of contents">
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2 border-0 border-bottom">

                                    <p class="text-decoration-none text-dark stretched-link">Port
                                        Blair - The Gateway</p>
                                    <span class="badge rounded-pill" style="background-color: #ff8c00;">6</span>
                                </li>
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2 border-0 border-bottom">

                                    <p class="text-decoration-none text-dark stretched-link">Havelock
                                        Island - Beach Paradise</p>
                                    <span class="badge rounded-pill" style="background-color: #ff8c00;">3</span>
                                </li>
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2 border-0 border-bottom">

                                    <p class="text-decoration-none text-dark stretched-link">Neil
                                        Island - Vegetable Bowl</p>
                                    <span class="badge rounded-pill" style="background-color: #ff8c00;">3</span>
                                </li>
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2 border-0 border-bottom">

                                    <p class="text-decoration-none text-dark stretched-link">Baratang
                                        Island - Hidden Wonders</p>
                                    <span class="badge rounded-pill" style="background-color: #ff8c00;">3</span>
                                </li>
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2 border-0 border-bottom">

                                    <p class="text-decoration-none text-dark stretched-link">North
                                        & Middle Andaman</p>
                                    <span class="badge rounded-pill" style="background-color: #ff8c00;">3</span>
                                </li>
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2 border-0 border-bottom">
                                    <p class="text-decoration-none text-dark stretched-link">Little Andaman - Remote
                                        Paradise</p>
                                    <span class="badge rounded-pill" style="background-color: #ff8c00;">3</span>
                                </li>
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2 border-0 border-bottom">
                                    <p class="text-decoration-none text-dark stretched-link">Long
                                        Island</p>
                                    <span class="badge rounded-pill" style="background-color: #ff8c00;">3</span>
                                </li>

                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2 border-0">
                                    <p class="text-decoration-none text-dark stretched-link">Frequently
                                        Asked Questions</p>
                                    <i class="fas fa-question-circle" style="color: #ff8c00;"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Places List Section -->
<div class="container mt-5" id="places-list">
    <!-- Port Blair Section -->
    <div id="port-blair" class="destination-section mb-5">
        <div class="section-header text-center mb-4">
            <h2>Port Blair- Top places to visit in the getaways of Andaman island</h2>
            <p class="text-muted">The capital city of Andaman and Nicobar Islands offers a perfect blend of history,
                culture, and natural beauty.</p>
        </div>

        <div class="row">
            <!-- Place 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">1</div>
                    <img src="https://andamanbliss.com/site/img/cellular-jail2.webp" class="card-img-top"
                        alt="Cellular Jail, Port Blair">
                    <div class="card-body">
                        <h3 class="card-title">Cellular Jail</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Port Blair</span>
                            <span><i class="fas fa-clock"></i> 1-1:30mins hours</span>
                        </div>
                        <p class="card-text">A colonial prison that serves as a reminder of India's struggle for
                            independence. The <a
                                href="https://andamanbliss.com/water-sports/light-sound-show/show-in-cellular-jail"
                                target="_blank" rel="noopener noreferrer">Light and Sound</a> show narrates the story of
                            our freedom fighters who were imprisoned in cellular jail</a>.
                        </p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Historical</span>
                            <span class="badge bg-light text-dark">Museum</span>
                            <span class="badge bg-light text-dark">Light & Sound Show</span>
                        </div>
                        <a href="{{ url('islands/port-blair/cellular-jail') }}" class="read-more">Read more <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">2</div>
                    <img src="https://andamanbliss.com/site/img/rossisland.avif" class="card-img-top"
                        alt="Ross Island, Port Blair">
                    <div class="card-body">
                        <h3 class="card-title">Ross Island</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Near Port Blair</span>
                            <span><i class="fas fa-clock"></i> 2hrs</span>
                        </div>
                        <p class="card-text">Once an administrative headquarters of the British, now featured as scenic
                            ruins from colonial times and friendly peacocks and deer roaming freely.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Historical</span>
                            <span class="badge bg-light text-dark">Ruins</span>
                            <span class="badge bg-light text-dark">Nature</span>
                        </div>
                        <a href="{{ url('islands/port-blair/ross-island') }}" class="read-more">Read more <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">3</div>
                    <img src="https://andamanbliss.com/site/img/northbay1.jpg" class="card-img-top"
                        alt="North Bay Island, Port Blair">
                    <div class="card-body">
                        <h3 class="card-title">North Bay Island</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Near Port Blair</span>
                            <span><i class="fas fa-clock"></i> Half day</span>
                        </div>
                        <p class="card-text">Famous for its coral reefs and rich marine life, <a
                                href="https://andamanbliss.com/islands/port-blair/north-bay-island" target="_blank"
                                rel="noopener noreferrer">North Bay Island</a> offers excellent snorkeling and
                            glass-bottom boat rides. The island view is featured on the back of the ₹20 Indian note.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Snorkeling</span>
                            <span class="badge bg-light text-dark">Coral Reefs</span>
                            <span class="badge bg-light text-dark">Water Activities</span>
                        </div>
                        <a href="{{ url('islands/port-blair/north-bay-island') }}" class="read-more">Read more <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 4 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">4</div>
                    <img src="https://andamanbliss.com/site/img/chidiyatapu-bg2.jpg" class="card-img-top"
                        alt="Chidiya Tapu, Port Blair">
                    <div class="card-body">
                        <h3 class="card-title">Chidiya Tapu</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> 25 km from Port Blair</span>
                            <span><i class="fas fa-clock"></i> Half day</span>
                        </div>
                        <p class="card-text">Also known as the 'Bird Island', Chidiya Tapu is a paradise for bird
                            watchers and offers one of the most mesmerizing sunsets in Andaman. The Chidiya Tapu
                            Biological Park is home to many rare and native bird species.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Bird Watching</span>
                            <span class="badge bg-light text-dark">Sunset Point</span>
                            <span class="badge bg-light text-dark">Nature Trails</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/port-blair/chidiatapu" class="read-more">Read more <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 5 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">5</div>
                    <img src="https://andamanbliss.com/site/img/corbyn4.jpg" class="card-img-top"
                        alt="Corbyn's Cove Beach">
                    <div class="card-body">
                        <h3 class="card-title">Corbyn's Cove Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Port Blair</span>
                            <span><i class="fas fa-clock"></i> Half day</span>
                        </div>
                        <p class="card-text">Located just 7 kilometers from Port Blair in the Andaman and Nicobar
                            islands, is a blend of relaxation and adventure renowned for its white sandy beaches, clear
                            water and lush coconut palm backdrop.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Marine Life</span>
                            <span class="badge bg-light text-dark">Snorkeling</span>
                            <span class="badge bg-light text-dark">Conservation</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/port-blair/corbyns-cove" class="read-more">Read more
                            <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 6 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">6</div>
                    <img src="https://andamanbliss.com/site/img/jouly-bout-banner.webp" class="card-img-top"
                        alt="Samudrika Naval Marine Museum, Port Blair">
                    <div class="card-body">
                        <h3 class="card-title">Jolly buoy Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Port Blair</span>
                            <span><i class="fas fa-clock"></i> Half Day hours</span>
                        </div>
                        <p class="card-text">One of the most beautiful and protected islands located about 30 km from
                            Port Blair. Known for its crystal clear water, colorful coral and white sandy beaches, it is
                            a perfect spot for snorkeling and glass bottom boat rides.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Museum</span>
                            <span class="badge bg-light text-dark">Marine Life</span>
                            <span class="badge bg-light text-dark">Educational</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/port-blair/jolly-buoy-island" class="read-more">Read
                            more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Havelock Island Section -->
    <div id="havelock" class="destination-section mb-5">
        <div class="section-header text-center mb-4">
            <h2>Top 3 places to visit in Havelock Island</h2>
            <p class="text-muted">Home to some of Asia's best beaches, Havelock Island offers pristine white sands,
                turquoise waters, and world-class diving opportunities.</p>
        </div>

        <div class="row">
            <!-- Place 8 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">7</div>
                    <img src="https://andamanbliss.com/site/img/radhanagarbeach1.avif" class="card-img-top"
                        alt="Radhanagar Beach, Havelock Island">
                    <div class="card-body">
                        <h3 class="card-title">Radhanagar Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Havelock Island</span>
                            <span><i class="fas fa-clock"></i> Half day</span>
                        </div>
                        <p class="card-text">Often ranked as Asia best beach, <a
                                href="https://andamanbliss.com/islands/havelock-swaraj-dweep/radhanagar-beach"
                                target="_blank" rel="noopener noreferrer"></a> is known for its white sandy beaches,
                            crystal clear water and breathtaking sunsets. Radhanagar Beach I is a tropical paradise that
                            offers a perfect escape into nature.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">White Sand Beach</span>
                            <span class="badge bg-light text-dark">Swimming</span>
                            <span class="badge bg-light text-dark">Sunset Views</span>
                        </div>
                        <a href="{{ url('islands/havelock-swaraj-dweep/radhanagar-beach') }}" class="read-more">Read
                            more
                            <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 9 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">8</div>
                    <img src="https://andamanbliss.com/site/img/elephantabeach1.jpg" class="card-img-top"
                        alt="Elephant Beach, Havelock Island">
                    <div class="card-body">
                        <h3 class="card-title">Elephant Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Havelock Island</span>
                            <span><i class="fas fa-clock"></i> Half day</span>
                        </div>
                        <p class="card-text">known for its clear water, coral reefs and thrilling water sports
                            activities. Elephant Beach is a main spot for snorkeling and sea walking. This beach can be
                            reached by a 30 minute boat ride or a 2 km trek through the forest from Havelock.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Snorkeling</span>
                            <span class="badge bg-light text-dark">Coral Reefs</span>
                            <span class="badge bg-light text-dark">Water Sports</span>
                        </div>
                        <a href="{{ url('islands/havelock-swaraj-dweep/elephant-beach') }}" class="read-more">Read more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 10 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">9</div>
                    <img src="https://andamanbliss.com/site/img/kalaphatarBeach.avif" class="card-img-top"
                        alt="Kalapathar Beach, Havelock Island">
                    <div class="card-body">
                        <h3 class="card-title">Kalapathar Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Havelock Island</span>
                            <span><i class="fas fa-clock"></i> 2-3 hours</span>
                        </div>
                        <p class="card-text">Famous for its stunning black rock, this beach offers a peaceful retreat
                            away from the crowds. This beach is perfect for long walks and photography.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Secluded Beach</span>
                            <span class="badge bg-light text-dark">Photography</span>
                            <span class="badge bg-light text-dark">Peaceful Ambiance</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/kalapathar-beach"
                            class="read-more">Read more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Neil Island Section -->
    <div id="neil-island" class="destination-section mb-5">
        <div class="section-header text-center mb-4">
            <h2>Top Places to Visit in Neil Island (Shaheed Dweep), Andaman</h2>
            <p class="text-muted">A small but beautiful island known for its pristine beaches, clear waters, and
                laid-back atmosphere.</p>
        </div>

        <div class="row">
            <!-- Place 13 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">10</div>
                    <img src="https://andamanbliss.com/site/img/bharatpur-neil-island-1.avif" class="card-img-top"
                        alt="Bharatpur Beach, Neil Island">
                    <div class="card-body">
                        <h3 class="card-title">Bharatpur Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Neil Island</span>
                            <span><i class="fas fa-clock"></i> Half day</span>
                        </div>
                        <p class="card-text">A shallow beach perfect for swimming and snorkeling. You can see vibrant
                            coral reef and marine life in the pristine water. <strong>Glass bottom boat rides</strong>
                            are popular here</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Swimming</span>
                            <span class="badge bg-light text-dark">Snorkeling</span>
                            <span class="badge bg-light text-dark">Glass-bottom Boats</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/neil-shaheed-dweep/bharatpur-beach"
                            class="read-more">Read more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 14 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">11</div>
                    <img src="https://andamanbliss.com/site/img/laxmanpur_1.jpg" class="card-img-top"
                        alt="Laxmanpur Beach, Neil Island">
                    <div class="card-body">
                        <h3 class="card-title">Laxmanpur Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Neil Island</span>
                            <span><i class="fas fa-clock"></i> 2-3 hours</span>
                        </div>
                        <p class="card-text">Famous for its spectacular sunsets, Laxmanpur Beach is a serene stretch of
                            white sand. During low tide, you can explore the fascinating coral reefs and marine life in
                            the natural pools formed on the beach.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Sunset Views</span>
                            <span class="badge bg-light text-dark">Coral Reefs</span>
                            <span class="badge bg-light text-dark">Beach Walks</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/neil-shaheed-dweep/laxmanpur-beach"
                            class="read-more">Read more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 15 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">12</div>
                    <img src="https://andamanbliss.com/site/img/laxmanpurBeach.avif" class="card-img-top"
                        alt="Natural Bridge, Neil Island">
                    <div class="card-body">
                        <h3 class="card-title">Natural Bridge (Howrah Bridge)</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Neil Island</span>
                            <span><i class="fas fa-clock"></i> 1-2 hours</span>
                        </div>
                        <p class="card-text">Also known as the Howrah Bridge, a stunning rock formation created by years
                            of sea erosion. Located near Laxmanpur beach, surrounded by tide pools and marine life, a
                            perfect spot for photography and nature lovers.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Natural Formation</span>
                            <span class="badge bg-light text-dark">Marine Life</span>
                            <span class="badge bg-light text-dark">Photography</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/neil-shaheed-dweep/laxmanpur-beach"
                            class="read-more">Read more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Baratang Island Section -->
    <div id="baratang" class="destination-section mb-5">
        <div class="section-header text-center mb-4">
            <h2>Top 3 Places to visit in Baratang Island, Andaman - 2025 Guide</h2>
            <p class="text-muted">Home to unique limestone caves, mud volcanoes, and mangrove forests, Baratang offers a
                glimpse into nature's extraordinary creations.</p>
        </div>

        <div class="row">
            <!-- Place 18 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">13</div>
                    <img src="https://andamanbliss.com/site/img/baratang5.jpg" class="card-img-top"
                        alt="Limestone Caves, Baratang Island">
                    <div class="card-body">
                        <h3 class="card-title">Limestone Caves</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Baratang Island</span>
                            <span><i class="fas fa-clock"></i> Full day</span>
                        </div>
                        <p class="card-text">One of the most fascinating natural attractions in <a
                                href="https://andamanbliss.com/islands/baratang" target="_blank"
                                rel="noopener noreferrer">Baratang</a>. The journey includes a boat ride through
                            mangrove creeks and a short forest walk that offers a chance to spot wildlife, birds and
                            even saltwater crocodiles.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Natural Wonder</span>
                            <span class="badge bg-light text-dark">Boat Ride</span>
                            <span class="badge bg-light text-dark">Adventure</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/baratang/lime-stone-caves" class="read-more">Read more
                            <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 19 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">14</div>
                    <img src="https://andamanbliss.com/site/img/mudvalcano.jpg" class="card-img-top"
                        alt="Mud Volcanoes, Baratang Island">
                    <div class="card-body">
                        <h3 class="card-title">Mud Volcanoes</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Baratang Island</span>
                            <span><i class="fas fa-clock"></i> 2-3 hours</span>
                        </div>
                        <p class="card-text">Located about 100 km north of Port Blair, the journey to this site is an
                            adventure, a rare geological phenomenon where mud erupts from the earth's crust forming
                            small volcano like structures and is one of the only mud volcanoes in india.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Geological Wonder</span>
                            <span class="badge bg-light text-dark">Rare Sight</span>
                            <span class="badge bg-light text-dark">Photography</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/baratang/mud-volcano" class="read-more">Read more <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 20 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">15</div>
                    <img src="https://andamanbliss.com/site/img/baratang4.jpg" class="card-img-top"
                        alt="Mangrove Creeks, Baratang Island">
                    <div class="card-body">
                        <h3 class="card-title">Parrot island</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Baratang Island</span>
                            <span><i class="fas fa-clock"></i> 2-3 hours</span>
                        </div>
                        <p class="card-text">Located in Baratang, famous for its unique evening spectacle. This bird
                            returns every evening, creating a mesmerizing experience for nature and birdwatchers.
                            Visitors can reach the island by taking a short boat ride from Baratang jetty. A must visit
                            spot for birds and nature lovers.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Boat Safari</span>
                            <span class="badge bg-light text-dark">Wildlife</span>
                            <span class="badge bg-light text-dark">Ecosystem</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/baratang/parrot-island" class="read-more">Read more <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- North & Middle Andaman Section -->
    <div id="north-middle" class="destination-section mb-5">
        <div class="section-header text-center mb-4">
            <h2>Explore North & Middle Andaman – Hidden Gems and Top Attractions</h2>
            <p class="text-muted">Discover the less-visited but equally beautiful northern islands with their pristine
                beaches, lush forests, and rich tribal heritage.</p>
        </div>

        <div class="row">
            <!-- Place 21 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">16</div>
                    <img src="https://andamanbliss.com/site/img/diglipur3.jpg" class="card-img-top"
                        alt="Diglipur, North Andaman">
                    <div class="card-body">
                        <h3 class="card-title">Ross and Smith Island</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> North Andaman</span>
                            <span><i class="fas fa-clock"></i> 1 day</span>
                        </div>
                        <p class="card-text">Located in <a href="https://andamanbliss.com/islands/diglipur"
                                target="_blank" rel="noopener noreferrer">Diglipur</a>, two beautiful islands are
                            connected by natural sandbars that appear during low tides that creates a unique natural
                            bridge. The clean and clear water makes it perfect for swimming and snorkeling.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Beaches</span>
                            <span class="badge bg-light text-dark">Trekking</span>
                            <span class="badge bg-light text-dark">Wildlife</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/diglipur/ross-and-smith-island" class="read-more">Read
                            more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 22 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">17</div>
                    <img src="https://andamanbliss.com/site/img/saddle-peak.jpg" class="card-img-top"
                        alt="Saddle Peak, North Andaman">
                    <div class="card-body">
                        <h3 class="card-title">Saddle Peak National Park</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> North Andaman</span>
                            <span><i class="fas fa-clock"></i> Full day</span>
                        </div>
                        <p class="card-text">One of the highest peaks in the Andaman Islands 732 meters, this national
                            park offers challenging treks through dense evergreen forests. The destination provides
                            panoramic views of the surrounding islands and the Bay of Bengal.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Trekking</span>
                            <span class="badge bg-light text-dark">National Park</span>
                            <span class="badge bg-light text-dark">Viewpoint</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/diglipur/saddle-peak" class="read-more">Read more <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 23 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">18</div>
                    <img src="https://andamanbliss.com/site/img/Kalipur-Beach-Diglipur-.jpg" class="card-img-top"
                        alt="Kalipur Beach, North Andaman">
                    <div class="card-body">
                        <h3 class="card-title">Kalipur Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> North Andaman</span>
                            <span><i class="fas fa-clock"></i> 2-3hrs</span>
                        </div>
                        <p class="card-text">This peaceful beach is famous for its turtle nesting, especially Olive
                            Ridley and Leatherback turtles. From December to February, you can see turtles laying eggs
                            under the supervision of the forest officials.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Turtle Nesting</span>
                            <span class="badge bg-light text-dark">Secluded Beach</span>
                            <span class="badge bg-light text-dark">Nature</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/diglipur/kalipur-beach" class="read-more">Read more <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Little Andaman Section -->
    <div id="little-andaman" class="destination-section mb-5">
        <div class="section-header text-center mb-4">
            <h2>Little Andaman Travel Guide- A remote paradise in Andaman</h2>
            <p class="text-muted">A remote island with pristine beaches, lush green forest and serene atmosphere,
                perfect for those seeking adventure and untouched natural beauty</p>
        </div>

        <div class="row">
            <!-- Place 26 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">19</div>
                    <img src="https://andamanbliss.com/site/img/buttlerbay-beach1.avif" class="card-img-top"
                        alt="Butler Bay Beach, Little Andaman">
                    <div class="card-body">
                        <h3 class="card-title">Butler Bay Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Little Andaman</span>
                            <span><i class="fas fa-clock"></i> 1-2hrs</span>
                        </div>
                        <p class="card-text">A clean and quiet beach which is great for surfing, with waves for both
                            beginners and experts. The beach is also home to a beautiful waterfall nearby.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Surfing</span>
                            <span class="badge bg-light text-dark">Pristine Beach</span>
                            <span class="badge bg-light text-dark">Waterfall</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/little-andaman/butler-bay-beach"
                            class="read-more">Read more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 27 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">20</div>
                    <img src="https://andamanbliss.com/site/img/waterfall-little.jpeg" class="card-img-top"
                        alt="White Surf Waterfall, Little Andaman">
                    <div class="card-body">
                        <h3 class="card-title">White Surf Waterfall</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Little Andaman</span>
                            <span><i class="fas fa-clock"></i> 2-3 hours</span>
                        </div>
                        <p class="card-text">A beautiful waterfall located near Butler Bay Beach. This waterfall is
                            surrounded by lush green forest that offers a refreshing swimming experience in its natural
                            pool.
                        </p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Waterfall</span>
                            <span class="badge bg-light text-dark">Swimming</span>
                            <span class="badge bg-light text-dark">Nature</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/little-andaman/white-surf-waterfall"
                            class="read-more">Read more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 29 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">21</div>
                    <img src="https://andamanbliss.com/site/img/Kalapathar-beach-little-andaman.avif"
                        class="card-img-top" alt="Kalapathar Crocodile Sanctuary, Little Andaman">
                    <div class="card-body">
                        <h3 class="card-title">Kalapathar Crocodile Sanctuary</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Little Andaman</span>
                            <span><i class="fas fa-clock"></i> 2-3 hours</span>
                        </div>
                        <p class="card-text">This sanctuary protects saltwater crocodiles in their natural environment.
                            Visitors can take a boat ride through the mangrove creek and try to spot these amazing
                            reptiles in their natural habitat.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Wildlife</span>
                            <span class="badge bg-light text-dark">Boat Safari</span>
                            <span class="badge bg-light text-dark">Conservation</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/little-andaman/kalapathar-limestone-caves"
                            class="read-more">Read more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Long Island Section -->
    <div id="long-island" class="destination-section mb-5">
        <div class="section-header text-center mb-4">
            <h2>Long island- Andaman Hidden Paradise</h2>
            <p class="text-muted">A peaceful island with beautiful beaches, lush forests and a laid-back atmosphere,
                perfect for those looking to escape the tourist crowds.</p>
        </div>

        <div class="row">
            <!-- Place 30 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">22</div>
                    <img src="https://andamanbliss.com/site/img/lalaji-bay-beach1.jpg" class="card-img-top"
                        alt="Lalaji Bay Beach, Long Island">
                    <div class="card-body">
                        <h3 class="card-title">Lalaji Bay Beach</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Long Island</span>
                            <span><i class="fas fa-clock"></i> Full day</span>
                        </div>
                        <p class="card-text">Nestled on the west coast of <a
                                href="https://andamanbliss.com/islands/long-island" target="_blank"
                                rel="noopener noreferrer">Long island</a>, Andaman and Nicobar island is one of the
                            unspoiled paradise about 82 km from Port Blair. Known for its white sandy beaches and clear
                            water, it is ideal for swimming, snorkeling and dolphin watching.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Secluded Beach</span>
                            <span class="badge bg-light text-dark">Trekking</span>
                            <span class="badge bg-light text-dark">Dolphin Spotting</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/long-island/lalaji-bay-beach" class="read-more">Read
                            more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 31 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">23</div>
                    <img src="https://andamanbliss.com/site/img/guitarisland.jpg" class="card-img-top"
                        alt="Guitar Island, Long Island">
                    <div class="card-body">
                        <h3 class="card-title">Guitar Island</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Near Long Island</span>
                            <span><i class="fas fa-clock"></i> Half day</span>
                        </div>
                        <p class="card-text">Take a short boat ride from a long island to a small and guitar shaped
                            island. It is surrounded by coral reefs, perfect for snorkeling and taking underwater
                            photos.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Unique Island</span>
                            <span class="badge bg-light text-dark">Snorkeling</span>
                            <span class="badge bg-light text-dark">Boat Trip</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/long-island/guitar-island" class="read-more">Read more
                            <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Place 32 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 place-card">
                    <div class="place-number">24</div>
                    <img src="https://andamanbliss.com/site/img/merk-bay-beach1.jpg" class="card-img-top"
                        alt="Merk Bay, Long Island">
                    <div class="card-body">
                        <h3 class="card-title">Merk Bay</h3>
                        <div class="place-meta mb-2">
                            <span><i class="fas fa-map-marker-alt"></i> Long Island</span>
                            <span><i class="fas fa-clock"></i> 2-3 hours</span>
                        </div>
                        <p class="card-text">A peaceful bay surrounded by mangrove trees with a calm atmosphere. The bay
                            is perfect for bird watching and enjoying the sunsets and fishing.</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="place-tags mb-2">
                            <span class="badge bg-light text-dark">Mangroves</span>
                            <span class="badge bg-light text-dark">Bird Watching</span>
                            <span class="badge bg-light text-dark">Sunset Views</span>
                        </div>
                        <a href="https://andamanbliss.com/islands/long-island/merk-bay-beach-north-passage-island"
                            class="read-more">Read more <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- FAQ Section -->
<div id="faq" class="faq-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Frequently Asked Questions About Andaman</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion" id="andamanFAQ">
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What are the must-visit places in the Andaman and Nicobar Islands for an 8-day trip?
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#andamanFAQ">
                            <div class="accordion-body">
                                <p>For an 8 day tour package, the top destinations include Port Blair, Havelock island,
                                    Neil island, Baratang island, Diglipur, Little Andaman and Long island. The key
                                    attractions of our island are Cellular Jail, Radhanagar Beach, Limestone caves and
                                    Ross & Smith island.
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Is 8 days enough to explore the major attractions in Andaman island?
                            </button>
                        </h3>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#andamanFAQ">
                            <div class="accordion-body">
                                <p>Yes, 8 days of andaman tour is perfect to cover popular spots like Port Blair,
                                    Havelock, Neil island, Baratang and north & middle andaman. You will have much time
                                    for sightseeing, water activities and leisure.</p>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                What is the best time to visit Andaman island?
                            </button>
                        </h3>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#andamanFAQ">
                            <div class="accordion-body">
                                <p>The best time to visit is between October and May, when the weather is pleasant and
                                    ideal for beach activities and sightseeing.</p>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                How do I reach the Andaman Islands?
                            </button>
                        </h3>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#andamanFAQ">
                            <div class="accordion-body">
                                <p>You can reach the Andaman Islands by air or sea. The most convenient way is by flight
                                    to Veer Savarkar International Airport in Port Blair from major Indian cities like
                                    Chennai, Kolkata, Delhi, and Bangalore.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section py-5 mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="cta-content">
                    <h2>Ready to Experience the Magic of Andaman?</h2>
                    <p>Planning your ideal vacation is easy with Andaman Bliss™. Our experts design personalized Andaman
                        group tour packages that include the best attractions, comfortable stays and fun filled
                        activities all within your budget.</p>
                    <ul class="cta-features">
                        <li><i class="fas fa-check text-primary"></i> Personalized itineraries based on your interests
                        </li>
                        <li><i class="fas fa-check text-primary"></i> Best deals on hotels, activities, and
                            transportation</li>
                        <li><i class="fas fa-check text-primary"></i> 24/7 support during your trip</li>
                        <li><i class="fas fa-check text-primary"></i> Hassle free service</li>
                    </ul>
                    <div class="cta-buttons">
                        <a href="{{ route('tours.index') }}" class="btn btn-primary">Plan My Trip</a>
                        <a href="{{ url('contact') }}" class="btn btn-outline-light">Contact Us</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="compact-quote-form">
                    <div class="quote-form-header">
                        <h3 class="text-white"><i class="fas fa-paper-plane"></i> Get a Free Quote</h3>
                    </div>
                    <form id="lead-generation-form" action="{{ route('contact') }}" method="POST">
                        @csrf
                        <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                            autocomplete="off" value="">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="name" placeholder="Your Name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control" name="phone" placeholder="Phone Number"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>

                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="text" name="checkin" placeholder="dd-mm-yyyy" id="checkin" class="form-control" readonly>
                        </div>

                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-comment"></i></span>
                            <textarea class="form-control" name="message" rows="2"
                                placeholder="Trip Requirements"></textarea>
                        </div>

                        <div class="quote-benefits">
                            <span><i class="fas fa-check-circle"></i> Best Price</span>
                            <span><i class="fas fa-check-circle"></i> Custom Itineraries</span>
                            <span><i class="fas fa-check-circle"></i> 24/7 Support</span>
                        </div>

                        <button type="submit" class="btn btn-quote w-100">
                            <span>Get My Free Quote</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <input type="text" class="hidden" style="display: none;" name="url" id="url"
                            value="{{ url()->current() }}">
                        <div class="form-privacy">
                            <small>By submitting, you agree to our <a href="{{ url('privacy-policy') }}">Privacy
                                    Policy</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Best Places to Visit Page Styles */
    :root {
        --primary-color: #0099cc;
        /* Blue */
        --secondary-color: #ff6600;
        /* Orange */
        --primary-dark: #007aa3;
        --secondary-dark: #cc5200;
        --light-bg: #f8f9fa;
        --dark-text: #333333;
        --medium-text: #555555;
        --light-text: #ffffff;
        --border-color: #dee2e6;
        --card-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        --hover-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .andaman-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1586500036706-41963de24d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: var(--light-text);
        padding: 100px 0;
    }

    .andaman-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .andaman-hero .lead {
        font-size: 1.1rem;
        margin-bottom: 30px;
    }

    .hero-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .btn-primary {
        background-color: var(--secondary-color) !important;
        border-color: var(--secondary-color) !important;
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: var(--secondary-dark) !important;
        border-color: var(--secondary-dark) !important;
    }

    .btn-outline-light:hover {
        color: var(--primary-color) !important;
    }

    .intro-content h2 {
        font-size: 1.8rem;
        color: var(--dark-text);
        margin-bottom: 20px;
        font-weight: 600;
    }

    .intro-content p {
        font-size: 1rem;
        line-height: 1.6;
        color: var(--medium-text);
        margin-bottom: 20px;
    }

    .quick-facts {
        background-color: var(--light-bg);
        border-radius: 4px;
        padding: 20px;
        border-left: 4px solid var(--primary-color);
    }

    .quick-facts h3 {
        font-size: 1.2rem;
        margin-bottom: 15px;
        color: var(--dark-text);
        font-weight: 600;
    }

    .quick-facts ul {
        padding-left: 20px;
        margin-bottom: 0;
    }

    .quick-facts li {
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .content-table {
        background-color: var(--light-bg);
        border-radius: 4px;
        padding: 20px;
        border-left: 4px solid var(--secondary-color);
    }

    .content-table h3 {
        font-size: 1.2rem;
        margin-bottom: 15px;
        color: var(--dark-text);
        font-weight: 600;
    }

    .content-table ol {
        padding-left: 20px;
        margin-bottom: 0;
        counter-reset: item;
    }

    .content-table li {
        margin-bottom: 10px;
        font-size: 0.95rem;
        position: relative;
    }

    .content-table a {
        color: var(--primary-color);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .content-table a:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }

    .toc-sidebar {
        position: sticky;
        top: 20px;
    }

    .toc-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .toc-list li {
        margin-bottom: 10px;
    }

    .toc-list a {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.95rem;
        display: block;
        padding: 5px 0;
    }

    .toc-list a:hover {
        color: var(--primary-dark);
    }

    .card-header {
        background-color: var(--primary-color) !important;
        color: var(--light-text) !important;
    }

    .card-footer.bg-primary {
        background-color: var(--primary-color) !important;
    }

    .destination-section {
        padding-top: 30px;
        border-top: 1px solid var(--border-color);
    }

    .section-header h2 {
        font-size: 1.8rem;
        color: var(--dark-text);
        font-weight: 600;
    }

    .place-card {
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        box-shadow: var(--card-shadow);
    }

    .place-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }

    .place-number {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: var(--secondary-color);
        color: var(--light-text);
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.8rem;
        z-index: 1;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark-text);
    }

    .place-meta {
        display: flex;
        gap: 15px;
        font-size: 0.8rem;
        color: #6c757d;
    }

    .place-meta span {
        display: flex;
        align-items: center;
    }

    .place-meta i {
        margin-right: 5px;
        color: var(--primary-color);
    }

    .place-tags .badge {
        margin-right: 5px;
        font-weight: 500;
        background-color: #e9f5fb !important;
        color: var(--primary-color) !important;
    }

    .read-more {
        color: var(--secondary-color);
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
    }

    .read-more i {
        font-size: 0.7rem;
        margin-left: 3px;
        transition: transform 0.2s;
    }

    .read-more:hover i {
        transform: translateX(3px);
    }

    .cta-section {
        background-color: var(--light-bg);
    }

    .cta-content h2 {
        font-size: 1.8rem;
        color: var(--dark-text);
        margin-bottom: 15px;
        font-weight: 600;
    }

    .cta-content p {
        font-size: 1rem;
        color: var(--medium-text);
        margin-bottom: 20px;
    }

    .cta-features {
        list-style: none;
        padding: 0;
        margin-bottom: 25px;
    }

    .cta-features li {
        margin-bottom: 10px;
        font-size: 0.95rem;
        color: var(--medium-text);
        display: flex;
        align-items: center;
    }

    .cta-features li i {
        margin-right: 10px;
        color: var(--secondary-color);
    }

    .cta-buttons {
        display: flex;
        gap: 15px;
    }

    /* Quote Form Styles */
    /* Compact Quote Form Styles */
    .compact-quote-form {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        border: 1px solid #eee;
    }

    .compact-quote-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-color) 100%);
    }

    .compact-quote-form .quote-form-header {
        background-color: var(--primary-color);
        padding: 12px 15px;
        text-align: center;
        color: white;
    }

    .compact-quote-form .quote-form-header h3 {
        font-size: 1.2rem;
        margin-bottom: 0;
        font-weight: 600;
    }

    .compact-quote-form .quote-form-header h3 i {
        margin-right: 8px;
    }

    #lead-generation-form {
        padding: 15px;
    }

    .compact-quote-form .input-group-text {
        background-color: var(--primary-color);
        color: white;
        border: none;
    }

    .compact-quote-form .form-control,
    .compact-quote-form .form-select {
        border: 1px solid #e0e0e0;
        font-size: 0.9rem;
    }

    .compact-quote-form .form-control:focus,
    .compact-quote-form .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(0, 153, 204, 0.1);
    }

    .compact-quote-form textarea.form-control {
        min-height: 60px;
    }

    .compact-quote-form .quote-benefits {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
        font-size: 0.8rem;
        color: #555;
    }

    .compact-quote-form .quote-benefits span {
        display: flex;
        align-items: center;
    }

    .compact-quote-form .quote-benefits i {
        color: var(--secondary-color);
        margin-right: 4px;
        font-size: 0.9rem;
    }

    .compact-quote-form .btn-quote {
        background: linear-gradient(90deg, var(--secondary-color) 0%, #ff8533 100%);
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        margin: 10px 0;
    }

    .compact-quote-form .btn-quote span {
        position: relative;
        z-index: 2;
    }

    .compact-quote-form .btn-quote i {
        margin-left: 8px;
        position: relative;
        z-index: 2;
        transition: transform 0.3s ease;
    }

    .compact-quote-form .btn-quote:hover {
        background: linear-gradient(90deg, #ff8533 0%, var(--secondary-color) 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(255, 102, 0, 0.3);
    }

    .compact-quote-form .btn-quote:hover i {
        transform: translateX(5px);
    }

    .compact-quote-form .btn-quote::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
        transition: left 0.7s ease;
    }

    .compact-quote-form .btn-quote:hover::before {
        left: 100%;
    }

    .compact-quote-form .form-privacy {
        text-align: center;
        font-size: 0.75rem;
        color: #777;
        margin-top: 5px;
    }

    .compact-quote-form .form-privacy a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .compact-quote-form .form-privacy a:hover {
        text-decoration: underline;
    }

    /* Breadcrumb Styles */
    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 0;
        font-size: 0.9rem;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: var(--secondary-color);
        font-weight: 500;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: "›";
        color: #aaa;
    }

    @media (max-width: 992px) {
        .toc-sidebar {
            position: static;
            margin-top: 30px;
        }

        .breadcrumb {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 768px) {
        .andaman-hero {
            padding: 60px 0;
        }

        .andaman-hero h1 {
            font-size: 2rem;
        }

        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }

        .hero-buttons .btn {
            width: 100%;
        }

        .cta-buttons {
            flex-direction: column;
        }
    }

    /* FAQ Section Styles */
    .faq-section {
        background-color: #f8f9fa;
    }

    .faq-section h2 {
        color: var(--dark-text);
        font-weight: 600;
        margin-bottom: 30px;
    }

    .accordion-item {
        border-color: var(--border-color);
        margin-bottom: 10px;
    }

    .accordion-button {
        font-weight: 600;
        color: var(--dark-text);
        background-color: #fff;
        box-shadow: none;
        padding: 15px 20px;
    }

    .accordion-button:not(.collapsed) {
        color: var(--primary-color);
        background-color: #e9f5fb;
        box-shadow: none;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: var(--border-color);
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230099cc'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .accordion-body {
        padding: 15px 20px;
        color: var(--medium-text);
    }

    .accordion-body p {
        margin-bottom: 15px;
    }

    .accordion-body ul {
        padding-left: 20px;
    }

    .accordion-body li {
        margin-bottom: 8px;
    }

    /* Back to Top Button */
    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 40px;
        height: 40px;
        background-color: var(--secondary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background-color: var(--secondary-dark);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Table of contents search functionality
        const tocSearch = document.getElementById('toc-search');
        const tocItems = document.querySelectorAll('.toc-list li');

        if (tocSearch) {
            tocSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                tocItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // Highlight active section in table of contents when scrolling
        const sections = document.querySelectorAll(
            '[id^="port-blair"], [id^="havelock"], [id^="neil-island"], [id^="baratang"], [id^="north-middle"], [id^="little-andaman"], [id^="long-island"], [id^="other-islands"], [id^="faq"]'
        );
        const tocLinks = document.querySelectorAll('.toc-list a');

        function highlightTocItem() {
            const scrollPosition = window.scrollY;

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 200;
                const sectionBottom = sectionTop + section.offsetHeight;

                if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                    const id = section.getAttribute('id');

                    tocLinks.forEach(link => {
                        link.parentElement.classList.remove('active');
                        if (link.getAttribute('href') === '#' + id) {
                            link.parentElement.classList.add('active');
                        }
                    });
                }
            });
        }

        window.addEventListener('scroll', highlightTocItem);
    });
</script>

<style>
    /* Table of contents styles */
    .toc-sidebar {
        position: sticky;
        top: 100px;
    }

    .table-of-contents {
        max-height: 70vh;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .table-of-contents::-webkit-scrollbar {
        width: 6px;
    }

    .table-of-contents::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    .toc-list .active {
        background-color: rgba(13, 110, 253, 0.1);
        border-left: 3px solid #0d6efd;
    }

    .toc-list .list-group-item:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }

    /* Ensure responsive behavior */
    @media (max-width: 991.98px) {
        .toc-sidebar {
            position: static;
            margin-bottom: 2rem;
        }

        .table-of-contents {
            max-height: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scrolling for anchor links
        // document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        //     anchor.addEventListener('click', function(e) {
        //         e.preventDefault();

        //         const targetId = this.getAttribute('href');
        //         const targetElement = document.querySelector(targetId);

        //         if (targetElement) {
        //             const headerOffset = 80;
        //             const elementPosition = targetElement.getBoundingClientRect().top;
        //             const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        //             window.scrollTo({
        //                 top: offsetPosition,
        //                 behavior: 'smooth'
        //             });
        //         }
        //     });
        // });

        // Back to Top Button
        const backToTopButton = document.getElementById('back-to-top');

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });

        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
@endpush