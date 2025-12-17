@extends('layouts.app')
@section('title', 'Signup')

@section('content')
<section id="common_author_area" class="section_padding">
    <div class="container">
        <div class="row mt-5 py-5">
            <div class="d-flex justify-content-center align-items-center">
                <div class="common_author_boxed w-md-100 w-lg-50 shadow">
                    <div class="common_author_heading">
                        <h3>{{ __('Register') }}</h3>
                    </div>
                    <div class="common_author_form w-100">
                        <form method="POST" action="{{ route('register') }}" id="main_author_form">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="website" id="website" hidden>

                                <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}*" id="name" class="form-control rounded-pill @error('name') is-invalid @enderror" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}*" id="email" class="form-control rounded-pill @error('email') is-invalid @enderror" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="mobile" value="{{ old('mobile') }}" placeholder="{{ __('Mobile') }}*" id="mobile" class="form-control rounded-pill @error('mobile') is-invalid @enderror" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="{{ __('Password') }}*" id="password" class="form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}*" id="password-confirm" class="form-control rounded-pill" required autocomplete="new-password">
                            </div>
                            <div class="common_form_submit">
                                <button type="submit" class="btn btn_theme btn_md rounded-pill px-5">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="have_acount_area other_author_option">
                                <div class="line_or">
                                    <span>or</span>
                                </div>

                                <p class="mt-2">Already have an account? <a href="{{ url('login') }}">Log in now</a></p>
                            </div>
                        </form>
                        <a href="{{ route('google.register') }}" class="">

                            <button class="gsi-material-button" role="button">
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style type="text/css">
    /* page styles */
    #footers {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // page scripts
    });
</script>
@endpush