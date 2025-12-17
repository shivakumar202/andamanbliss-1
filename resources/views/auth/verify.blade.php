@extends('layouts.app')
@section('title', 'Verify Email')

@section('content')
<section id="common_author_area" class="section_padding">
    <div class="container">
        <div class="row mt-5 py-5">
            <div class="col-lg-8 offset-lg-2">
                <div class="common_author_boxed">
                    <div class="common_author_heading">
                        <h2>{{ __('Verify Your Email Address') }}</h2>
                    </div>

                    <div class="common_author_form">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}" id="main_author_form">
                            @csrf
                            <div class="common_form_submit">
                                <button type="submit" class="btn btn_theme btn_md">
                                    {{ __('click here to request another') }}
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