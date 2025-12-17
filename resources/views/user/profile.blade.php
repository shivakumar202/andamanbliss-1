@extends('layouts.app')
@section('title', 'Profile')

@section('content')
<section id="dashboard_main_arae" class="section_padding">
    <div class="container">
        <div class="row mt-5">
            @include('layouts.profile')

            <div class="col-lg-9">
                <div class="dashboard_common_table">
                    <h3>Profile</h3>
                    <div class="profile_update_form">
                        <form action="{{ url('profile') }}" method="POST" id="profile_form_area">
                            @csrf
                            <div class="row">
                                <div class="offset-md-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input type="text" name="name" placeholder="{{ __('Name') }}"
                                            value="{{ auth()->user()->name }}" id="name"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            autocomplete="off" autofocus />
                                        @if ($errors->has('name'))
                                        <label class="error">{{ $errors->first('name') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="offset-md-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="surname">{{ __('Surname') }}</label>
                                        <input type="text" name="surname" placeholder="{{ __('Surname') }}"
                                            value="{{ auth()->user()->surname }}" id="surname"
                                            class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}"
                                            autocomplete="off" />
                                        @if ($errors->has('surname'))
                                        <label class="error">{{ $errors->first('surname') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="offset-md-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="username">{{ __('Username') }}</label>
                                        <input type="text" name="username" placeholder="{{ __('Username') }}"
                                            value="{{ auth()->user()->username }}" id="username"
                                            class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                            autocomplete="off" />
                                        @if ($errors->has('username'))
                                        <label class="error">{{ $errors->first('username') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="offset-md-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input type="email" name="email" placeholder="{{ __('Email') }}"
                                            value="{{ auth()->user()->email }}" id="email"
                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            autocomplete="off" />
                                        @if ($errors->has('email'))
                                        <label class="error">{{ $errors->first('email') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="offset-md-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="mobile">{{ __('Mobile') }}</label>
                                        <input type="text" name="mobile" placeholder="{{ __('Mobile') }}"
                                            value="{{ auth()->user()->mobile }}" id="mobile"
                                            class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                                            autocomplete="off" />
                                        @if ($errors->has('mobile'))
                                        <label class="error">{{ $errors->first('mobile') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="common_form_submit">
                                    <button type="submit" name="submit" id="submit"
                                        class="primary-button button-sm ferry-inquiry-btn my-1">
                                        <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                        <span>{{ __('Save') }}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<style type="text/css">
/* page styles */
</style>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    // page scripts
});
</script>
@endsection