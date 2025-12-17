@extends('admin.layouts.app')

@section('title', __(@$activity->name . ': Experiences'))

@section('content')
    <!-- Heading -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __(@$activity->name) }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/tours') }}">{{ __('Tour') }}</a></li>
                                <li class="active">{{ __('Experiences') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/tours/' . request('tourId')) }}"
                        class="btn btn-info float-right my-2 mx-3">
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
                                {{ __('Experiences') }}
                            </strong>
                        </div>

                        <div class="card-body">
                   <form method="POST"
    action="{{ url('admin/tours/' . request('tourId') . '/experiences' . ($block ? '/' . $block->id : '')) }}"
    enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="layout" value="singleCard" />

    <div class="form-group">
        <label for="title">Section Title</label>
        <input type="text" name="title" class="form-control"
            value="{{ old('title', $block->title ?? '') }}">
    </div>

    <div class="form-group">
        <label for="desc">Section Description</label>
        <textarea name="desc" class="form-control">{{ old('desc', $block->description ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label>Items</label>
        <div id="listContainer" class="mb-2"></div>
        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addItem()">Add Item</button>
    </div>

    <div class="row align-items-center justify-content-center">
        <div class="align-self-center col-md-2">
            <button type="submit" class="btn btn-block btn-success my-1">
                <i class="fa fa-floppy-o fa-lg"></i>&nbsp;<span>{{ __('Save') }}</span>
            </button>
        </div>
        <div class="align-self-center col-md-2">
            <button type="reset" class="btn btn-block btn-outline-danger my-1">
                <i class="fa fa-refresh fa-lg"></i>&nbsp;<span>{{ __('Reset') }}</span>
            </button>
        </div>
    </div>
</form>


                             <hr>
                            @include('admin.tours.navigation');
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
<style>
    #columnInputs>.col-md-6 {
        padding-right: 0.1px;
    }
</style>

@section('script')
<script>
    function addItem() {
        const container = document.getElementById('listContainer');
        const index = container.children.length;

        const wrapper = document.createElement('div');
        wrapper.className = 'd-flex mb-2 align-items-center';

        const icon = document.createElement('input');
        icon.type = 'text';
        icon.name = `columns_data[0][list${index}][icon]`;
        icon.className = 'form-control mx-1';
        icon.placeholder = 'Icon class';

        const input = document.createElement('input');
        input.type = 'text';
        input.name = `columns_data[0][list${index}][text]`;
        input.className = 'form-control';
        input.placeholder = 'Item text';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-sm btn-danger ms-2';
        removeBtn.innerHTML = '&times;';
        removeBtn.onclick = () => wrapper.remove();

        wrapper.appendChild(icon);
        wrapper.appendChild(input);
        wrapper.appendChild(removeBtn);

        container.appendChild(wrapper);
    }

    window.onload = function () {
        @if (!empty($block))
            const listItems = @json($block->section_blocks[0]['columns_data'][0]['list'] ?? []);
            listItems.forEach((item, idx) => {
                addItem();
                const wrapper = document.getElementById('listContainer').children[idx];
                wrapper.children[0].value = item.icon;
                wrapper.children[1].value = item.text;
            });
        @endif
    };
</script>
@endsection


