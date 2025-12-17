@extends('layouts.app')
@section('title', 'Bike Rentals in Andaman – Two-Wheeler Hire | Andaman Bliss™')
@section('keywords', ' Andaman bike rental, bike hire Andaman, scooter rental Andaman, two-wheeler rental Andaman, rent a bike Port Blair, Havelock bike rental, Neil Island bike hire, affordable bike rental Andaman, Andaman motorcycle rental, island bike booking')
@section('description', ' Rent a bike in Andaman with Andaman Bliss™ for easy, affordable, and flexible island exploration. Choose from scooters and motorcycles in Port Blair, Havelock, and Neil Island. Book your two-wheeler today for a hassle-free adventure!')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    html {
        scroll-behavior: smooth;
    }

    /* Section wrapper */
    .bike-book {
        background: #b9ebeb;
        margin-top: 20px;
    }

    /* Left content */
    .bike-book h5 {
        font-size: 16px;
        font-weight: 600;
        color: #003b50;
    }

    .bike-book h2 {
        font-weight: 700;
        font-size: 34px;
        margin-bottom: 15px;
        color: #0d1b2a;
    }

    .bike-book p {
        color: #4a4a4a;
        margin-bottom: 25px;
    }

    /* Search container */
    .search-container {
        background: linear-gradient(2deg, #f2fcfc, #d2f7f5);
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.05);
        max-width: 700px;
    }

    .bike-main-search-conti {
        max-width: 500px;
    }

    .search-box {
        background: #fff;
        display: flex;
        gap: 6px;
        align-items: center;
        border-radius: 50px;
        padding: 0px 10px;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.05);
    }

    .search-item {
        display: flex;
        align-items: center;
        padding: 8px 15px;
        font-size: 15px;
        color: #555;
        border-right: 1px solid #e0e0e0;
    }

    .search-item:last-of-type {
        border-right: none;
    }

    .search-item i {
        margin-right: 8px;
        color: #555;
    }

    .search-btn {
        background: #f1f1f1;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 10px;
        cursor: pointer;
    }

    .search-btn i {
        color: #666;
        font-size: 16px;
    }

    /* Offer box */
    .offer-box {
        background: #e5f5ff;
        border-radius: 15px;
        padding: 1px;
        height: 100%;
    }

    .offer-box h3 {
        font-weight: 700;
        color: #005f7a;
        font-size: 28px;
        margin-bottom: 15px;
    }

    .offer-box p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .offer-box ul {
        padding-left: 18px;
        margin: 0 0 10px;
    }

    .offer-box ul li {
        margin-bottom: 6px;
    }

    .offer-box small {
        color: #555;
    }

    .search-item .form-control {
        border: none !important;
        padding: 2px !important;
    }

    .search-item .form-control:focus,
    .search-item .form-select:focus {
        box-shadow: none !important;
    }

    /* Responsive adjustments */
    @media(max-width: 768px) {
        .bike-book {
            margin-top: 70px;
        }

        .bike-book h2 {
            font-size: 26px;
        }

        .offer-section {
            display: none !important;
        }

        .offer-box {
            margin-top: 25px;
        }

        .search-container {
            padding: 7px;
        }

        .search-item {
            padding: 1px !important;
            font-size: 12px !important;
        }

    }

    .package-buttons {
        border-top: 1px solid #eee;
        margin-top: 5px;
    }

    .package-buttons h6 {
        font-size: 13px;
        font-weight: 600;
    }

    .package-buttons button {
        margin-top: 3px;
        padding: 5px;
        font-size: 11px;
    }

    .package-buttons button.active {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    .testimonials-section {
        padding: 35px 0;
        position: relative;
        background-color: white;
        overflow: hidden;
    }

    .testimonial-slider-container {
        position: relative;
        overflow: hidden;
        margin-bottom: 5px;
        z-index: 2;
        width: 100%;
    }

    .testimonial-slider {
        display: flex;
        transition: transform 0.5s ease;
        width: 100%;
    }

    .testimonial-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        height: 100%;
        flex: 0 0 calc(33.333% - 20px);
        margin: 0 10px;
        max-width: calc(33.333% - 20px);
    }

    .testimonial-card-inner {
        padding: 30px 25px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(17, 157, 213, 0.1);
    }

    .testimonial-card.active-card {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(17, 157, 213, 0.15);
        border-bottom: 3px solid #119dd5;
    }

    .testimonial-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .testimonial-quote {
        font-size: 36px;
        color: rgba(17, 157, 213, 0.2);
    }

    .testimonial-content {
        flex: 1;
        margin-bottom: 20px;
    }

    .testimonial-rating {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .testimonial-rating i {
        color: #FFD700;
        margin-right: 3px;
    }

    .testimonial-rating span {
        margin-left: 8px;
        font-weight: 600;
        color: var(--color-text-light);
    }

    .testimonial-text {
        font-size: 1.05rem;
        line-height: 1.7;
        color: var(--color-text);
        font-style: italic;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        margin-top: auto;
    }

    .author-image {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px;
        border: 3px solid rgba(17, 157, 213, 0.1);
    }

    .author-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 5px;
    }

    .author-trip {
        font-size: 0.9rem;
        color: var(--color-text-light);
        margin: 0;
    }

    .testimonial-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .control-prev,
    .control-next {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .control-prev:hover,
    .control-next:hover {
        background: var(--color-primary-gradient);
        transform: translateY(-3px);
    }

    .control-prev:hover i,
    .control-next:hover i {
        color: white;
    }

    .control-prev i,
    .control-next i {
        color: var(--color-primary);
        font-size: 14px;
    }

    .control-dots {
        display: flex;
        gap: 8px;
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dot.active {
        background: var(--color-primary);
        transform: scale(1.2);
    }

    .section-shape-3 {
        position: absolute;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.03);
        bottom: -150px;
        left: -150px;
        z-index: 1;
    }

    @media (max-width: 992px) {
        .testimonials-section {
            padding: 80px 0;
        }

        .testimonial-card {
            flex: 0 0 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }

    @media (max-width: 768px) {
        .testimonials-section {
            padding: 60px 0;
        }

        .testimonial-slider-container {
            padding: 0 15px;
        }

        .testimonial-card {
            flex: 0 0 calc(100% - 30px);
            max-width: calc(100% - 30px);
            margin: 0 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .testimonial-card-inner {
            padding: 25px 20px;
        }

        .testimonial-text {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .testimonial-quote {
            font-size: 30px;
            top: 15px;
            right: 15px;
        }

        .testimonial-rating {
            margin-bottom: 15px;
        }

        .author-image {
            width: 50px;
            height: 50px;
        }

        .author-name {
            font-size: 1rem;
        }

        .author-trip {
            font-size: 0.8rem;
        }

        .testimonial-controls {
            margin-top: 25px;
        }

        .control-prev,
        .control-next {
            width: 36px;
            height: 36px;
        }

        /* Special styling for active card on mobile */
        .testimonial-card.active-card {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(17, 157, 213, 0.2);
            border-bottom: 3px solid #119dd5;
        }

        .testimonial-card.active-card .testimonial-card-inner {
            background: linear-gradient(to bottom, white, rgba(17, 157, 213, 0.03));
        }

        /* Add pagination indicator for mobile */
        .testimonial-pagination-indicator {
            display: flex;
            justify-content: center;
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }
    }
</style>
@endpush

<section class="bike-banner position-relative">
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row">
            <div class="col-12 text-center mt-5 banner-centre-contain top-0">
                <h1 class="text-white fs-1 text-center">Safe, Affordable & Hassle-Free Bike Rentals for Your Island Adventure</h1>
            </div>
        </div>
    </div>
</section>
@include('common.search2')

@include('common.login-modal')

@if(isset($bikes) == null )
<section class=" overview-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="section-title mt-4">About Andaman Bliss™ <span class="text-gradient">Bike Rental</span></h2>
                <div class="read-more-container">
                    <div class="overview-description" style="text-align:justify">
                        <p class="pb-3">When it comes to <strong>bike booking in Andaman</strong>, <a
                                href="https://andamanbliss.com" target="_blank" rel="noopener noreferrer">Andaman Bliss™</a> is your best and most reliable option. Feel the freedom of the open road and
                            adventure when you get a <strong>bike rental in Andaman</strong>, and you will begin to
                            realize just what a paradise this is the beach, nature and outdoor skill will create
                            unforgettable adventures. With bike rental in Andaman, you can experience the beauty of the
                            island at your own leisure. The scenic islands with stunning beaches, lush green forests and
                            thousands of fish create a perfect backdrop for outdoor lovers and adventure seekers alike.
                            So, here is a complete guide on how to book the right <strong>bike rental in
                                Andaman</strong>. When booking your Andaman bike rental, this guide is perfect.</p>

                        <div class="more-text">
                            <p class="pb-3"><strong>Renting a bike</strong> of your own choice is very easy. It's merely
                                child's play to <strong>rent a bike</strong> in a place like the Andaman Islands.
                                <strong>Rent a bike in Andaman</strong> and experience the simplicity firsthand. We in
                                this feed will be discussing the details such as the documents needed and point by point
                                detailed procedure of renting a bike a very important point to be noted please do not
                                worry if you did not find a bike to rent don't be alarmed you may not find a bike then
                                HAHA, gotch you!!! Who Are We Kidding You will Always Find A Bike To Rent Up Until You
                                Are In Andaman Now Let's get into the topic, <strong>Andaman Bliss™ giving</strong> you a
                                detailed Procedure to follow about how to book a <strong>Bike Rental In
                                    Andaman</strong>.
                            </p>

                            <h2 class="fs-6 fw-bold">
                                Why To Get A Bike Rental In Andaman:
                            </h2>
                            <p class="pb-3"><strong>Bike Rental in Andaman</strong> certainly allows you to explore the
                                hidden gems and immerse yourself in local culture and bask in the beauty of the
                                landscapes. Choosing <strong>bike hire in Andaman</strong> enhances this experience
                                significantly. As you cherish this unforgettable journey, remember to ride responsibly,
                                respect the environment and create lasting memories in Andaman's captivating embrace by
                                <strong>Andaman bike rental service</strong>.
                            </p>

                            <h3 class="fs-6 fw-bold">Benefits Of Booking The Best Bike Rentals In Andaman:</h3>
                            <p class="pb-3">As a traveler, you may come across a few benefits if you visit the Islands
                                and rent a bike in Andaman from any of these desired destinations:</p>
                            <ul>
                                <li>Port Blair</li>
                                <li>Havelock Island</li>
                                <li>Neil Island</li>

                            </ul>

                            <p class="pb-3">WHEN IT COMES TO <strong>BIKE RENTAL IN ANDAMAN</strong> THE MAIN THING TO
                                NOTE IS ABOUT THE FUEL. You don't have to worry about that when you book the
                                <strong>best bike rentals in Andaman</strong>. With <strong>bike rental In
                                    Andaman</strong>, fuel concerns are minimal. No matter where you rent, may it be
                                renting from bike rental in <a href="https://andamanbliss.com/islands/port-blair"
                                    target="_blank" rel="noopener noreferrer">Port Blair</a> (Sri Vijaya Puram) or
                                renting from bike rental in Havelock (Swaraj Dweep) or maybe renting from bike rental in
                                Neil Islands (Shaheed Dweep) no matter the place because the price of petrol is
                                effectively less comparatively to other states.
                            </p>

                            <p>The second thing, if you book the best bike rental in Andaman, is that it's
                                cost-effective and you can save a lot. We are going to discuss this in detail in further
                                topics so do not forget to check that out too.</p>

                            <p class="pb-3">The third thing, if you book a <strong>bike rental in Andaman</strong>, is
                                that you can experience what the Andaman Island has to offer. Opting for <strong>Andaman
                                    bike rental service</strong> lets you dive deeper into the island’s wonders. If you
                                use another mode of transportation, there is a chance that you won't get where you're
                                going. For instance, if you decide to drive, a traffic bottleneck can halt you. Each
                                mode of transportation has its issue. As a result, picking these modes of transportation
                                will cause you to arrive somewhere so you do not influence them. You can simply cut
                                through traffic if you ride a bike. The benefit of <strong>Andaman Bike Booking</strong>
                                is exactly this. You may easily find a different route using Google. You won't be late
                                or miss any events like movies, parties or gatherings. All will be revealed to you. The
                                freedom of riding a bike is unparalleled. You are free to do whatever you want, whenever
                                you want. You are not dependent on anyone or anything.</p>

                            <p class="pb-3">You can take any route you want, stop wherever you want, stop to snap
                                photos, stop for refreshments, stop as frequently as you want, and pee whenever you
                                want. Once you get to your destination, you can easily check out and compare various
                                guesthouses before deciding on one. After checking in, you are free to explore the
                                location and its surroundings on your own.</p>

                            <p class="pb-3">The Andaman Islands have a lot of things to offer. The roads in the Andaman
                                Islands are excellent. Not only is there a highway but there are also rural areas. The
                                roads are fairly smooth and riding your bike will not bore you. Beautiful views may be
                                seen on all sides when biking. The views through the window of a bus or car simply does
                                not compare. And the issue is that if you are on a bus, the driver will not stop for
                                you. He will keep to the schedule and itinerary.</p>

                            <p class="pb-3">If you wish to stop and take in the scenery, please book bike rental in
                                Andaman. Many times, while traveling by bus or cab, you may miss out on a terrific
                                opportunity to click pictures of the stunning views.This happens when you rely on
                                others. If you ride a bike, you can easily stop and take as many pictures as you like by
                                using Andaman Bike Booking.</p>

                            <p class="pb-3">So why waste such a golden opportunity? You have come to have fun and learn.
                                Furthermore <strong>Rent A Bike In Andaman</strong> to ensure that you do not miss out
                                on any opportunities. <strong>Renting a bike in the Andaman and Nicobar Islands</strong>
                                enables you to discover locations that you might have normally missed. Tour buses
                                generally visit widely recognized sites of interest and stick to the main routes. With
                                <strong>bike rental in Andaman</strong>, you can go wherever you choose and explore
                                sites that no tour company will take you to.
                            </p>

                            <p class="pb-3">It's not only about the places, it's also about the people who live there.
                                You can interact with locals by riding a bike around. You can enquire about their
                                recommendations for the greatest restaurants, tourist attractions, and a variety of
                                other topics. People in the Andaman Islands are excellent and friendly and they are
                                aware of your motivation for visiting. They will give you accurate information.
                                Information that you won't ever be able to find online or through any other sources such
                                as your travel agent, your driver or anybody else who brought you here. Traveling will
                                teach you more about people and their cultures. You won't get search information if you
                                intend to tour the Andaman Islands by bus. We advise you to book <strong>bike rental in
                                    Andaman</strong> so you can get a perfect and planned tour of the Andaman Islands at
                                your own pace.</p>

                            <h3 class="fs-6 fw-bold">Experiencing The Night Life Of The Islands With Andaman Bike
                                Booking:</h3>
                            <p class="pb-3">The Andaman Island vibrant nightlife can be experienced by booking bike
                                rental in Andaman. The best bike rentals in Andaman make it even more enjoyable. Go
                                shopping, see a late night movie, discover some new sites and visit a night market. The
                                ideal location to spend the night is Calangute. You will pay more to do the same tasks
                                by using a different mode of transportation, such as a cab. And as you know, finding a
                                mode of transportation is never easy at night so renting a bike in Andaman is the best
                                way to go.</p>

                            <p class="pb-3">You can also bring your own bike to the Andaman Islands if you are able to
                                but there are lot of procedures to bring your bike to the Andaman island such as:</p>

                            <p class="pb-3">Transporting a motorcycle to Port Blair, Andaman using a ship route from the
                                mainland would involve a few different steps. The first step would be to find a shipping
                                company that specializes in motorcycle transport and has experience with shipping to
                                Port Blair. Once you have found a company that meets these criteria, you will need to
                                prepare your motorcycle for shipment. This will typically involve cleaning and servicing
                                the motorcycle and possibly disassembling it for transport. Once your motorcycle is
                                prepped and ready to go, you will need to arrange for it to be loaded onto the ship.
                                Typically, this entails making arrangements for the motorcycle to be picked up from your
                                location and delivered to the port of departure, where it will be placed on the ship.
                                You will have to plan ahead to pick up your motorcycle in Port Blair and move it to your
                                final destination after the ship departs. Also remember that you need to ask Indian
                                customs if there are any laws to abide by before shipping a motorcycle to Port Blair. To
                                prevent any delays or problems, it is always preferable to have all the necessary
                                paperwork and certificates on hand.</p>

                            <p class="pb-3">But you do not have to go through all this trouble of bringing your bike all
                                the way to the Andaman Islands from your hometown. All you can do is simply rent a bike
                                from Andaman Bliss™ and enjoy your stay here. With bike hire in Andaman, it is a hassle
                                free alternative.</p>

                            <h3 class="fs-6 fw-bold mt-3">Rental Shops For Bike Rental In Andaman:</h3>
                            <p class="pb-3">Tourists can easily find a numerous rental shops that offers a bike to hire
                                at key destinataion like <strong>Bike Rental In Port Blair</strong>, Bike Rental In <a
                                    href="https://andamanbliss.com/islands/havelock-swaraj-dweep" target="_blank"
                                    rel="noopener noreferrer">Havelock Island</a>, Bike Rental In <a
                                    href="https://andamanbliss.com/islands/neil-shaheed-dweep" target="_blank"
                                    rel="noopener noreferrer">Neil Island</a>. These rental shops are strategiacally
                                located near main markets, most popular beaches and major tourists attractions that can
                                be easily accessed and that is the only reason that you will aleays find bikes on rent,
                                lets just say that you are staying in a hotel and you couldn't get to the market place,
                                now you might be panicking about the situation that you are in. But you do not have to
                                worry about that you can just simply ask the front desk or the hotel manager to arrange
                                a bike rental in Andaman. The bike rental services in Andaman always ensures convenience
                                at each and every step.</p>

                            <h3 class="fs-6 fw-bold mt-3">Documents That Are Required For Bike Rental In Andaman:</h3>
                            <p class="pb-3">To book a bike rental in Andaman, the travelers typically need to provide
                                valid ID proof, such as a passport or driver's license. Foreign travelers might also
                                need an international driver's permit. Ensure you carry your documents while riding. Any
                                one of these documents may suffice for providing:</p>
                            <ul>
                                <li>License</li>
                                <li>PAN</li>
                                <li>Passport</li>
                                <li>Voter Id Card</li>
                            </ul>

                            <p class="pb-3">You have to submit your original Id Card. Please do not submit a Driving
                                License as you have to carry it while riding/driving a rented vehicle. Also, many
                                (Almost All) Renter only accept Original Documents, No Duplicate. It's completely safe
                                to give your Original Id Proof to them. Please do not forget to take it back when
                                returning your rented vehicle if you are an international traveler and we know that you
                                won't have the above-mentioned document except for the driving license and passport and
                                yes you can provide your Driving license or passport to rent a bike.</p>

                            <div class="schedule-note" style="margin-top: 1rem; font-style: italic; color: #f57c00;">
                                Please Note: Details are filled in-front of you. Please stand next to him/her and see
                                what he/she is writing in the registry book. Double check the amount entered in deposit
                                and advance payment.
                            </div>

                            <h3 class="fs-6 fw-bold pt-2">After filling all the details, you will be given a bike.
                                Enjoy.</h3>
                            <p class="pb-3">We in Andaman prioritize safety for travelers first. Almost all the rental
                                shops provide essential safety gear alongside the bike, including helmets. Wearing a
                                helmet not only complies with Indian law but also safeguards you on the winding roads
                                and uneven terrains of Andaman. Wearing a helmet provides you safety and also provides
                                safety for the local citizen so basically you are saving two lives by doing a single
                                good deed.</p>

                            <p class="pb-3">After securely renting a bike, you can embark on an independent journey
                                across the islands. Famous attractions such as the cellular jail and many beaches in
                                Port Blair are easily accessed by bike and you can also rent bikes in other places apart
                                from Port Blair such as Havelock and access places like <a
                                    href="https://andamanbliss.com/islands/havelock-swaraj-dweep/radhanagar-beach"
                                    target="_blank" rel="noopener noreferrer">Radhanagar Beach</a>, <a
                                    href="https://andamanbliss.com/islands/havelock-swaraj-dweep/kalapathar-beach"
                                    target="_blank" rel="noopener noreferrer">Kalapathar Beach</a> through bike.</p>

                            <h3 class="fs-6 fw-bold">Before getting a bike rental in Andaman keep these points in mind:
                            </h3>
                            <ul>
                                <li>Return the bike that you rented on time, or else there will be an extra charge.</li>
                                <li>If any kind of extension is needed, please call the dealer a day before or at least
                                    some hours before to inform him about the delay.</li>
                                <li>You must not give the bike to someone else without getting permission from the
                                    renter.</li>
                                <li>If any kind of damage is caused, you will be charged accordingly. Make sure to check
                                    for any kind of damages before renting.</li>
                                <li>If the rental bike breaks down, please inform the dealer immediately and they can
                                    take necessary action.</li>
                                <li>If you cancel, a part of the payment will be refunded. You must speak with the
                                    dealer for full details.</li>
                                <li>As a traveler, you must always carry your license.</li>
                                <li>You should always follow the traffic rules (as there is strict rule enforcement on
                                    this island).</li>
                                <li>Do not drink and drive ever.</li>
                                <li><strong>Road Etiquette to follow:</strong> Familiarize yourself with local traffic
                                    rules and regulations before hitting the road. While Andaman's traffic is relatively
                                    lighter than mainland cities, caution is crucial, especially on narrow roads and
                                    near tourist spots.</li>
                            </ul>

                            <h3 class="fs-6 fw-bold pt-3">Check All The Documents Before Renting:</h3>
                            <p class="pb-3">This is an important point to be made before making any kind of payment
                                please do check the vehicle documents and make sure to ask for the original document of
                                the vehicle and carry it with you but if the renter doesn't provide you with an original
                                document make sure to ask for a duplicate copy and carry with you because of the strict
                                rules that we follow in Andaman Islands. And make sure you do not get into any kind of
                                trouble. Here is a checklist to follow before renting a bike:</p>

                            <ul>
                                <li>Check all papers and validate.</li>
                                <li>Go through the RC Book. Check the owner's name and the registration date.</li>
                                <li>Check insurance papers and road tax.</li>
                                <li>Only make the payments when all documents are up-to-date.</li>
                            </ul>

                            <h3 class="fs-6 fw-bold pt-3">Procedure and Paper Work by Renter:</h3>
                            <p class="pb-3">After you select the bike and go through the documents. You just need to
                                make an entry on the book for a renter to maintain the records. Most of the renters here
                                keep their customer records for the safety of both the renter and the traveler.</p>

                            <h3 class="fs-6 fw-bold pt-2">These are the details you must enter on Record Book:</h3>
                            <ul>
                                <li>Your full name</li>
                                <li>Your home address</li>
                                <li>Alternate contact person details</li>
                                <li>Mobile number that you will be carrying on your entire trip</li>
                                <li>Also an alternate contact number</li>
                            </ul>

                            <h3 class="fs-6 fw-bold pt-3">Details that the dealer will enter into the record:</h3>
                            <ul>
                                <li>Bike No. (Dealer will enter details)</li>
                                <li>Submitted ID Proof (Dealer will enter details)</li>
                                <li>Date of hire and return (Dealer will enter details)</li>
                                <li>Deposit paid (Dealer will enter details)</li>
                                <li>Advance payment if done (Dealer will enter details)</li>
                                <li>Accessories carried, e.g., helmet (Dealer will enter details)</li>
                            </ul>
                            <p class="pb-3">These Details are filled in front of you. Please stand next to the renter
                                and see whether the details are entered correctly in the record book. Double check the
                                payment deposit and advance payment details and make sure to check the bike you rent for
                                scratch or any kind of damage, if you find any show it to the renter beforehand because
                                it may or may not come and bite you in the back.After filling in all these details, you
                                can enjoy riding the bike and continue your adventure and explore the beauty of the
                                Andaman Islands.</p>

                            <h3 class="fs-6 fw-bold pt-3">Affordable Bike Rental In Andaman:</h3>
                            <p class="pb-3">Exploring Andaman on a <strong>rented bike</strong> won't break the bank.
                                Rental charges are quite reasonable, varying based on bike type, rental duration and
                                shop location. Expect both hourly and daily rental rates, with attractive discounts for
                                extended rental periods. But before going into the details about the pricing we are
                                going to see the variety of bikes that Andaman rentals has to offer. The cost of
                                <strong>Bike Hire In Andaman</strong> is Very Cheaper compared to Cab, Hotel Shuttle, or
                                Rickshaw. Comparatively, Bikes cost you less than other vehicles, moreover they charge
                                trip basis so definitely it's going to cost you more. You will save lots of money if you
                                choose to explore the Andaman Islands by bike. The <strong>best bike rental in
                                    Andaman</strong> offers unbeatable value.
                            </p>
                            <p class="pb-3">The Rental shops in the Andaman Islands give you a diverse preferences and
                                requirements by offering a wide range of bikes. Choose from:
                            </p>
                            <ul>
                                <li>Scooters</li>
                                <li>Standard motorcycles</li>
                                <li>Premium models like the esteemed Royal Enfield</li>
                            </ul>
                            <p class="pb-3">The availability of specific models may vary depending on the rental shop.
                                We are going to divide the price range into Two types:</p>
                            <h3 class="fs-6 fw-bold pt-3">OFF Season Pricing:</h3>
                            <ul>
                                <li>Scooters like Activa may cost around ₹500 per day</li>
                                <li>Standard bikes like Bajaj Pulsar may cost around ₹600 per day</li>
                                <li>Premium bikes like Royal Enfield may cost around ₹800 per day</li>
                            </ul>

                            <h3 class="fs-6 fw-bold pt-3">Peak Season Pricing:</h3>
                            <ul>
                                <li>Scooters like Activa may cost around ₹600 per day</li>
                                <li>Standard bikes like Bajaj Pulsar may cost around ₹800 per day</li>
                                <li>Premium bikes like Royal Enfield may cost around ₹1200 per day</li>
                            </ul>

                            <h3 class="fs-6 fw-bold pt-3">Things to Remember:</h3>
                            <ul>
                                <li>Check the vehicle for any damage and scratches</li>
                                <li>Take photos of the bike from all sides (keep them as proof)</li>
                                <li>Always ask for a test ride so you know the condition of the bike</li>
                                <li>Check the brakes</li>
                                <li>Check the petrol level</li>
                                <li>You will be provided with a helmet; if not, ask for one</li>
                                <li>Save the contact details of the dealer in case you run into any trouble</li>
                                <li>Do not drink and drive</li>
                                <li>Wear a helmet and follow traffic rules (rules are very strict in the Andaman
                                    Islands)</li>
                                <li>Only 2 people per vehicle are allowed; more than 2 persons is not advisable</li>
                                <li>Ride slow and safe</li>
                            </ul>

                            <h3 class="fs-6 fw-bold pt-3">Here are a few suggestions that you would like to follow:</h3>
                            <ul>
                                <li>Enquire at many of the best bike rentals in Andaman before renting to get the best
                                    and most exciting deals.</li>
                                <li>Remember, everything is negotiable — so negotiate to get a good deal.</li>
                                <li>If you are traveling in a group and hire more than 2–3 bikes, you will likely get a
                                    better deal.</li>
                                <li>Discounted deals are mostly given for weekly and monthly rentals, but you can try
                                    negotiating for a single-day rental too.</li>
                                <li>Always go with a non-gear bike for short travel — it comes with a storage
                                    compartment for your stuff.</li>
                                <li>Choose a gear bike if you're planning long-distance travel — it's more comfortable
                                    and reduces body pain.</li>
                                <li>Do not carry big bags with you; always travel light and take only what's required
                                    for the trip.</li>
                                <li>Always keep a camera with you to capture the amazing views that the Andaman Islands
                                    offer.</li>
                                <li>Keep your fuel tank full to ensure uninterrupted exploration.</li>
                                <li>Wear sunglasses and carry sunscreen to beat the heat.</li>
                            </ul>

                            <h3 class="fs-6 fw-bold pt-3">Return Process:</h3>
                            <p class="pb-3">At the end of your rental period, return the bike to the same shop where you
                                hired it. The shop owner will conduct a thorough inspection for any damages, and upon
                                confirming everything is in order, your ID proof will be returned to you. But worst case
                                scenario if any hurdle comes, inform the dealer always. Return the Bike that you rented
                                on time or else there will be an extra charge If any kind of extension is needed, then
                                please call the dealer a day before or at least some hours before to inform him that
                                there will be a delay.</p>

                            <div class="schedule-note" style="margin-top: 1rem; font-style: italic; color: #f57c00;">
                                Disclaimer: Just do not forget to check weather conditions before setting off, as
                                unforeseen heavy rains or storms can impact travel plans.

                            </div>

                        </div>
                    </div>
                    <button id="toggleBtn" class="mt-2">Read more</button>
                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('site/img/cab/bike-bg.png') }}" alt="Andamanbliss Bike Rental"
                    class="img-fluid rounded sticky-top">
            </div>
        </div>
    </div>
</section>
@endif

@if(isset($bikes) != null && count($bikes) > 0)
<section>
    <div class="bik-container">
        <h2 class="bik-heading">Available Rides</h2>

        @foreach ($bikes as $bike)

        <!-- Bike Row -->
        <div class="bik-item d-flex align-items-center p-3">
            <div class="bik-image col-md-6 col-lg-2 me-3">
                <img src="{{ $bike['first_photo']}}" alt="Royal Enfield">
            </div>
            <div class="bik-details col-md-6 col-lg-6 flex-grow-1">
                <h5>{{$bike['name']}}</h5>
                <p>{{ $bike['description'] }}</p>
                <p>Location : {{$bike['address']}}</p>
            </div>

            <div class="d-flex flex-lg-column col-lg-4 px-1 align-items-center w-auto bik-mobile-full">
               
                <div class="bik-price mb-2 col">₹{{ number_format($bike['price'], 2) }} / day</div>
                @if(Auth::check()) 
                <form action="{{ route('bike.book.review') }}" class="col" method="post">
                    @csrf
                    @php
                    $params = [
                    'bikeId' => $bike['id'],
                    'location' => request()->query('location'),
                    'pickupdate' => request()->query('pickupdate'),
                    'dropoffdate' => request()->query('dropdate'),
                    ];
                    @endphp

                    <input type="hidden" name="params" value='@json($params)'>
                    <button type="submit" class="btn btn-primary">Book Now</button>
                </form>
                @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Book Now 
                </button>
                @endif
            </div>

        </div>
        @endforeach
    </div>
</section>
@endif
<section class="why-choose-section">
    <div class="container">
        <h2 class="section-title text-center">
            Why Choose Bike Rentals In Andaman <span class="text-gradient">From Andaman Bliss™:</span>
        </h2>
        <div class="row pt-3">
            <div class="col-md-4">
                <div class="choose-card">
                    <i class="fas fa-thumbs-up"></i>
                    <h3 class="fs-6 fw-bold">We Are Reliable</h3>
                    <p>We never run out of rental bikes. You won’t miss a thing on your trip — time is of the essence!
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="choose-card">
                    <i class="fas fa-rupee-sign"></i>
                    <h3 class="fs-6 fw-bold">Inexpensive</h3>
                    <p>Clear, transparent pricing with no hidden or extra charges.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="choose-card">
                    <i class="fas fa-smile-beam"></i>
                    <h3 class="fs-6 fw-bold">Experienced Comfort</h3>
                    <p>Explore the beauty of Andaman Islands at your own pace — relaxed and worry-free.</p>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="top-benefits-section">
    <div class="container">
        <h2 class="section-title text-center">Advantages of Booking <span class="text-gradient">Bike Rentals with
                Andaman Bliss™</span></h2>
        <div class="row pt-3">
            <div class="col-md-3">
                <div class="benefit-card">
                    <i class="fas fa-bicycle"></i>
                    <h3 class="fs-6 fw-bold">Convenience</h3>
                    <p>You can book a bike from anywhere in the Andaman Islands with the click of the enquiry button or
                        through our support team.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="benefit-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3 class="fs-6 fw-bold">Safety</h3>
                    <p>Helmet comes first, and we never put your safety and comfort at risk while you're riding with us!
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="benefit-card">
                    <i class="fas fa-random"></i>
                    <h3 class="fs-6 fw-bold">Flexibility</h3>
                    <p>Select from different vehicles and packages based on your needs to provide a unique experience.
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="benefit-card">
                    <i class="fas fa-dollar-sign"></i>
                    <h3 class="fs-6 fw-bold">Affordable</h3>
                    <p>We offer great value for money. Regardless of the vehicle you select, you will pay a competitive
                        rate for your bike rental.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="island-adventures bg-white pt-4 pb-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="section-title">Discover The<span class="text-gradient"> Hidden Treasures With Bike
                        Rentals</span></h2>
                <p style="text-align:justify">Choose Andaman Bliss™'s Bike Rentals Services and explore the beauty and
                    uniqueness of the Andaman Islands. Discover all the hidden spots, beautiful beaches and explore the
                    islands at your pace without depeniding on anyone.</p>
                <ul class="adventure-highlights">
                    <li>Ride to secluded beaches</li>
                    <li>Explore lush tropical forests</li>
                    <li>Experience local culture</li>
                    <li>Capture stunning sunset views</li>
                </ul>
                <a href="#" class="btn btn-primary mt-3">Plan Your Adventure</a>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('site/img/cab/bike_ride.png') }}" alt="Andaman Bike Adventures"
                    class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>


<section class="faq-partners-section bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="section-header mb-4">
                    <h2 class="section-title">Frequently Asked <span class="text-gradient">Questions</span></h2>
                    <p>Got questions? We've got answers. Find quick insights about our bike rental service.</p>
                </div>
                <div class="faq-accordion">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What types of bikes are available for rent in the Andaman Islands?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can typically rent a variety of bikes, including scooters, motorcycles. Popular
                                    models include Honda Activa, Royal Enfield, Bajaj Pulsar, and many more.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Where can I rent a bike in the Andaman Islands?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Bike rentals are available in major towns like Port Blair, Havelock Island (Swaraj
                                    Dweep), and Neil Island (Shaheed Dweep). You can find rental shops near ferry
                                    terminals, markets, and popular tourist spots.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How much does it cost to rent a bike in Andaman Islands?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The Bike Rental rates vary depending on the type of bike and the duration of the
                                    rental. On average, a scooters cost around INR 500 to 700 per day, while motorcycles
                                    might range from INR 700 to 1000 per day.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    What documents are required to rent a bike?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You will need to provide a valid driving license, an identity proof (such as an
                                    Aadhaar card or passport), and sometimes a security deposit.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Is it necessary to book a bike in advance?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    While it is not mandatory, booking in advance is recommended, especially during peak
                                    tourist seasons, to ensure availability and better rates.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Are helmets provided with the rental?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, the rental shops usually provide helmets with the bike. It's essential to wear
                                    a helmet for safety and to comply with local laws.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSix">
                                    Can we rent a bike in Andaman Islands?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, you can easily rent a bike in the Andaman Islands, you can do that easily by
                                    visiting our website or you can get rental options from the accommodation that you
                                    stay in.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 px-3 pt-1 pb-0 rounded-3 shadow bg-white flex-wrap">
                <div class="section-header text-center mb-4">
                    <h2 class="section-title mt-2">Get The <span class="text-gradient">Best Deals</span></h2>
                    <p class="bold">Collaborating with top-rated local and national brands to enhance your biking
                        experience.</p>
                </div>
                @include('common.bike-lead')

            </div>
        </div>
    </div>
</section>



<section class=" review-section mt-3 bg-white p-4 rounded">
    <div class="text-center">
        <h2 class="section-title">Real <span class="text-gradient">Experiences</span> from Real Travelers</h2>
        <p class="section-description">Discover why thousands of travelers choose our Andaman packages for their dream vacation</p>
    </div>
    <div class="container rev-container mt-3">
        <div class="rev-rating-box flex-wrap">
            <div class="col-lg-6 col-12">
                <div class="rev-stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h1 class="rev-rating-value">{{ number_format($rating['average_rating'],1) }}</h1>
                <p class="rev-rating-sub">From 70+ countries</p>
            </div>
            <div class="col-lg-6 col-12">
                <div class="rev-rating-row">
                    <span>5 ★</span>
                    <div class="rev-bar">
                        <div style="width:95%"></div>
                    </div>
                    <span>{{ $rating[5] }}</span>
                </div>

                <div class="rev-rating-row">
                    <span>4 ★</span>
                    <div class="rev-bar">
                        <div style="width:30%"></div>
                    </div>
                    <span>{{ $rating[4] }}</span>
                </div>

                <div class="rev-rating-row">
                    <span>3 ★</span>
                    <div class="rev-bar">
                        <div style="width:3%"></div>
                    </div>
                    <span>{{ $rating[3] }}</span>
                </div>

                <div class="rev-rating-row">
                    <span>2 ★</span>
                    <div class="rev-bar">
                        <div style="width:2%"></div>
                    </div>
                    <span>{{ $rating[2] }}</span>
                </div>

                <div class="rev-rating-row">
                    <span>1 ★</span>
                    <div class="rev-bar">
                        <div style="width:4%"></div>
                    </div>
                    <span>{{ $rating[1] }}</span>
                </div>


            </div>
        </div>

        <h3 class="rev-gallery-title fs-5">Traveller Image Gallery</h3>
        <div class="rev-gallery-grid">

            @php $first = $review_images->first(); @endphp

            @if($first)

            {{-- BIG IMAGE --}}
            <a href="{{ $first->image_url }}" data-lightbox="gallery" class="rev-big-wrap">
                <img src="{{ $first->image_url }}" class="rev-big-img">
                <span class="rev-view-all"><i class="fa fa-camera"></i> View All ({{ $review_images->count() }})</span>
            </a>

            @foreach($review_images->skip(1)->take(6) as $img)
            <a href="{{ $img->image_url }}" data-lightbox="gallery">
                <img src="{{ $img->image_url }}" class="rev-small-img">
            </a>
            @endforeach

            @endif

            {{-- HIDDEN: ALL IMAGES FOR LIGHTBOX --}}
            <div style="display:none;">
                @foreach($review_images as $img)
                <a href="{{ $img->image_url }}" data-lightbox="gallery"></a>
                @endforeach
            </div>

        </div>



        @foreach($reviews as $review)
        <div class="rev-review-card   mt-2 flex-wrap">
            <img src="{{ $review['reviewer_profile_photo_url'] }}" class="rev-avatar">

            <div class="rev-review-content col-10">
                <h4 class="rev-name">{{ $review['reviewer_name'] }}</h4>
                <p class="rev-date">Reviewed: {{ \Carbon\Carbon::parse($review['review_date'])->format('M Y') }}</p>
                <p class="mt-1" style="text-align: justify;">{{ $review['comment'] }}</p>
            </div>

            <div class="rev-rating-badge">
                ⭐ {{ number_format($review['rating'],1) }}
            </div>
        </div>

        @endforeach
    </div>

</section>

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
    $(document).ready(function() {
        // Infinite testimonial slider with 6 cards
        const slider = $('#testimonialSlider');
        const cards = slider.find('.testimonial-card');
        const dotsContainer = $('#testimonialDots');
        const prevBtn = $('#testimonialPrev');
        const nextBtn = $('#testimonialNext');

        // Clone cards for infinite scrolling
        cards.each(function() {
            $(this).clone().appendTo(slider);
        });

        // Get updated cards after cloning
        const allCards = slider.find('.testimonial-card');

        // Variables
        let currentIndex = 0;
        const originalCardsCount = cards.length;
        let cardWidth, containerWidth, visibleCards, maxIndex;
        let isAnimating = false;

        // Calculate dimensions and limits
        function calculateDimensions() {
            // Reset any inline styles first
            slider.find('.testimonial-card').removeAttr('style');
            slider.find('.testimonial-card').css('display', 'flex');

            // Get container width first
            containerWidth = slider.parent().width();

            // Determine how many cards are visible based on screen size
            if (window.innerWidth <= 768) {
                visibleCards = 1;
                // Mobile view - single card with proper spacing
                slider.find('.testimonial-card').css({
                    'flex': '0 0 calc(100% - 30px)',
                    'max-width': 'calc(100% - 30px)',
                    'margin': '0 15px'
                });
            } else if (window.innerWidth <= 992) {
                visibleCards = 2;
                // Tablet view - two cards
                slider.find('.testimonial-card').css({
                    'flex': '0 0 calc(50% - 20px)',
                    'max-width': 'calc(50% - 20px)',
                    'margin': '0 10px'
                });
            } else {
                visibleCards = 3;
                // Desktop view - three cards
                slider.find('.testimonial-card').css({
                    'flex': '0 0 calc(33.333% - 20px)',
                    'max-width': 'calc(33.333% - 20px)',
                    'margin': '0 10px'
                });
            }

            // Now get the actual card width after CSS adjustments
            cardWidth = allCards.first().outerWidth(true);

            // Calculate maximum index (original cards count)
            maxIndex = originalCardsCount;

            console.log('Screen width:', window.innerWidth);
            console.log('Container width:', containerWidth);
            console.log('Card width:', cardWidth);
            console.log('Visible cards:', visibleCards);
        }

        // Create dots based on original cards count
        function createDots() {
            dotsContainer.empty();

            for (let i = 0; i < originalCardsCount; i++) {
                dotsContainer.append(
                    `<div class="dot ${i === currentIndex % originalCardsCount ? 'active' : ''}" data-index="${i}"></div>`
                );
            }
        }

        // Update slider position with smooth transition
        function updateSlider(withAnimation = true) {
            if (isAnimating) return;

            // Recalculate dimensions to ensure proper sizing
            if (!withAnimation) {
                calculateDimensions();
            }

            // Update active dot
            dotsContainer.find('.dot').removeClass('active');
            dotsContainer.find(`.dot[data-index="${currentIndex % originalCardsCount}"]`).addClass('active');

            // Calculate the translation value based on current card width
            const translateValue = -currentIndex * cardWidth;

            // Add a class to the current active card for mobile styling
            slider.find('.testimonial-card').removeClass('active-card');
            slider.find('.testimonial-card').eq(currentIndex).addClass('active-card');

            // Update pagination indicator for mobile
            $('#currentSlideIndicator').text((currentIndex % originalCardsCount) + 1);
            $('#totalSlidesIndicator').text(originalCardsCount);

            if (withAnimation) {
                isAnimating = true;
                slider.css('transition', 'transform 0.5s ease-out');
                slider.css('transform', `translateX(${translateValue}px)`);

                // After animation completes
                setTimeout(function() {
                    isAnimating = false;

                    // If we've scrolled past the original set, reset to the clone
                    if (currentIndex >= originalCardsCount) {
                        slider.css('transition', 'none');
                        currentIndex = currentIndex % originalCardsCount;
                        slider.css('transform', `translateX(${-currentIndex * cardWidth}px)`);

                        // Update active card after reset
                        slider.find('.testimonial-card').removeClass('active-card');
                        slider.find('.testimonial-card').eq(currentIndex).addClass('active-card');

                        // Update pagination indicator after reset
                        $('#currentSlideIndicator').text(currentIndex + 1);
                    }

                    // If we've scrolled to the beginning of the clone set, reset to the original
                    if (currentIndex < 0) {
                        slider.css('transition', 'none');
                        currentIndex = originalCardsCount - Math.abs(currentIndex % originalCardsCount);
                        slider.css('transform', `translateX(${-currentIndex * cardWidth}px)`);

                        // Update active card after reset
                        slider.find('.testimonial-card').removeClass('active-card');
                        slider.find('.testimonial-card').eq(currentIndex).addClass('active-card');

                        // Update pagination indicator after reset
                        $('#currentSlideIndicator').text(currentIndex + 1);
                    }
                }, 500);
            } else {
                slider.css('transition', 'none');
                slider.css('transform', `translateX(${translateValue}px)`);
            }
        }

        // Next slide with infinite scrolling
        function nextSlide() {
            if (isAnimating) return;
            currentIndex++;
            updateSlider();
        }

        // Previous slide with infinite scrolling
        function prevSlide() {
            if (isAnimating) return;
            currentIndex--;
            updateSlider();
        }

        // Initialize slider
        calculateDimensions();
        createDots();
        updateSlider(false);

        // Event listeners
        nextBtn.on('click', function() {
            clearInterval(autoSlideInterval);
            nextSlide();
            startAutoSlide();
        });

        prevBtn.on('click', function() {
            clearInterval(autoSlideInterval);
            prevSlide();
            startAutoSlide();
        });

        dotsContainer.on('click', '.dot', function() {
            if (isAnimating) return;
            clearInterval(autoSlideInterval);

            const dotIndex = parseInt($(this).data('index'));
            currentIndex = dotIndex;
            updateSlider();
            startAutoSlide();
        });

        // Handle window resize with debounce for better performance
        let resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Store current index before recalculating
                const currentActiveIndex = currentIndex % originalCardsCount;

                // Reset to the active slide's position
                currentIndex = currentActiveIndex;

                // Recalculate everything
                calculateDimensions();
                createDots();
                updateSlider(false);
            }, 250);
        });

        // Auto-slide functionality
        let autoSlideInterval;

        function startAutoSlide() {
            autoSlideInterval = setInterval(function() {
                nextSlide();
            }, 5000);
        }

        // Start auto-sliding
        startAutoSlide();

        // Pause auto-sliding when user interacts
        $('.testimonial-slider-container').on('mouseenter', function() {
            clearInterval(autoSlideInterval);
        }).on('mouseleave', function() {
            startAutoSlide();
        });

        // Touch swipe functionality
        let touchStartX = 0;
        let touchEndX = 0;

        slider.on('touchstart', function(e) {
            touchStartX = e.originalEvent.touches[0].clientX;
            clearInterval(autoSlideInterval);
        });

        slider.on('touchend', function(e) {
            touchEndX = e.originalEvent.changedTouches[0].clientX;

            // Determine swipe direction
            if (touchStartX - touchEndX > 50) { // Swipe left
                nextSlide();
            } else if (touchEndX - touchStartX > 50) { // Swipe right
                prevSlide();
            }

            // Restart auto-slide
            startAutoSlide();
        });

        // Initialize AOS animation library
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>

@endpush

@endsection