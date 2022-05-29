<table>
    <thead>
        <tr>
            <th colspan="9">
                Data User Rentang Waktu Pendaftaran {{ tgl_indo(date('Y-m-d', strtotime($tglAwal))) }} Sampai
                {{ tgl_indo(date('Y-m-d', strtotime($tglAkhir))) }}</th>
        </tr>
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
        @foreach ($user as $row)
            @php $no++; @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ ($row->gender == 'm' ? 'Laki-Laki' : $row->gender == 'f') ? 'Perempuan' : 'Tidak Diketahui' }}
                </td>
                <td>
                    @if($row->birth_place != null && $row->birth_date != null)
                        @if($row->tempat_lahir == null)
                            {{ $row->birth_place . ', ' . tgl_indo(date('Y-m-d', strtotime($row->birth_date))) }}
                        @else 
                            {{ $row->tempat_lahir . ', ' . tgl_indo(date('Y-m-d', strtotime($row->birth_date))) }}
                        @endif
                    @else
                        -
                    @endif
                </td>
                <td>{{ $row->job }}</td>
                <td>{{ $row->bank }}</td>
                <td>{{ $row->account_number1 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
