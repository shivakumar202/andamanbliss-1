@extends('admin.layouts.app')

@section('title', __('Tag Manager Pages'))

@section('content')
<!-- Heading -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tag Pages Manager</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/tag-manager/pages') }}">{{ __('Tags pages') }}</a></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <a href="" class="btn btn-info float-right my-2 mx-3">
                    <i class="fa fa-undo fa-lg"></i>&nbsp;
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">

        @include('admin.layouts.alert')

        <!-- Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">
                            {{ __('Tags Page') }} - {{$page->page_url}}
                        </strong>
                    </div>

                    <div class="card-body">
                        <form name="form" action="{{ route('admin.tag-manager.pages.tags.store' , ['id' => @$page->id]) }}" method="POST" id="form" enctype="multipart/form-data" novalidate="novalidate" autocomplete="off">
                            @csrf

                            <input type="text" id="tagSearch" placeholder="Search tags..." class="form-control mb-3">

                            <div class="row justify-content-start">
                                @foreach($tags as $tag)
                                <label class="{{ $page->tags->contains($tag->id) ? 'checkbox-inline-active' : 'checkbox-inline' }} mr-4">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $page->tags->contains($tag->id) ? 'checked' : '' }}> {{ $tag->tag }}
                                </label>
                                @endforeach
                            </div>

                            <hr>

                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-block btn-success my-1">
                                        <i class="fa fa-floppy-o fa-lg"></i>&nbsp; <span>Save</span>
                                    </button>
                                </div>

                                <div class="col-md-2">
                                    <a href="{{ url('admin/tag-manager/pages/'. $page->id .'/page-tags') }}" class="btn btn-block btn-outline-danger my-1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp; <span>Reset</span>
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div><!-- .card -->
            </div>
            <!--/.col-->
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
@endsection

@section('css')
<style type="text/css">
    .checkbox-inline {
        padding: 5px;
        cursor: pointer;
        border: 1px solid #e2e2e2ff;
    }

    .checkbox-inline-active {
        background-color: #ffe209ff;
        padding: 5px;
        cursor: pointer;
        border: 1px solid #e2e2e2ff;
    }

    .checkbox-inline:has(input:checked) {
        background: #55ff8bff;
    }
</style>
@endsection

@section('script')
<script>
document.getElementById('tagSearch').addEventListener('keyup', function () {
    let value = this.value.toLowerCase();
    document.querySelectorAll('.checkbox-inline, .checkbox-inline-active').forEach(function(label){
        let text = label.textContent.toLowerCase();
        label.style.display = text.includes(value) ? '' : 'none';
    });
});
</script>
@endsection