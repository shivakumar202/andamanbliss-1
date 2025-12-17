<div class="row align-items-center justify-content-center">
    @php
        $currentUrl = url()->current();
    @endphp

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/images') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/images') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
            <span>{{ __('Images') }}</span>
        </a>
    </div>

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/reviews') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/reviews') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
            <span>{{ __('Reviews') }}</span>
        </a>
    </div>

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/meta-headings') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/meta-headings') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-google fa-lg"></i>&nbsp;
            <span>{{ __('Meta Headings') }}</span>
        </a>
    </div>

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/faqs') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/faqs') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
            <span>{{ __('Faqs') }}</span>
        </a>
    </div>

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/inclusion-exclusions') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/inclusion-exclusions') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
            <span>{{ __('Inclusions & Exclusions') }}</span>
        </a>
    </div>

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/experiences') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/experiences') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
            <span>{{ __('Experiences') }}</span>
        </a>
    </div>

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/why-us') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/why-us') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
            <span>{{ __('Why Us') }}</span>
        </a>
    </div>

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/itinerary') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/itinerary') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
            <span>{{ __('Itinerary') }}</span>
        </a>
    </div>

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/pricing') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/pricing') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-inr fa-lg"></i>&nbsp;
            <span>{{ __('Pricing') }}</span>
        </a>
    </div>

    <div class="align-self-center col-md-2">
        <a href="{{ url('admin/tours/' . @$tour->id . '/edit') }}"
           class="btn btn-block my-1 {{ $currentUrl == url('admin/tours/' . @$tour->id . '/edit') ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
            <span>{{ __('Edit') }}</span>
        </a>
    </div>
</div>
