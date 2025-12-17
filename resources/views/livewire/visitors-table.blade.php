<div>
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text"
                   class="form-control"
                   placeholder="Search URL"
                   wire:model.live.debounce.300ms="search">
        </div>

       

        <div class="col-md-3">
            <select class="form-control" wire:model.live="perPage">
                <option value="5">5 Rows</option>
                <option value="10">10 Rows</option>
                <option value="25">25 Rows</option>
                <option value="50">50 Rows</option>
                <option value="100">100 Rows</option>
            </select>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th wire:click="sortBy('url')" style="cursor:pointer">
                    URL
                    @if($sortField=='url') {!! $sortDirection=='asc'?'&#9650;':'&#9660;' !!} @endif
                </th>

                <th wire:click="sortBy('total_visits')" style="cursor:pointer">
                    Total Visits
                    @if($sortField=='total_visits') {!! $sortDirection=='asc'?'&#9650;':'&#9660;' !!} @endif
                </th>

                <th wire:click="sortBy('unique_visitors')" style="cursor:pointer">
                    Unique Visitors
                    @if($sortField=='unique_visitors') {!! $sortDirection=='asc'?'&#9650;':'&#9660;' !!} @endif
                </th>

                <th wire:click="sortBy('top_country')" style="cursor:pointer">
                    Top State
                    @if($sortField=='top_country') {!! $sortDirection=='asc'?'&#9650;':'&#9660;' !!} @endif
                </th>

                <th wire:click="sortBy('top_city')" style="cursor:pointer">
                    Top City
                    @if($sortField=='top_city') {!! $sortDirection=='asc'?'&#9650;':'&#9660;' !!} @endif
                </th>

                <th wire:click="sortBy('total_duration')" style="cursor:pointer">
                    Total Duration
                    @if($sortField=='total_duration') {!! $sortDirection=='asc'?'&#9650;':'&#9660;' !!} @endif
                </th>

                <th wire:click="sortBy('avg_duration')" style="cursor:pointer">
                    Avg Duration
                    @if($sortField=='avg_duration') {!! $sortDirection=='asc'?'&#9650;':'&#9660;' !!} @endif
                </th>
                <th wire:click="sortBy('last_visited')" style="cursor:pointer">
                    Last Visited
                    @if($sortField=='last_visited') {!! $sortDirection=='asc'?'&#9650;':'&#9660;' !!} @endif
                </th>
            </tr>
        </thead>

        <tbody>
        @foreach($stats as $row)
            <tr>
                <td>{{ $row->url }}</td>
                <td>{{ $row->total_visits }}</td>
                <td>{{ $row->unique_visitors }}</td>
                <td>{{ $row->top_country }}</td>
                <td>{{ $row->top_city }}</td>
                <td>{{ Carbon\CarbonInterval::seconds($row->total_duration)->cascade() }}</td>
                <td>{{ Carbon\CarbonInterval::seconds($row->avg_duration)->cascade() }}</td>
                <td>{{ Carbon\Carbon::parse($row->last_visited)->format('d-m-Y, H:i A') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $stats->links() }}
</div>
