@extends('layouts.app')
@section('title', 'Weather in Andaman Islands | Climate Guide')
@section('keywords', 'andaman weather, andaman climate, best time to visit andaman, andaman monsoon, andaman islands temperature, port blair weather')
@section('description', 'Learn about Andaman Islands weather patterns, seasonal climate variations, and the best time to visit. Find detailed information about rainfall, temperature, and monsoon seasons.')

@push('styles')
<style>
/* Modern Hero Section Styles */
.hero-section {
    min-height: 50vh;
    background: radial-gradient(circle at center, rgb(255 255 255 / 30%) 0%, rgb(17 157 213) 100%);
    position: relative;
    overflow: hidden;
    padding: 80px 0 60px;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, rgb(255 255 255 / 30%) 0%, rgb(17 157 213) 100%);
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+PHJlY3QgaWQ9InBhdHRlcm4tYmciIHdpZHRoPSI0MDAiIGhlaWdodD0iNDAwIiBmaWxsPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMDMpIj48L3JlY3Q+PHBhdGggZmlsbD0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjA1KSIgZD0iTTAgMGg0MHY0MEgweiI+PC9wYXRoPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgaGVpZ2h0PSIxMDAlIiB3aWR0aD0iMTAwJSI+PC9yZWN0Pjwvc3ZnPg==');
    opacity: 0.4;
    z-index: 1;
}

.z-2 {
    position: relative;
    z-index: 2;
}

.hero-content {
    position: relative;
    z-index: 2;
    color: white;
}

.animate-fade-in {
    animation: fadeIn 1s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.badge-wrapper {
    margin-bottom: 20px;
}

.hero-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 10px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    border-left: 3px solid #f9680f;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 25px;
    letter-spacing: -0.5px;
}

.text-gradient {
    background: linear-gradient(to right, #FF9800, #FF5722);
    -webkit-background-clip: text;
    -webkit-text-fill-color: #f3a20e8c;
    font-weight: 800;
    display: inline-block;
}

.hero-description {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 35px;
    opacity: 0.9;
    max-width: 90%;
}

.hero-image-wrapper {
    position: relative;
    z-index: 2;
    padding: 10px;
    transition: all 0.3s ease;
}

.hero-image-wrapper:hover {
    transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
}

.rounded-4 {
    border-radius: 1rem;
}

.min-vh-50 {
    min-height: 50vh;
}

.shadow-lg {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2) !important;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    color: var(--color-heading);
    position: relative;
    display: block;
}

.section-divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(to right, rgb(17, 157, 213), #0078d4);
    margin: 0 auto 2rem;
    border-radius: 2px;
}
.summer-hdr{
 background-color: #FF5722 !important;
}
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden">
    <div class="hero-background"></div>
    <div class="hero-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row min-vh-50 align-items-center py-2">
            <div class="col-lg-6 hero-content">
                <div class="animate-fade-in">
                    <div class="badge-wrapper">
                        <span class="hero-badge">Climate Guide</span>
                    </div>
                    <h1 class="hero-title text-white">Weather in <span class="text-gradient">Andaman</span> Islands</h1>
                    <p class="hero-description">Discover the perfect time to visit the Andaman Islands based on season and weather condition, plan your ideal and personalized trip to the islands by following this weather guide.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1505533542167-8c89838bb19e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Andaman Islands Weather" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
        </div>
    </section>



<!-- Climate Overview Section -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Discover Tropical Weather<span class="text-gradient"> & Climate</span></h2>
                <div class="section-divider"></div>
                <p class="lead">The Andaman and Nicobar Islands have a tropical climate with a warm temperature all round the year, which is influenced by wind and a seasonal monsoon patterns.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 rounded-circle text-white me-3" style="background-color: rgb(17, 157, 213);">
                                <i class="fas fa-thermometer-half"></i>
                            </div>
                            <h4 class="card-title mb-0">Temperature Range</h4>
                        </div>
                        <p class="card-text">The Andaman Islands all year round have a constant warm temperature ranging from 23 to 31 degree celcius (73 F – 88 F). Due to the island's tropical climate, there is minimal deviation in temperature seasons giving you the chance to participate in beach activities, or water-based sports all year long.</p>
                    </div>
                </div>
                                </div>
            
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 rounded-circle text-white me-3" style="background-color: rgb(17, 157, 213);">
                                <i class="fas fa-cloud-rain"></i>
                            </div>
                            <h4 class="card-title mb-0">Rainfall Patterns</h4>
                        </div>
                        <p class="card-text">The islands go through a southwest monsoon ( May to September) and then a northeast monsoon (October to December). The islands average around 3000mm of rain annually with the southwest monsoon typically holding the highest rainfall rate. During the dry months there will be short tropical showers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seasonal Guide Section -->
<section class="py-5" style="background-color: #f8fbff;">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Guide to Know About The <span class="text-gradient">Season In Andaman</span></h2>
                <div class="section-divider"></div>
                <p class="lead">Please check the climate and weather condition before you plan your visit to the Andaman Islands, so that you can fully take in what the island has to offer.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header text-white" style="background-color: rgb(17, 157, 213);">
                        <h4 class="mb-0"><i class="fas fa-sun me-2"></i> Winter Season</h4>
                        <p class="mb-0 small">Lasts From October to February</p>
                    </div>
                    <div class="card-body">
                        <p>The winter season of the Islands is considered to be the <strong>best time to visit</strong> the Andaman Islands. This certain period offers:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i> A Pleasant temperatures ranging from (24°C to 30°C)</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i> Less possibility of rain & Clear skies</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i> Ideal for water activities and beach exploration</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i> High and clear visibility for Underwater Activities</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i> A peak tourist season with full on operational services</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header summer-hdr text-dark">
                        <h4 class="mb-0"><i class="fas fa-cloud-sun me-2"></i> Summer Season</h4>
                        <p class="mb-0 small">Lasts from March to May</p>
                            </div>
                            <div class="card-body">
                        <p>The summer season brings warmer temperatures and it is hotter from the months for oct, but still offers a proper way for travelers to explore the islands:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-info-circle text-warning me-2"></i> Temp is generally higher ranging from (27°C to 33°C)</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-info-circle text-warning me-2"></i> Provide a moderate humid climate at the islands</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-info-circle text-warning me-2"></i> Occassional rain showers, but not huge</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-info-circle text-warning me-2"></i> Perfect for people who wishes to travel on a budget (Prices are lower than usual)</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-info-circle text-warning me-2"></i> The Islands are not that crowded so that you can explore freely.</li>
                                </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header text-white" style="background-color: rgb(17, 157, 213);">
                        <h4 class="mb-0"><i class="fas fa-cloud-showers-heavy me-2"></i> Monsoon Season</h4>
                        <p class="mb-0 small">Lasts from June to September</p>
                    </div>
                    <div class="card-body">
                        <p>The monsoon season brings heavy rainfall to the Andaman Islands, This usually lasts from June to September, with some considerations:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-exclamation-circle text-info me-2"></i>Brings in heavy rainfall and occassional stroms sometimes</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-exclamation-circle text-info me-2"></i> High humid levels at this period</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-exclamation-circle text-info me-2"></i> Limited water based activities and ferry transportation services</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-exclamation-circle text-info me-2"></i> Some tourist attraction might be closed due to heavy rainfall</li>
                            <li class="list-group-item border-0 ps-0"><i class="fas fa-exclamation-circle text-info me-2"></i> Less Tourists, lowest hotel fares.</li>
                                </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Best Time to Visit Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Best Time to Visit Andaman" class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover; width: 100%;">
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Best Time To Visit The <span class="text-gradient">Andaman Islands</span></h2>
                <p class="mb-4">The <strong>best time to visit Andaman Islands</strong> is between October and May, where October to February is the most comfortable and best period to visit. During this time, you will encounter:</p>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="p-2 rounded-circle text-white me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background-color: rgb(17, 157, 213);">
                        <i class="fas fa-water"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Excellent Beach Weather:</h5>
                        <p class="mb-0">Allow really great opportunities to experience clear water, sunny days and comfortable weather for swimming or just relaxing in the sun.</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="p-2 rounded-circle text-white me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background-color: rgb(17, 157, 213);">
                        <i class="fas fa-ship"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Reliable Ferry Services</h5>
                        <p class="mb-0">All inter-island ferry services will be running regularly, allowing you to hop around the islands with reliable ferry services. </p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start">
                    <div class="p-2 rounded-circle text-white me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background-color: rgb(17, 157, 213);">
                        <i class="fas fa-fish"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Best Underwater Visibility</h5>
                        <p class="mb-0">Great underwater visibility for scuba diving, snorkeling and sea walking opportunities.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Weather FAQ Section -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Common <span class="text-gradient">Weather FAQs</span></h2>
                <div class="section-divider"></div>
                <p class="lead">Get answers to common questions about Andaman's weather and travel conditions.</p>
            </div>
                                </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="weatherFAQ">
                    <div class="accordion-item border mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                When is the rainiest month in Andaman?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#weatherFAQ">
                            <div class="accordion-body">
                                <p>July and August typically receive the highest rainfall in Andaman, with average precipitation exceeding 500mm per month. During these months, heavy downpours can last for several hours, and outdoor activities might be limited.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Is it worth visiting Andaman during the monsoon season?
                            </button>
                                </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#weatherFAQ">
                            <div class="accordion-body">
                                <p>Visiting Andaman during the monsoon (June-September) has both advantages and disadvantages:</p>
                                <ul>
                                    <li><strong>Pros:</strong> Significantly lower prices, fewer tourists, lush green landscapes, and occasional clear weather windows.</li>
                                    <li><strong>Cons:</strong> Limited water activities, restricted ferry operations, potential for flight delays, and some attractions may be closed.</li>
                                </ul>
                                <p>If you're on a tight budget and don't mind occasional rain interruptions, you can still enjoy indoor activities and the islands' natural beauty during brief clear spells.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                What should I pack for different seasons in Andaman?
                            </button>
                                </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#weatherFAQ">
                            <div class="accordion-body">
                                <p><strong>For Winter Season (Oct-Feb):</strong></p>
                                <ul>
                                    <li>Light cotton clothing</li>
                                    <li>Swimwear</li>
                                    <li>Sunscreen (SPF 50+)</li>
                                    <li>Sunglasses and hat</li>
                                    <li>Light jacket for evenings</li>
                                </ul>
                                
                                <p><strong>For Summer Season (Mar-May):</strong></p>
                                <ul>
                                    <li>Light, breathable clothing</li>
                                    <li>Extra sunscreen</li>
                                    <li>Reusable water bottle</li>
                                    <li>Electrolyte packets</li>
                                    <li>Wide-brimmed hat</li>
                                </ul>
                                
                                <p><strong>For Monsoon Season (Jun-Sep):</strong></p>
                                <ul>
                                    <li>Quick-dry clothing</li>
                                    <li>Rain jacket or poncho</li>
                                    <li>Waterproof phone case</li>
                                    <li>Waterproof footwear</li>
                                    <li>Umbrella</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border shadow-sm">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Does Andaman experience cyclones or hurricanes?
                            </button>
                                </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#weatherFAQ">
                            <div class="accordion-body">
                                <p>Yes, the Andaman and Nicobar Islands are occasionally affected by cyclones, primarily during two periods:</p>
                                <ul>
                                    <li><strong>Pre-monsoon period (April-May)</strong></li>
                                    <li><strong>Post-monsoon period (October-November)</strong></li>
                                </ul>
                                <p>While severe cyclones are relatively rare, the local administration is well-equipped with early warning systems and evacuation procedures. Travelers should monitor weather forecasts during these seasons and follow any advisories issued by local authorities.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 text-white" style="background-color: rgb(17, 157, 213);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-3 text-white">Ready to Experience Andaman's Perfect Weather?</h2>
                <p class="lead mb-0 text-dark">Book your tropical getaway now and enjoy the best of Andaman's climate and natural beauty.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/contact" class="btn btn-light btn-lg px-4 py-2 fw-bold">Contact Us</a>
                <a href="/hotels" class="btn btn-outline-light btn-lg ms-2 px-4 py-2 fw-bold">Explore Hotels</a>
            </div>
        </div>
    </div>
</section>
@endsection