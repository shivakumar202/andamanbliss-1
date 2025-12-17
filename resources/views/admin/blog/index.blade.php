@extends('admin.layouts.app')

@section('title', __('Blogs'))

@section('content')
<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
    <div class="row">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>{{ __('Blogs') }}</h1>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="page-header float-right">
          <div class="page-title">
            <ol class="breadcrumb text-right">
              <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
              <li class="active">{{ __('Blogs') }}</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <a href="javascript:history.back();" class="btn btn-info float-right my-2 mx-3">
          <i class="fa fa-undo fa-lg"></i>&nbsp;{{ __('Back') }}
        </a>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="animated fadeIn">
    @include('admin.layouts.alert')
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">{{ __('Blogs') }}</strong>
          </div>
          <div class="card-body">
            <table id="dataTable" class="table table-striped table-hover w-100">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Author</th>
                  <th>Status</th>
                  <th>Featured</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($blogs as $blog)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $blog->title }}</td>
                  <td>{{ $blog->category }}</td>
                  <td>{{ $blog->author }}</td>
                  <td>
                    <label class="toggle-switch">
                      <input type="checkbox" data-id="{{ $blog->id }}" onchange="changeStatus(this)" {{ $blog->status ?
                      'checked' : '' }}>
                      <span class="slider"></span>
                    </label>
                  </td>
                  <td>
                    <label class="toggle-switch">
                      <input type="checkbox" data-id="{{ $blog->id }}" onchange="changeFeatured(this)" {{
                        $blog->featured ? 'checked' : '' }}>
                      <span class="slider"></span>
                    </label>
                  </td>
                  <td>
                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-xs btn-outline-info py-0 mx-1">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Are you sure you want to delete this blog?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-xs btn-outline-danger py-0 mx-1" title="Delete Blog">
                        <i class="fa fa-trash-o"></i>
                      </button>
                    </form>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
<style>
  .toggle-switch {
    width: 50px;
    height: 25px;
    position: relative;
    display: inline-block;
  }

  .toggle-switch input {
    display: none;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    background-color: red;
    border-radius: 25px;
    transition: 0.4s;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 21px;
    width: 21px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    border-radius: 50%;
    transition: 0.4s;
  }

  input:checked+.slider {
    background-color: green;
  }

  input:checked+.slider:before {
    transform: translateX(25px);
  }
</style>
@endsection

@section('script')
@section('script')
<script>
  $(document).ready(function () {
    // Set up CSRF token for all AJAX requests
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#dataTable').DataTable({
      responsive: true,
      lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'All']],
      pageLength: 10,
      aaSorting: [0, 'DESC'],
      columnDefs: [
        { targets: [0, 6], orderable: false },
        { targets: [0, 6], searchable: false },
        { targets: [0], visible: true }
      ]
    });
  });

 function changeStatus(el) {
    let id = $(el).data('id');
    let status = $(el).is(':checked') ? 1 : 0; // Sends 1 or 0
    $.ajax({
        method: 'POST',
        url: '{{ route('admin.blogs.changeStatus') }}',
        data: {
            id: id,
            status: status,
        },
        success: function(response) {
            console.log('Status updated successfully:', response);
        },
        error: function(xhr) {
            console.error('Error updating status:', xhr.responseText);
            alert('Failed to update status. Please try again.');
        }
    });
}

function changeFeatured(el) {
    let id = $(el).data('id');
    let featured = $(el).is(':checked') ? 1 : 0; // Sends 1 or 0
    $.ajax({
        method: 'POST',
        url: '{{ route('admin.blogs.changeFeatured') }}',
        data: {
            id: id,
            featured: featured,
        },
        success: function(response) {
            console.log('Featured status updated successfully:', response);
        },
        error: function(xhr) {
            console.error('Error updating featured status:', xhr.responseText);
            alert('Failed to update featured status. Please try again.');
        }
    });
}
</script>
@endsection
@endsection