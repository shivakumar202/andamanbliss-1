<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google Business Accounts</title>
</head>
<body>
    <h2>Google Business Accounts</h2>

    @forelse($accounts as $account)
        <div style="margin-bottom: 15px;">
            <strong>{{ $account['accountName'] ?? 'Unnamed Account' }}</strong><br>
            Account ID: {{ str_replace('accounts/', '', $account['name']) }}<br>
            <a href="{{ route('google.locations', str_replace('accounts/', '', $account['name'])) }}">
                View Locations
            </a>
        </div>
    @empty
        <p>No accounts found.</p>
    @endforelse
</body>
</html>
