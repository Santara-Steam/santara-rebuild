<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 0; @endphp
        @foreach($user as $row)
            @php $no++; @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ $row->role }}</td>
                <td>{{ $row->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>