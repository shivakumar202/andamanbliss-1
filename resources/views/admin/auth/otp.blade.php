@extends('admin.layouts.guest')

@section('title', __('OTP Login'))

@section('content')
<div class="card-body">
    <form name="form" method="POST" action="{{ url('admin/otp/' . request()->id . '/login') }}" id="form">
        @csrf

        <div class="form-group">
            <label for="otp">{{ __('OTP') }}</label>
            <input type="text" name="otp" placeholder="OTP" value="{{ old('otp') }}" otp="{{ session('otp') }}" id="otp" class="form-control {{ $errors->has('otp') ? 'is-invalid' : '' }}" autofocus autocomplete="off">
            @if ($errors->has('otp'))
            <label class="error">{{ $errors->first('otp') }}</label>
            @endif
        </div>

        <div class="checkbox">
            <label class="pull-right">
                <a href="{{ url('admin/otp/' . request()->id . '/generate') }}">
                    {{ __('Resend OTP') }}
                </a>
            </label>
        </div>

        <button type="submit" class="btn btn-info btn-flat m-b-30 m-t-30">
            {{ __('Login') }}
        </button>
    </form>
</div>
@endsection

@section('css')
<style type="text/css">

</style>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        //
    });
</script>
@endsection