 <div class="row align-items-center justify-content-center">
     @php
     $currentUrl = url()->current();
     @endphp
     <div class="align-self-center col-md-2">
         <a href="{{ url('admin/boat-trips/' . @$locationId->id. '/images') }}" class="btn btn-block my-1 {{ $currentUrl == url('admin/boat-trips/' . @$locationId->id. '/images') ? 'btn-info' : 'btn-outline-info' }}">
             <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
             <span>{{ __('Images') }}</span>
         </a>
     </div>
     <div class="align-self-center col-md-2">
         <a href="{{ url('admin/boat-trips/' . @$locationId->id. '/faqs') }}" class="btn btn-block my-1 {{ $currentUrl == url('admin/boat-trips/' . @$locationId->id. '/faqs') ? 'btn-info' : 'btn-outline-info' }}">
             <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
             <span>{{ __('Faqs') }}</span>
         </a>
     </div>

     <div class="align-self-center col-md-2">
         <a href="{{ url('admin/boat-trips/' . @$locationId->id. '/meta-headings') }}" class="btn btn-block my-1 {{ $currentUrl == url('admin/boat-trips/' . @$locationId->id. '/meta-headings') ? 'btn-info' : 'btn-outline-info' }}">
             <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
             <span>{{ __('Meta Headings') }}</span>
         </a>
     </div>

     <div class="align-self-center col-md-2">
         <a href="{{ url('admin/boat-trips/' . @$locationId->id. '/content-blocks') }}" class="btn btn-block my-1 {{ $currentUrl == url('admin/boat-trips/' . @$locationId->id. '/content-blocks') ? 'btn-info' : 'btn-outline-info' }}">
             <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
             <span>{{ __('Content Block') }}</span>
         </a>
     </div>

     <div class="align-self-center col-md-2">
         <a href="{{ url('admin/boat-trips/' . @$locationId->id. '/read-more-content') }}" class="btn btn-block my-1 {{ $currentUrl == url('admin/boat-trips/'. @$locationId->id . '/read-more-content') ? 'btn-info' : 'btn-outline-info' }}">
             <i class="fa fa-book fa-lg"></i>
             <span>{{ __('Read More Content') }}</span>
         </a>
     </div>

     <div class="align-self-center col-md-2">
         <a href="{{ url('admin/boat-locations/' . @$locationId->id) }}" class="btn btn-block my-1 {{ $currentUrl == url('admin/boat-locations/' . @$locationId->id) ? 'btn-info' : 'btn-outline-info' }}">
             <i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;
             <span>{{ __('Edit') }}</span>
         </a>
     </div>
 </div>