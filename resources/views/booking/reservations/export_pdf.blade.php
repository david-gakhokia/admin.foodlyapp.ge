<h2>Reservation Export Report</h2>
<table border="1" width="100%" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Type</th>
            <th>Restaurant</th>
            <th>Place</th>
            <th>Table</th>
            <th>Date</th>
            <th>Time</th>
            <th>Name</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservations as $res)
            <tr>
                <td>{{ ucfirst($res->type) }}</td>
                <td>{{ optional($res->restaurant)->name }}</td>
                <td>{{ optional($res->place)->name }}</td>
                <td>{{ optional($res->table)->name }}</td>
                <td>{{ $res->reservation_date }}</td>
                <td>{{ $res->reservation_time }}</td>
                <td>{{ $res->name }}</td>
                <td>{{ $res->phone }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
