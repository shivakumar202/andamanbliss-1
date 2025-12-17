<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferry Tickets</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @foreach ($details as $trip)
        @if (in_array($trip['booking']->ferry, ['Makruzz', 'Makruzz Gold', 'Makruzz Pearl']))
            <div class="makruzz">
                @include('tickets.makruzz', ['trip' => $trip])
            </div>
        @endif
        @if (in_array($trip['booking']->ferry, ['Nautika Seaways', 'Nautika']))
            <div class="nautika">
                @include('tickets.nautika', ['trip' => $trip])
            </div>
        @endif

        @if (in_array($trip['booking']->ferry, ['Green Ocean 1', 'Green Ocean 2']))
            <div class="greenocean">
                @include('tickets.greenocean', ['trip' => $trip])
            </div>
        @endif

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach


</body>

</html>
