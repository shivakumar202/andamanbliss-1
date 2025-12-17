{{-- 
<section class="tour-assistance">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-7">
                <h2 class="tour-assistance-title">Plan your holidays with our assistance</h2>
                <p class="tour-support-text">Let our travel experts help you create the perfect Andaman experience. Fill
                    in your details and we'll get back to you with personalized recommendations.</p>
                <div class="d-none d-md-flex align-items-center mt-4">
                    <div class="me-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle me-2" style="color: rgb(17, 157, 213);"></i>
                            <span>Personalized itineraries</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2" style="color: rgb(17, 157, 213);"></i>
                            <span>Best price guarantee</span>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle me-2" style="color: rgb(17, 157, 213);"></i>
                            <span>24/7 customer support</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2" style="color: rgb(17, 157, 213);"></i>
                            <span>Flexible booking options</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <form class="tour-assistance-form" action="{{url('contact')}}" id="assistanceforms" method="POST">
@csrf
<div class="form-group mb-3">
    <input type="text" name="name" class="form-control" placeholder="Full Name" maxlength="100" required="">
    <span class="assistanceNameError error text-danger"></span>
</div>
<input type="text" name="website" id="website" style="display:none;" tabindex="-1" autocomplete="off">
<div class="form-group mb-3">
    <input type="text" name="mobile" class="form-control" placeholder="Mobile" maxlength="10" required=""
        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
    <span class="assistanceMobileError error text-danger"></span>
</div>
<div class="form-group mb-3">
    <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required="">
    <input type="hidden" name="url" value="{{ url()->current() }}" required>
    <span class="assistanceEmailError error text-danger"></span>
</div>
<button type="submit" class="tour-assistance-btn" id="send">
    <i class="fas fa-paper-plane me-2"></i> Get Assistance
</button>
</form>
</div>
</div>
</div>
</section> --}}
<div class="section-block bg-white">
    <div class="container mt-3 pt-2">
        <div class="plan-holidays">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <div class="section-heading">
                        <h2>Plan your holidays with our assistance,<br> Just fill in your details.</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pt-4 pt-lg-0">
                    <form class="form" action="{{url('contact')}}" id="assistanceforms" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Full Name"
                                        maxlength="100" required="">
                                    <span class="assistanceNameError error text-danger"></span>
                                </div>
                            </div>
                            <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                                autocomplete="off">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="mobile" class="form-control" placeholder="Mobile"
                                        maxlength="10" required=""
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    <span class="assistanceMobileError error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        autocomplete="off" required="">
                                    <input type="hidden" name="form_type" value="Newsletter Form Type">
                                    <span class="assistanceEmailError error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit"
                                    class="primary-button button-sm mt-15-xs ferry-inquiry-btn assistance" id="send">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="tour-support">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6">
                <h2 class="tour-support-title">24/7 Customer Support</h2>
                <p class="tour-support-text">Our team of experienced tour specialists have travelled to hundreds of
                    countries around the globe and have decades of first-hand travel experience to share. Contact us now
                    to have all of your tour-related questions answered!</p>
                <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                    class="tour-support-btn">
                    <i class="fas fa-headset me-2"></i> Contact Us
                </a>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="tour-support-images">
                    @php
                    $supports = \App\Models\Team::where('isSupport', 1)->orderBy('id','ASC')->with('photo')->get();
                    @endphp
                    @foreach ($supports as $support)
                    <img src="{{ @$support->photo->file }}" alt="{{ $support->name }}" loading="lazy">
                    @endforeach
                    <a href="{{ route('about')}}" target="_blank"
                        class="d-flex align-items-center justify-content-center rounded-circle"
                        style="width: 60px; height: 60px; background-color: rgb(17, 157, 213); color: white; font-weight: 600; border: 3px solid white; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);">
                        +35
                    </a>
                </div>
                <div class="mt-3 text-center text-md-start d-flex align-items-center justify-content-end gap-3">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <div class="me-2">
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                        </div>
                        <span style="font-weight: 600;">4.9/5</span>
                    </div>
                    <p class="small text-muted mb-0">Based on 3,100+ reviews</p>
                </div>
            </div>
        </div>
    </div>
</section>
@php
$currentUrl = rtrim(request()->url(), '/');

$page = App\Models\TagPages::get()->first(function($p) use ($currentUrl) {
    return rtrim($p->page_url, '/') === $currentUrl;
});

if ($page) {
    $tags = $page->tags()->get();
} else {
    $tags = App\Models\Tags::inRandomOrder()->take(20)->get();
}
@endphp

<div class="section-block-grey mb-0">
    <div class="container">
        <h2 class="tour-popular-title">Popular on Andaman Bliss™</h2>
        <div class="popular-place">
           
            <ul>
                @foreach($tags as $tag)
                <li><a href="{{ $tag->link ?? '#' }}">{{ $tag->tag }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


<footer id="footer"
    style="background-color: #001e3c; color: #ffffff; position: relative; margin-top: 2px; overflow: hidden;">
    <!-- Wave Separator at Top -->
    <div
        style="position: absolute; top: 0; left: 0; width: 100%; height: 70px; overflow: hidden; line-height: 0; transform: translateY(-99%);">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
            </path>
        </svg>
    </div>

    <!-- Newsletter Section -->
    {{-- <div
        style="background: linear-gradient(135deg, rgb(17, 157, 213) 0%, rgb(0, 115, 170) 100%); padding: 40px 0; position: relative;">
        <div class="container">
            <div
                style="background-color: rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 30px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); border: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div>
                            <h3 style="color: #fff; font-size: 24px; font-weight: 700; margin-bottom: 10px;">Subscribe
                                to Our Newsletter</h3>
                            <p style="color: #fff; font-size: 16px; margin-bottom: 0;">Get exclusive offers, travel tips
                                and updates delivered to your inbox</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form id="callnowEmailForm" method="POST">
                            <div class="input-group"
                                style="box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); border-radius: 50px; overflow: hidden;">
                                <input type="email" class="form-control" name="emails" placeholder="Your Email Address"
                                    required="" autocomplete="off"
                                    style="height: 54px; border: none; padding: 0 25px; font-size: 15px;">
                                <input name="form_type" type="hidden" value="Email Form Type">
                                <button type="submit" class="btn"
                                    style="background-color: #fd6e0f; color: #fff; border: none; font-weight: 600; padding: 0 30px; border-radius: 0 50px 50px 0; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease;">Subscribe</button>
                            </div>
                            <span class="callNowEmailError error text-danger"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Main Footer Content -->
    <div style="background-color: #001e3c; padding: 20px 0 40px; position: relative;">
        <div class="container">
            <div class="row">
                <!-- About Widget -->
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                    <div style="margin-bottom: 30px;">
                        <div style="margin-bottom: 25px; padding: 15px; border-radius: 10px;">
                            <img src="{{ asset('site/img/logo.png') }}" alt="Andaman Bliss™" class="img-fluid">
                        </div>
                        <div>
                            <p style="color: #fff; line-height: 1.7; margin-bottom: 25px; font-size: 15px;">We are
                                Andaman Bliss™ - The islands' best travel agency, a way of life. We take you beyond the
                                resort and into the heart of the islands where setting sail, exploring lush peaks and
                                tasting rich flavors become lasting memories.</p>
                        </div>
                        <div style="margin-bottom: 25px;">
                            <div style="display: flex; margin-bottom: 15px; align-items: flex-start;">
                                <i class="fas fa-map-marker-alt"
                                    style="color: rgb(17, 157, 213); font-size: 18px; margin-right: 15px; margin-top: 3px; width: 20px; text-align: center;"></i>
                                <p style="color: #fff; margin: 0; font-size: 15px; line-height: 1.6;">2nd Floor,
                                    Foreshore Road, Phoenix Bay,
                                    Sri Vijayapuram, A & N Islands 744102</p>
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items: flex-start;">
                                <i class="fas fa-phone-alt"
                                    style="color: rgb(17, 157, 213); font-size: 18px; margin-right: 15px; margin-top: 3px; width: 20px; text-align: center;"></i>
                                <p style="color: #fff; margin: 0; font-size: 15px; line-height: 1.6;">
                                    <a href="tel:+918900909900"
                                        style="color: #fff; text-decoration: none; transition: all 0.3s ease;">+91
                                        8900909900</a> /
                                    <a href="tel:+919933202248"
                                        style="color: #fff; text-decoration: none; transition: all 0.3s ease;">+91
                                        9933202248</a>
                                </p>
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items: flex-start;">
                                <i class="fas fa-envelope"
                                    style="color: rgb(17, 157, 213); font-size: 18px; margin-right: 15px; margin-top: 3px; width: 20px; text-align: center;"></i>
                                <p style="color: #fff; margin: 0; font-size: 15px; line-height: 1.6;"><a
                                        href="mailto:info@andamanbliss.com"
                                        style="color: #fff; text-decoration: none; transition: all 0.3s ease;">info@andamanbliss.com</a>
                                </p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <a href="https://www.facebook.com/andamanbliss/"
                                style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; background-color: rgb(17, 157, 213); border-radius: 50%; color: #fff; font-size: 16px; transition: all 0.3s ease;"
                                aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/andamanbliss/"
                                style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; background-color: rgb(17, 157, 213); border-radius: 50%; color: #fff; font-size: 16px; transition: all 0.3s ease;"
                                aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="https://x.com/andaman_bliss"
                                style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; background-color: rgb(17, 157, 213); border-radius: 50%; color: #fff; font-size: 16px; transition: all 0.3s ease;"
                                aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="https://in.linkedin.com/in/andaman-bliss"
                                style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; background-color: rgb(17, 157, 213); border-radius: 50%; color: #fff; font-size: 16px; transition: all 0.3s ease;"
                                aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://www.youtube.com/@andamanbliss"
                                style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; background-color: rgb(17, 157, 213); border-radius: 50%; color: #fff; font-size: 16px; transition: all 0.3s ease;"
                                aria-label="YouTube"><i class="fab fa-youtube"></i></a>

                        </div>
                    </div>
                </div>

                <!-- Services Widget -->
                <div class="col-lg-2 col-md-6 col-sm-6 col-6 mb-4 mb-lg-0">
                    <div style="margin-bottom: 30px;">
                        <h3
                            style="color: #fff; font-size: 20px; font-weight: 700; margin-bottom: 25px; position: relative; padding-bottom: 12px;">
                            Our Services
                            <span
                                style="content: ''; position: absolute; bottom: 0; left: 0; width: 50px; height: 3px; background: linear-gradient(to right, #fd6e0f, #ff9248); border-radius: 10px; display: block;"></span>
                        </h3>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 12px;"><a href="{{ url('andaman-tour-packages') }}"
                                    style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                        class="fas fa-angle-right"
                                        style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                    Tour Packages</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ url('hotels') }}"
                                    style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                        class="fas fa-angle-right"
                                        style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                    Hotel Booking</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ url('water-sports') }}"
                                    style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                        class="fas fa-angle-right"
                                        style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                    Water Sports</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ url('cabs') }}"
                                    style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                        class="fas fa-angle-right"
                                        style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                    Cab Booking</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ url('bikes') }}"
                                    style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                        class="fas fa-angle-right"
                                        style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                    Bike Rental</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{route('cruises')}}"
                                    style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                        class="fas fa-angle-right"
                                        style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                    Ferry Booking</a></li>
                            <li style="margin-bottom: 12px;"><a
                                    href="{{ url('andaman-tour-packages/custom-booking-package') }}"
                                    style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                        class="fas fa-angle-right"
                                        style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                    Custom Tours</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Quick Links Widget -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-4 mb-lg-0">
                    <div style="margin-bottom: 30px;">
                        <h3
                            style="color: #fff; font-size: 20px; font-weight: 700; margin-bottom: 25px; position: relative; padding-bottom: 12px;">
                            Quick Links
                            <span
                                style="content: ''; position: absolute; bottom: 0; left: 0; width: 50px; height: 3px; background: linear-gradient(to right, #fd6e0f, #ff9248); border-radius: 10px; display: block;"></span>
                        </h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="margin-bottom: 12px;"><a href="{{ url('/about') }}"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            About Us</a></li>
                                    <li style="margin-bottom: 12px;"><a href="{{ url('/contact') }}"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            Contact Us</a></li>
                                    <li style="margin-bottom: 12px;"><a href="https://g.co/kgs/hienAoD"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            Reviews</a></li>
                                    <li style="margin-bottom: 12px;"><a href="{{ url('/faqs') }}"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            FAQs</a></li>
                                    <li style="margin-bottom: 12px;"><a href="{{ url('blogs') }}"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            Blogs</a></li>
                                    <li style="margin-bottom: 12px;"><a href="{{ url('/careers') }}"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            Careers</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <ul style="list-style: none; padding: 0; margin: 0;">

                                    <li style="margin-bottom: 12px;"><a href="{{ url('/press-media') }}"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            Press Release</a></li>
                                    <li style="margin-bottom: 12px;"><a href="{{ url('/announcement') }}"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            Announcements</a></li>
                                    <li style="margin-bottom: 12px;"><a href="{{ url('/visa-info') }}"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            Visa Documents</a></li>
                                    <li style="margin-bottom: 12px;"><a href="{{ url('/bank-accounts') }}"
                                            style="color: #fff; text-decoration: none; transition: all 0.3s ease; font-size: 15px; display: flex; align-items: center;"><i
                                                class="fas fa-angle-right"
                                                style="color: rgb(17, 157, 213); margin-right: 10px; font-size: 12px; transition: all 0.3s ease;"></i>
                                            Bank Details</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Destinations Widget -->
                <div class="col-lg-3 col-md-6  mb-4 mb-lg-0">
                    <div style="margin-bottom: 30px;">
                        <h3
                            style="color: #fff; font-size: 20px; font-weight: 700; margin-bottom: 25px; position: relative; padding-bottom: 12px;">
                            Popular Destinations
                            <span
                                style="content: ''; position: absolute; bottom: 0; left: 0; width: 50px; height: 3px; background: linear-gradient(to right, #fd6e0f, #ff9248); border-radius: 10px; display: block;"></span>
                        </h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">Havelock
                                Island</a>
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">Neil
                                Island</a>
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">Port
                                Blair</a>
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">Baratang</a>
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">Diglipur</a>
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">Mayabunder</a>
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">Rangat</a>
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">Ross
                                Island</a>
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">North
                                Bay</a>
                            <a href="#"
                                style="display: inline-block; padding: 6px 15px; background-color: rgba(17, 157, 213, 0.15); border-radius: 30px; color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease; border: 1px solid rgba(17, 157, 213, 0.3);">Chidiya
                                Tapu</a>
                        </div>

                        <!-- Certifications -->
                        <div style="margin-top: 30px;">
                            <h3
                                style="color: #fff; font-size: 20px; font-weight: 700; margin-bottom: 25px; position: relative; padding-bottom: 12px;">
                                Secure Payment Options
                                <span
                                    style="content: ''; position: absolute; bottom: 0; left: 0; width: 50px; height: 3px; background: linear-gradient(to right, #fd6e0f, #ff9248); border-radius: 10px; display: block;"></span>
                            </h3>
                            <div
                                style="background-color: rgba(255, 255, 255, 0.05); padding: 15px; border-radius: 10px;">
                                <img src="{{ asset('site/img/payment-options.png') }}" alt="Certifications"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Methods -->
            <div
                style="background-color: rgba(255, 255, 255, 0.05); padding: 20px; border-radius: 10px;  border: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h3 style="color: #fff; font-size: 18px; font-weight: 600; margin-bottom: 0;">Certifications
                        </h3>
                    </div>
                    <div class="col-md-8">
                        <div style="text-align: right;">
                            <img src="{{ asset('site/img/approved.webp') }}" alt="Payment Options"
                                class="img-fluid rounded-pill">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div style="background-color: rgba(0, 0, 0, 0.3); padding: 25px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 mb-3 mb-md-0">
                    <div>
                        <p style="color: #fff; margin: 0; font-size: 14px;">&copy; {{ date('Y') }} Andaman Bliss™. All
                            Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div style="display: flex; justify-content: flex-end; gap: 20px;">
                        <a href="{{ url('/terms-conditions') }}"
                            style="color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease;">Terms
                            & Conditions</a>
                        <a href="{{ url('/privacy-policy') }}"
                            style="color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease;">Privacy
                            Policy</a>
                        <a href="{{ url('/cancellation-policy') }}"
                            style="color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease;">Cancellation
                            Policy</a>
                        

                        
                        <!-- <a href="{{ url('/payment') }}"
                            style="color: #fff; font-size: 14px; text-decoration: none; transition: all 0.3s ease;">Payment</a> -->
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <p style="color: rgba(255, 255, 255, 0.7); font-size: 12px; line-height: 1.6; margin: 0;">All
                        claims, disputes and litigation relating to online booking through this website anywhere from
                        India or abroad shall be subject to jurisdiction of Courts of Andaman only. All Images shown
                        here are for representation purpose only.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Connect with instagram -->
    <!-- <div style="position: fixed; left: 20px; bottom: 20px; z-index: 99999;">
        <a href="https://www.instagram.com/andamanbliss/" target="_blank"
            style="display: flex; align-items: center; background: linear-gradient(297deg, #ff2dd8, #ff2628cc); color: #fff; padding: 10px 15px; border-radius: 30px; text-decoration: none; font-weight: 500; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); transition: all 0.3s ease; overflow: hidden; width: 50px;"
            onmouseover="this.style.width='200px'" onmouseout="this.style.width='50px'">
            <i class="fab fa-instagram" style="font-size: 20px; margin-right: 3px;"></i>
            <span class="px-0"
                style="white-space: nowrap; opacity: 0; transition: opacity 0.3s ease; padding-right:10px;">Connect on
                Instagram</span>
        </a>
    </div> -->

    <!-- Back to Top Button -->
    <a href="#"
        style="position: fixed; bottom: 30px; right: 30px; width: 45px; height: 45px; background-color: #fd6e0f; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 99; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);"
        id="backToTop" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </a>

    <!-- Floating Contact Buttons -->
    <div class="d-md-none"  style="position: fixed; right: 20px; bottom: 80px; z-index: 999;" id="sy-whatshelp">
        <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 10px; opacity: 1; visibility: true; transform: translateY(20px); transition: all 0.3s ease;" class="sywh-services">            
            <a href="#" data-bs-toggle="modal" id="expert-btn" data-bs-target="#Expert" style="display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; border-radius: 50%; color: #fff; text-decoration: none; transition: all 0.3s ease; position: relative; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); background-color: #25d366;"
                data-tooltip="Enquire Now" data-placement="left" target="_blank">
                <i class="fa-solid fa-headset"></i>
            </a>           
        </div>       
    </div>
</footer>

@push('styles')
<style type="text/css">
/* Modern Footer Styles */
#footer.modern-footer {
    position: relative;
    margin-top: 80px;
    color: #fff;
    overflow: hidden;
    background-color: #001e3c;
}

/* Footer Wave */
.footer-wave-top {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 70px;
    overflow: hidden;
    line-height: 0;
    transform: translateY(-99%);
}

.footer-wave-top svg {
    position: relative;
    display: block;
    width: 100%;
    height: 70px;
}

/* Newsletter Section */
.newsletter-section {
    background: linear-gradient(135deg, rgb(17, 157, 213) 0%, rgb(0, 115, 170) 100%);
    padding: 40px 0;
    margin-bottom: 0;
    position: relative;
}

.newsletter-container {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.newsletter-content h3 {
    color: #fff;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 10px;
}

.newsletter-content p {
    color: #fff;
    font-size: 16px;
    margin-bottom: 0;
}

.newsletter-form .input-group {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 50px;
    overflow: hidden;
}

.newsletter-form .form-control {
    height: 54px;
    border: none;
    padding: 0 25px;
    font-size: 15px;
    background: #fff;
}

.newsletter-form .form-control:focus {
    box-shadow: none;
}

.newsletter-form .subscribe-btn {
    background-color: #fd6e0f;
    color: #fff;
    border: none;
    font-weight: 600;
    padding: 0 30px;
    border-radius: 0 50px 50px 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.newsletter-form .subscribe-btn:hover {
    background-color: #e05d00;
}

/* Footer Main */
.footer-main {
    background-color: #001e3c;
    padding: 70px 0 40px;
    position: relative;
}

/* Footer Widgets */
.footer-widgets {
    margin-bottom: 40px;
}

.footer-widget {
    margin-bottom: 30px;
}

.footer-logo {
    margin-bottom: 25px;
    max-width: 180px;
    background-color: rgba(255, 255, 255, 0.1);
    padding: 15px;
    border-radius: 10px;
}

.footer-logo img {
    max-width: 100%;
    height: auto;
}

.about-content p {
    color: #fff;
    line-height: 1.7;
    margin-bottom: 25px;
    font-size: 15px;
}

.widget-title {
    color: #fff;
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 12px;
}

.widget-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(to right, #fd6e0f, #ff9248);
    border-radius: 10px;
}

/* Footer Contact Info */
.footer-contact-info {
    margin-bottom: 25px;
}

.contact-item {
    display: flex;
    margin-bottom: 15px;
    align-items: flex-start;
}

.contact-item i {
    color: rgb(17, 157, 213);
    font-size: 18px;
    margin-right: 15px;
    margin-top: 3px;
    width: 20px;
    text-align: center;
}

.contact-item p {
    color: #fff;
    margin: 0;
    font-size: 15px;
    line-height: 1.6;
}

.contact-item a {
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.contact-item a:hover {
    color: #fd6e0f;
}

/* Social Links */
.social-links {
    display: flex;
    gap: 12px;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    background-color: rgb(17, 157, 213);
    border-radius: 50%;
    color: #fff;
    font-size: 16px;
    transition: all 0.3s ease;
}

.social-link:hover {
    background-color: #fd6e0f;
    color: #fff;
    transform: translateY(-5px);
}

/* Footer Links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 15px;
    display: flex;
    align-items: center;
}

.footer-links a i {
    color: rgb(17, 157, 213);
    margin-right: 10px;
    font-size: 12px;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #fd6e0f;
}

.footer-links a:hover i {
    color: #fd6e0f;
    transform: translateX(3px);
}

/* Destination Tags */
.destination-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.destination-tag {
    display: inline-block;
    padding: 6px 15px;
    background-color: rgba(17, 157, 213, 0.15);
    border-radius: 30px;
    color: #fff;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(17, 157, 213, 0.3);
}

.destination-tag:hover {
    background-color: #fd6e0f;
    color: #fff;
    transform: translateY(-3px);
    border-color: #fd6e0f;
}

/* Awards Section */
.awards-section {
    margin-top: 30px;
}

.awards-container {
    background-color: rgba(255, 255, 255, 0.05);
    padding: 15px;
    border-radius: 10px;
}

.awards-container img {
    border-radius: 10px;
    max-width: 100%;
}

/* Payment Methods */
.payment-methods {
    background-color: rgba(255, 255, 255, 0.05);
    padding: 20px;
    border-radius: 10px;
    margin-top: 30px;
    margin-bottom: 40px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.payment-title {
    color: #fff;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 0;
}

.payment-icons {
    text-align: right;
}

/* Footer Bottom */
.footer-bottom {
    background-color: rgba(0, 0, 0, 0.3);
    padding: 25px 0;
}

.copyright p {
    color: #fff;
    margin: 0;
    font-size: 14px;
}

.footer-bottom-links {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
}

.footer-bottom-links a {
    color: #fff;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-bottom-links a:hover {
    color: #fd6e0f;
}

.legal-note {
    color: rgba(255, 255, 255, 0.7);
    font-size: 12px;
    line-height: 1.6;
    margin: 0;
}

/* Telegram Connect Floating */
.telegram-connect-floating {
    position: fixed;
    left: 20px;
    bottom: 20px;
    z-index: 99;
}

.telegram-connect-floating a {
    display: flex;
    align-items: center;
    background-color: rgb(17, 157, 213);
    color: #fff;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.telegram-connect-floating a i {
    font-size: 20px;
    margin-right: 8px;
}

.telegram-connect-floating a:hover {
    background-color: #fd6e0f;
    transform: translateY(-5px);
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 45px;
    height: 45px;
    background-color: #fd6e0f;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 99;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.back-to-top.active {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover {
    background-color: rgb(17, 157, 213);
    color: #fff;
    transform: translateY(-5px);
}

/* Floating Contact Buttons */
.floating-contact {
    position: fixed;
    right: 20px;
    bottom: 80px;
    z-index: 999;
}

.contact-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 10px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.contact-buttons.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.contact-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.contact-button:hover {
    transform: scale(1.1);
}

.messenger {
    background-color: #0084ff;
}

.whatsapp {
    background-color: #25d366;
}

.call {
    background-color: #fd6e0f;
}

.contact-toggle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: rgb(17, 157, 213);
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.contact-toggle:hover {
    background-color: #fd6e0f;
}

.contact-toggle .fa-times {
    display: none;
}

.contact-toggle.active .fa-comments {
    display: none;
}

.contact-toggle.active .fa-times {
    display: block;
}

/* Responsive Styles */
@media (max-width: 1199px) {
    .newsletter-container {
        padding: 25px;
    }

    .newsletter-content h3 {
        font-size: 22px;
    }
}

@media (max-width: 991px) {
    .footer-main {
        padding: 60px 0 30px;
    }

    .newsletter-section {
        margin-bottom: 0;
    }

    .footer-bottom-links {
        justify-content: center;
        flex-wrap: wrap;
    }

    .copyright {
        text-align: center;
        margin-bottom: 10px;
    }

    .payment-icons {
        text-align: center;
        margin-top: 15px;
    }

    .payment-title {
        text-align: center;
    }
}

@media (max-width: 767px) {
    #footer.modern-footer {
        margin-top: 60px;
    }

    .footer-main {
        padding: 50px 0 30px;
    }

    .newsletter-container {
        padding: 20px;
    }

    .newsletter-content h3 {
        font-size: 20px;
    }

    .newsletter-content p {
        font-size: 14px;
    }

    .newsletter-form .form-control {
        height: 48px;
    }

    .widget-title {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .footer-bottom {
        padding: 20px 0;
    }

    .footer-bottom-links {
        gap: 15px;
    }

    .telegram-connect-floating {
        display: none;
    }
}

@media (max-width: 575px) {
    .newsletter-container {
        padding: 15px;
    }

    .newsletter-content h3 {
        font-size: 18px;
    }

    .newsletter-form .subscribe-btn {
        padding: 0 15px;
        font-size: 14px;
    }

    .social-link {
        width: 34px;
        height: 34px;
        font-size: 14px;
    }

    .destination-tag {
        padding: 5px 12px;
        font-size: 13px;
    }

    .back-to-top {
        width: 40px;
        height: 40px;
        right: 20px;
        bottom: 20px;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    // Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('#backToTop').css({
                'opacity': '1',
                'visibility': 'visible'
            });
        } else {
            $('#backToTop').css({
                'opacity': '0',
                'visibility': 'hidden'
            });
        }
    });

    $('#backToTop').click(function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    // Floating contact buttons
    $('.sywh-open-services').click(function() {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $('.sywh-services').css({
                'opacity': '1',
                'visibility': 'visible',
                'transform': 'translateY(0)'
            });
            $(this).find('.fa-comments').hide();
            $(this).find('.fa-times').show();
        } else {
            $('.sywh-services').css({
                'opacity': '0',
                'visibility': 'hidden',
                'transform': 'translateY(20px)'
            });
            $(this).find('.fa-comments').show();
            $(this).find('.fa-times').hide();
        }
    });

    // Add hover effects to destination tags
    $('[style*="background-color: rgba(17, 157, 213, 0.15)"]').hover(
        function() {
            $(this).css({
                'background-color': '#fd6e0f',
                'color': '#fff',
                'transform': 'translateY(-3px)',
                'border-color': '#fd6e0f'
            });
        },
        function() {
            $(this).css({
                'background-color': 'rgba(17, 157, 213, 0.15)',
                'color': '#fff',
                'transform': 'translateY(0)',
                'border-color': 'rgba(17, 157, 213, 0.3)'
            });
        }
    );

    // Add animation to newsletter form
    $('.newsletter-form .form-control').focus(function() {
        $(this).parent().addClass('focused');
    }).blur(function() {
        $(this).parent().removeClass('focused');
    });

    // Add animation to footer links
    $('[style*="color: #fff; text-decoration: none;"]').hover(
        function() {
            $(this).css('color', '#fd6e0f');
        },
        function() {
            $(this).css('color', '#fff');
        }
    );
});

const instaBtn = document.querySelector('a[href*="instagram"]');
instaBtn.addEventListener("mouseover", () => {
    instaBtn.querySelector("span").style.opacity = "1";
});
instaBtn.addEventListener("mouseout", () => {
    instaBtn.querySelector("span").style.opacity = "0";
});

let page_start_time = Date.now();

function sendDuration() {
    let duration = Math.floor((Date.now() - page_start_time) / 1000);

    navigator.sendBeacon("/track-duration", JSON.stringify({
        url: window.location.pathname,
        duration: duration
    }));
}

window.addEventListener("beforeunload", sendDuration);

window.addEventListener("pagehide", sendDuration);

</script>
@endpush

<div class="modal" id="enquiryModal">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content carEnquirymodal">
            <div class="modal-body p-3">
                <div class="d-flex justify-content-end">
                    <span class="text-white text-end" data-bs-dismiss="modal"><i
                            class="fa-solid fa-circle-xmark"></i></span>
                </div>
                <div class="container-fluid bg-light p-4 carform">
                    <form method="POST" action="" id="bookingForm" class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" placeholder="Your Name"
                                value="{{ auth()->user()->name ?? null }}" id="name" class="form-control required">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="email" class="form-label">Email ID</label>
                            <input type="text" name="email" placeholder="Your Email"
                                value="{{ auth()->user()->email ?? null }}" id="email"
                                class="form-control email required">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="mobile" class="form-label">Mobile No.</label>
                            <input type="number" name="mobile" placeholder="Your Mobile"
                                value="{{ auth()->user()->mobile ?? null }}" id="mobile" class="form-control required">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="start_at" class="form-label">Date Of Booking</label>
                            <input type="date" name="start_at" placeholder="Date of Booking" value="{{ date('Y-m-d') }}"
                                id="start_at" class="form-control date required">
                        </div>
                        <div class="d-flex justify-content-center custom-booking-modal-search mt-3">
                            <button type="submit" class="btn ferry-inquiry-btn text-white">Send Enquery</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>