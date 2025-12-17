@extends('layouts.app')
@section('title', 'Confirm Password')

@section('content')
<section id="common_author_area" class="section_padding">
    <div class="container">
        <div class="row mt-5 py-5">
            <div class="col-lg-8 offset-lg-2">
                <div class="common_author_boxed">
                    <div class="common_author_heading">
                        <h2>{{ __('Confirm Password') }}</h2>
                    </div>

                    <div class="common_author_form">
                        {{ __('Please confirm your password before continuing.') }}

                        <form method="POST" action="{{ route('password.confirm') }}" id="main_author_form">
                            @csrf
                            <div class="form-group">
                                <input type="password" name="password" placeholder="{{ __('Password') }}" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="common_form_submit">
                                <button type="submit" class="btn btn_theme btn_md">
                                    {{ __('Confirm Password') }}
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                            <a class="float-end" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
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