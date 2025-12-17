<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Cancelled Payment</title>
</head>

<body>
    <h2>Dear Admin, </h2>

    <p style="align-content: justify;">This is to inform you that the guest has initiated the booking process for the <strong>{{$package_name}}</strong> tour package through our website by selecting their preferred hotel, ferry and cab options.</p>
    <p style="align-content: justify;">However, the payment process failed just before completion, and no payment has been received. Therefore, the booking has not been confirmed at this stage.</p>
    <p>Please find the guest details below for your reference:</p>

    <p>Package: {{ ucwords($package_name) }}</p>
    <p>Name: {{ucwords($guest_name)}}</p>
    <p>Email: {{$email}}</p>
    <p>Phone Number: {{$contact}}</p>
    <h3>Traveller(s)</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pax as $p)
            <tr>
                <td>{{$p->prefix }} {{ $p->name . ' ' . $p->m_name . ' ' . $p->last_name }}</td>
                <td>{{$p->age}}</td>
                <td>{{$p->gender}}</td>
                <td>{{ $p->age > 2 ? 'Adult' : 'Infant' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>



    <p>Warm regards,<br>
        Andaman Bliss Team</p>

</body>

</html>