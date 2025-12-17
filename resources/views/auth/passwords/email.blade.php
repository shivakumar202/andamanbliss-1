@extends('layouts.app')
@section('title', 'Forgot Password')

@section('content')
<section id="common_author_area" class="section_padding">
    <div class="container">
        <div class="row mt-5 py-5">
            <div class="d-flex justify-content-center align-items-center col-12">
                <div class="common_author_boxed">
                    <div class="common_author_heading">
                        <h2>{{ __('Reset Password') }}</h2>
                        <p>{{ __('Enter your email address and we will send you a link to reset your password') }}</p>
                    </div>

                    <div class="common_author_form">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" id="main_author_form">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="website" id="website" hidden>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" id="email" class="form-control rounded-pill @error('email') is-invalid @enderror" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="common_form_submit">
                                <button type="submit" class="btn btn_theme btn_md">
                                    {{ __('Send Password Reset Link') }}
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