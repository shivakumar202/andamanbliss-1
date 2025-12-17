<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Visit;

class VisitorsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $sortField = 'total_visits';
    public $sortDirection = 'desc';
    public $countryFilter = '';
    public $cityFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'countryFilter' => ['except' => ''],
        'cityFilter' => ['except' => ''],
        'sortField' => ['except' => 'total_visits'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 5],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatedCountryFilter() { $this->cityFilter = ''; $this->resetPage(); }
    public function updatedCityFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
        $this->resetPage();
    }

    public function render()
    {
        $countries = Visit::select('country')
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByRaw('COUNT(*) DESC')
            ->pluck('country');

        $cities = Visit::select('city')
            ->when($this->countryFilter, fn($q) => $q->where('country', $this->countryFilter))
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderByRaw('COUNT(*) DESC')
            ->pluck('city');

        $stats = Visit::select(
            DB::raw('TRIM(url) as url'),
            DB::raw('COUNT(*) as total_visits'),
            DB::raw('COUNT(DISTINCT ip) as unique_visitors'),
            DB::raw('SUM(duration) as total_duration'),
            DB::raw('MAX(created_at) as last_visited'),
            DB::raw('AVG(duration) as avg_duration'),
            DB::raw('(SELECT country FROM visits v2 
                      WHERE v2.url = visits.url 
                      AND v2.country IS NOT NULL
                      GROUP BY country 
                      ORDER BY COUNT(*) DESC 
                      LIMIT 1) AS top_country'),
            DB::raw('(SELECT city FROM visits v3 
                      WHERE v3.url = visits.url 
                      AND v3.city IS NOT NULL
                      GROUP BY city 
                      ORDER BY COUNT(*) DESC 
                      LIMIT 1) AS top_city')
        )
            ->when($this->search, fn($q) =>
                $q->whereRaw("TRIM(url) LIKE ?", ["%{$this->search}%"])
            )
            ->when($this->countryFilter, fn($q) =>
                $q->where('country', $this->countryFilter)
            )
            ->when($this->cityFilter, fn($q) =>
                $q->where('city', $this->cityFilter)
            )
            ->groupBy('url')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.visitors-table', compact('stats', 'countries', 'cities'));
    }
}
