@extends('admin.layouts.guest')

@section('title', __('Login'))

@section('content')
<div class="card-body">
    <form name="form" method="POST" action="{{ route('admin.login') }}" id="form">
        @csrf

        <div class="form-group">
            <label for="username">{{ __('Username') }}</label>
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" id="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" autofocus autocomplete="off">
            @if ($errors->has('username'))
            <label class="error">{{ $errors->first('username') }}</label>
            @endif
        </div>

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" placeholder="Password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
            @if ($errors->has('password'))
            <label class="error">{{ $errors->first('password') }}</label>
            @endif
        </div>

        <div class="checkbox">
            <label for="remember">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                {{ __('Remember Me') }}
            </label>
            <label class="pull-right">
                @if (Route::has('admin.password.request'))
                <a href="{{ route('admin.password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
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