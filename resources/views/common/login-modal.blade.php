<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="cc-container modal-body" id="container">
                <button type="button" class="btn-close position-absolute" style="z-index:999" data-bs-dismiss="modal"></button>

                <div class="cc-form-container cc-sign-up-container">
                    <form class="cc-form" id="signUpForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1>Create Account</h1>

                        <div class="cc-social-container">
                            <a href="{{ route('google.register') }}" class="cc-social">

                            <button class="gsi-material-button" type="button">
                                <div class="gsi-material-button-state"></div>
                                <div class="gsi-material-button-content-wrapper">
                                    <div class="gsi-material-button-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                                            <path fill="none" d="M0 0h48v48H0z"></path>
                                        </svg>
                                    </div>
                                    <span class="gsi-material-button-contents">Sign in with Google</span>
                                    <span style="display: none;">Sign in with Google</span>
                                </div>
                            </button>
                        </a>
                           
                        </div>

                        <span>or use your email for registration</span>
                        <input class="cc-input" type="text" name="name" placeholder="Name">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input class="cc-input" type="email" name="email" placeholder="Email">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="hidden" name="website" id="website">
                        <input type="hidden" name="current_url" value="{{ url()->full() }}">
                        <input class="cc-input" type="password" name="password" placeholder="Password">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}*" id="password-confirm" class="cc-input" required autocomplete="new-password">

                        <button class="cc-button" type="submit">Sign Up</button>
                        <button type="button" id="mobileGoSignIn" class="cc-mobile-switch">Already have an account? Sign In</button>
                    </form>
                </div>

                <div class="cc-form-container cc-sign-in-container">
                    <form class="cc-form" method="POST" action="{{ route('axjlogin') }}" id="signInForm">
                        @csrf
                        <h1>Sign in</h1>
                        <div class="cc-social-container">
                             <a href="{{ route('google.login') }}" class="cc-social">
                                    <button type="button" class="gsi-material-button">
                                        <div class="gsi-material-button-state"></div>
                                        <div class="gsi-material-button-content-wrapper">
                                            <div class="gsi-material-button-icon">
                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                                                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                                                    <path fill="none" d="M0 0h48v48H0z"></path>
                                                </svg>
                                            </div>
                                            <span class="gsi-material-button-contents">Continue With Google</span>
                                            <span style="display: none;">Continue With Google</span>
                                        </div>
                                    </button>
                                </a>   
                           
                        </div>

                       
                        <span>or use your account</span>
                        <input class="cc-input" type="email" name="username" placeholder="User name" required>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="hidden" name="website" id="website">
                        <input class="cc-input" type="password" name="password" required placeholder="Password">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <button class="cc-button" type="submit">Sign In</button>
                        <button type="button" id="mobileGoSignUp" class="cc-mobile-switch">New account? Sign Up</button>
                    </form>
                </div>

                <div class="cc-overlay-container">
                    <div class="cc-overlay">
                        <div class="cc-overlay-panel cc-overlay-left">
                            <h1 class="cc-text">Welcome to Your Account!</h1>
                            <p class="cc-text">Log in to manage your reservations across all services.</p>
                            <button class="cc-button cc-ghost" id="signIn">Sign Up</button>
                        </div>
                        <div class="cc-overlay-panel cc-overlay-right">
                            <h1 class="cc-text">Access Your Account</h1>
                            <p class="cc-text">Sign in to continue your bookings and manage your details.</p>
                            <button class="cc-button cc-ghost" id="signUp">Sign In</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    const mobileGoSignIn = document.getElementById('mobileGoSignIn');
    const mobileGoSignUp = document.getElementById('mobileGoSignUp');

    const signInForm = document.querySelector('.cc-sign-in-container');
    const signUpForm = document.querySelector('.cc-sign-up-container');

    document.querySelectorAll('a[href="#"]').forEach(a => a.href = "javascript:void(0)");

    // desktop
    signUpButton.addEventListener('click', () => container.classList.add('right-panel-active'));
    signInButton.addEventListener('click', () => container.classList.remove('right-panel-active'));

    // mobile
    function showSignInMobile() {
        signInForm.classList.add('active-mobile');
        signUpForm.classList.remove('active-mobile');
    }

    function showSignUpMobile() {
        signUpForm.classList.add('active-mobile');
        signInForm.classList.remove('active-mobile');
    }

    mobileGoSignIn.addEventListener('click', showSignInMobile);
    mobileGoSignUp.addEventListener('click', showSignUpMobile);
   signUpForm.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log("Signup blocked — add AJAX here");
    });

    // default show sign-in first
    showSignInMobile();
</script>
@endpush