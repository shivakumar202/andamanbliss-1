@extends('admin.layouts.guest')

@section('title', __('Reset Password'))

@section('content')
<div class="card-body">
    <form name="form" method="POST" action="{{ route('admin.password.update') }}" id="form">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" placeholder="Email" value="{{ $email ?? old('email') }}" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" autofocus autocomplete="off">
            @if ($errors->has('email'))
            <label class="error">{{ $errors->first('email') }}</label>
            @endif
        </div>

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" placeholder="Password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" autocomplete="off">
            @if ($errors->has('password'))
            <label class="error">{{ $errors->first('password') }}</label>
            @endif
        </div>

        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password_confirmation" name="password_confirmation" placeholder="Confirm Password" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" autocomplete="off">
            @if ($errors->has('password_confirmation'))
            <label class="error">{{ $errors->first('password_confirmation') }}</label>
            @endif
        </div>

        <button type="submit" class="btn btn-info btn-flat m-b-30 m-t-30">
            {{ __('Reset Password') }}
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