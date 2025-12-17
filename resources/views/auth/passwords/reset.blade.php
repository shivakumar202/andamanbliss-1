@extends('layouts.app')
@section('title', 'Reset Password')

@section('content')
<section id="common_author_area" class="section_padding">
    <div class="container">
        <div class="row mt-5 py-5">
            <div class="d-flex justify-content-center align-items-center">
                <div class="common_author_boxed">
                    <div class="common_author_heading">
                        <h2>{{ __('Reset Password') }}</h2>
                        <p> {{ __('Secure Your Account with a Fresh Key and Unlock Access to Your Account') }}</p>
                    </div>

                    <div class="common_author_form">
                        <form method="POST" action="{{ route('password.update') }}" id="main_author_form">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <input type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('Email') }}" id="email" class="form-control rounded-pill @error('email') is-invalid @enderror" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="{{ __('Password') }}" id="password" class="form-control rounded-pill @error('password') is-invalid @enderror" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" id="password-confirm" class="form-control rounded-pill" required autocomplete="new-password">
                            </div>
                            <div class="common_form_submit">
                                <button type="submit" class="btn btn_theme btn_md">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
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
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // page scripts
    });
</script>
@endpush