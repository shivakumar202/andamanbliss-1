@extends('admin.layouts.app')

@section('title', isset($block) ? 'Edit Content Block' : 'Add Content Block')

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __(@$boatTrip->service_name) }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ url('admin/activities') }}">{{ __('Activity') }}</a></li>
                                <li class="active">{{ __('Content Block') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <a href="{{ url('admin/boat-trips/' . request('tripId')) }}"
                        class="btn btn-info float-right my-2 mx-3">
                        <i class="fa fa-undo fa-lg"></i>&nbsp;
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            @include('admin.layouts.alert')
            <div class="card">
                <div class="card-header">
                    <strong
                        class="card-title">{{ isset($block) ? __('Edit Content Block') : __('New Content Block') }}</strong>
                </div>
                <div class="card-body">

                    @if($block || count($blocks) == 0)

                    <form method="POST"
                        action="{{ url('admin/boat-trips/' . request('tripId') . '/content-blocks' . ($block ? '/' . $block->id : '')) }}"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="form-group d-none">
                            <label for="layout">Layout Type</label>
                            <select name="layout" class="form-control" id="layout">
                                <option value="multiColumnList" selected >Multi-Column</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Section Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $block->title ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="desc">Section Description</label>
                            <textarea name="desc" class="form-control">{{ old('desc', $block->description ?? '') }}</textarea>
                        </div>

                        <div id="columnFields" style="display:none">
                            <label for="columns">Number of Columns</label>
                            <select name="columns" id="columnSelect" class="form-control mb-3"
                                onchange="generateColumns(this.value)">
                                @for ($i = 1; $i <= 4; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('columns', $block->column ?? 2) == $i ? 'selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                            <div id="columnInputs" class="d-flex flex-wrap"></div>
                        </div>

                        <div class="row align-items-center justify-content-center">
                            <div class="align-self-center col-md-2">
                                <button type="submit" name="submit" id="submit" class="btn btn-block btn-success my-1">
                                    <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                    <span>{{ __('Save') }}</span>
                                </button>
                            </div>

                            <div class="align-self-center col-md-2">
                                <button type="reset" name="reset" id="reset"
                                    class="btn btn-block btn-outline-danger my-1">
                                    <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                    <span>{{ __('Reset') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    @endif
                    <hr>
                   
                    @include('admin.boat-trips.navigations')
                    <hr>

                    <table id="dataTable" class="table table-striped table-hover w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Layout') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Columns') }}</th>
                                <th>{{ __('Content Preview') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($blocks as $listblock)
                                @php
                                    $sections = $listblock->section_blocks;
                                    $columns = $sections[0]['columns_data'] ?? [];
                                @endphp
                                <tr>
                                    <td>{{ $listblock->id }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark text-uppercase">
                                            {{ $listblock->layout }}
                                        </span>
                                    </td>
                                    <td>{{ $listblock->title }}</td>
                                    <td>{{ $listblock->description }}</td>
                                    <td>{{ $listblock->column }}</td>
                                    <td>
                                        @foreach ($columns as $column)
                                            <strong>{{ $column['badge'] ?? '-' }}</strong><br>
                                            <strong>{{ $column['title'] ?? '-' }}</strong><br>
                                            <small>{{ $column['desc'] ?? '-' }}</small>
                                            <ul class="mb-2">
                                                @foreach ($column['list'] ?? [] as $item)
                                                    <li>{!! $item['icon'] !!} {{ $item['text'] }}</li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/boat-trips/' . request('tripId') . '/content-blocks/' . $listblock->id) }}"
                                            title="Edit" class="btn btn-xs btn-outline-info py-0 mx-1">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <form id="delete-form-{{ $listblock->id }}" method="POST"
                                            action="{{ url('admin/boat-trips/' . $tripId. '/content-blocks/' . $listblock->id) }}"
                                            class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <a href="javascript:;"
                                            onclick="if(confirm('Are you sure?')) document.getElementById('delete-form-{{ $listblock->id }}').submit();"
                                            title="Delete" class="btn btn-xs btn-outline-danger py-0 mx-1">
                                            <i class="fa fa-trash-o"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    #columnInputs>.col-md-6 {
        padding-right: 0.1px;
    }
</style>

@section('script')
    <script>
        document.getElementById('layout').addEventListener('change', function() {
            const layout = this.value;
            const colFields = document.getElementById('columnFields');
            const colSelect = document.getElementById('columnSelect');
            const colInputs = document.getElementById('columnInputs');

            colFields.style.display = 'none';
            colInputs.innerHTML = '';

            if (layout === 'dualCard') {
                colFields.style.display = 'block';
                colSelect.disabled = true;
                colSelect.value = 2;
                generateColumns(2);
            } else if (layout === 'multiColumnList') {
                colFields.style.display = 'block';
                colSelect.disabled = false;
                generateColumns(colSelect.value);
            } else if (layout === 'singleCard') {
                colFields.style.display = 'block';
                colSelect.disabled = true;
                colSelect.value = 1;
                generateColumns(1);
            }
        });

        function addItem(containerId, nameAttr, placeholder) {
            const container = document.getElementById(containerId);
            const wrapper = document.createElement('div');
            wrapper.className = 'd-flex mb-2 align-items-center';

            const index = container.children.length;

            const icon = document.createElement('input');
            icon.type = 'text';
            icon.name = nameAttr.replace('list][]', `list${index}][icon]`);
            icon.className = 'form-control mx-1';
            icon.placeholder = 'Icon class';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = nameAttr.replace('list][]', `list${index}][text]`);
            input.className = 'form-control';
            input.placeholder = placeholder;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-sm btn-danger ms-2';
            removeBtn.innerHTML = '&times;';
            removeBtn.title = 'Remove';
            removeBtn.onclick = () => {
                wrapper.remove();
            };

            wrapper.appendChild(icon);
            wrapper.appendChild(input);
            wrapper.appendChild(removeBtn);

            container.appendChild(wrapper);
        }


        function generateColumns(count) {
            const container = document.getElementById('columnInputs');
            container.innerHTML = '';
            for (let i = 0; i < count; i++) {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-md-6 mb-4 border rounded p-3';

                const badge = document.createElement('input');
                badge.type = 'text';
                badge.name = `columns_data[${i}][badge]`;
                badge.className = 'form-control mb-2';
                badge.placeholder = `Column ${i + 1} Badge`;

                const title = document.createElement('input');
                title.type = 'text';
                title.name = `columns_data[${i}][title]`;
                title.className = 'form-control mb-2';
                title.placeholder = `Column ${i + 1} Title`;

                const desc = document.createElement('textarea');
                desc.name = `columns_data[${i}][desc]`;
                desc.className = 'form-control mb-2';
                desc.placeholder = `Column ${i + 1} Description`;

                const listDiv = document.createElement('div');
                listDiv.id = `col${i}ListContainer`;

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-sm btn-outline-primary';
                btn.textContent = 'Add Item';
                btn.onclick = () => addItem(`col${i}ListContainer`, `columns_data[${i}][list][]`,
                    `Column ${i + 1} List Item`);

                colDiv.appendChild(badge);
                colDiv.appendChild(title);
                colDiv.appendChild(desc);
                colDiv.appendChild(listDiv);
                colDiv.appendChild(btn);
                container.appendChild(colDiv);
            }
        }

        window.onload = function() {
            const layoutField = document.getElementById('layout');
            const layout = layoutField.value;
            const colCount = document.getElementById('columnSelect').value;

            if (layout === 'dualCard' || layout === 'multiColumnList' || layout === 'singleCard') {
                document.getElementById('columnFields').style.display = 'block';
                if (layout === 'dualCard' || layout === 'singleCard') {
                    document.getElementById('columnSelect').disabled = true;
                }
                generateColumns(colCount);

                @if (!empty($block))
                    const columnsData = @json($block->section_blocks[0]['columns_data'] ?? []);
                    columnsData.forEach((col, i) => {
                        document.querySelector(`[name="columns_data[${i}][badge]"]`).value = col.badge ?? '';
                        document.querySelector(`[name="columns_data[${i}][title]"]`).value = col.title ?? '';
                        document.querySelector(`[name="columns_data[${i}][desc]"]`).value = col.desc ?? '';

                        const containerId = `col${i}ListContainer`;
                        const listItems = col.list ?? [];
                        listItems.forEach((item, idx) => {
                            addItem(containerId, `columns_data[${i}][list][]`,
                                `Column ${i + 1} List Item`);
                            const wrappers = document.getElementById(containerId).children;
                            wrappers[idx].children[0].value = item.icon;
                            wrappers[idx].children[1].value = item.text;
                        });
                    });
                @endif
            }
        };
    </script>
@endsection
