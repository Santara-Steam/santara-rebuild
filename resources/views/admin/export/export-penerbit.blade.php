<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Penerbit</th>
            <th>Tanggal Listing</th>
            <th>Dana</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 0; @endphp
        @foreach($emiten as $row)
            @php $no++; @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $row->code_emiten }}</td>
                <td>{{ $row->trademark.' '.$row->company_name }}</td>
                <td>{{ tgl_indo(date('Y-m-d', strtotime($row->begin_period))) }}</td>
                <td>{{ rupiahBiasa($row->total) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>