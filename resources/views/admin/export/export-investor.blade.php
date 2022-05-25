<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Pekerjaan</th>
            <th>Bank</th>
            <th>Account Number</th>
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
                <td>{{ $row->gender == "m" ? "Laki-Laki" : $row->gender == "f" ? "Perempuan" : "Tidak Diketahui" }}</td>
                <td>{{ $row->birth_place.', '.tgl_indo($row->birth_date) }}</td>
                <td>{{ $row->job }}</td>
                <td>{{ $row->bank }}</td>
                <td>{{ $row->account_number1 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>