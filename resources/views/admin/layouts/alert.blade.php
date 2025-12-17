<div class="row">
  <div class="col-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
      <strong>{{ __($message) }}</strong>
    </div>
    @endif
    @if ($message = Session::get('info'))
    <div class="alert alert-info" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
      <strong>{{ __($message) }}</strong>
    </div>
    @endif
    @if ($message = Session::get('warning'))
    <div class="alert alert-warning" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
      <strong>{{ __($message) }}</strong>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
      <strong>{{ __($message) }}</strong>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
      <strong>{{ __('Please check the form bellow for errors.') }}</strong>
    </div>
    @endif
  </div>
</div>
