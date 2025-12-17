<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google Business Locations</title>
</head>
<body>
    <h2>Locations for Selected Account</h2>

    @forelse($locations as $loc)
        <div style="margin-bottom: 15px;">
            <strong>{{ $loc['title'] ?? 'Unnamed Location' }}</strong><br>
            Location ID: {{ str_replace('accounts/'.explode('/', $loc['name'])[1].'/locations/', '', $loc['name']) }}<br>
            <a href="{{ route('google.reviews') }}">
                View Reviews (use this Location ID)
            </a>
        </div>
    @empty
        <p>No locations found.</p>
    @endforelse
</body>
</html>
