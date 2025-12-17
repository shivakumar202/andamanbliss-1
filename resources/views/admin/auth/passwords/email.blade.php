@extends('admin.layouts.guest')

@section('title', __('Reset Password'))

@section('content')
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form name="form" method="POST" action="{{ route('admin.password.email') }}" id="form">
        @csrf

        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" autofocus autocomplete="off">
            @if ($errors->has('email'))
            <label class="error">{{ $errors->first('email') }}</label>
            @endif
        </div>

        <button type="submit" class="btn btn-info btn-flat m-b-30 m-t-30">
            {{ __('Send Password Reset Link') }}
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