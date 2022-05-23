<table>
    <tr>
        <th colspan="6">
            Data Penarikan Rentang Waktu {{ tgl_indo(date('Y-m-d', strtotime($tglAwal))) }} Sampai {{ tgl_indo(date('Y-m-d', strtotime($tglAkhir))) }}
        </th>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Member</th>
            <th>Created</th>
            <th>Amount</th>
            <th>Split Fee</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 0; @endphp
        @foreach ($withdraws as $row)
            @php $no++; @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>
                    {{ $row->external_id }} <br style="mso-data-placement:same-cell;" />
                    {{ $row->trader_name }} <br style="mso-data-placement:same-cell;" />
                    {{ $row->email }} <br style="mso-data-placement:same-cell;" />
                    {{ $row->phone }} <br style="mso-data-placement:same-cell;" />
                    {{ $row->bank_to }}
                </td>
                <td>
                    {{ tgl_indo(date('Y-m-d', strtotime($row->created_at))) }} <br
                        style="mso-data-placement:same-cell;" />
                    {{ formatJam($row->created_at) }}
                </td>
                <td>Withdrawal : {{ rupiahbiasa($row->amount) }}<br style="mso-data-placement:same-cell;" />
                    Fee : {{ rupiahbiasa($row->fee) }}<br style="mso-data-placement:same-cell;" />
                    Total : {{ rupiahbiasa($row->amount - $row->fee) }}</td>
                <td>
                    {{ rupiahbiasa($row->split_fee) }}
                </td>
                <td>
                    @if ($row->is_verified == 2)
                        Ditolak
                    @elseif($row->is_verified == 1)
                        Sudah Verifikasi
                    @else
                        Tidak Diketahui
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
