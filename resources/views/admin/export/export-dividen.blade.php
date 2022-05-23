<table>
    <tr>
        <th colspan="6">
            Data Dividen {{ tgl_indo(date('Y-m-d', strtotime($tglAwal))) }} Sampai {{ tgl_indo(date('Y-m-d', strtotime($tglAkhir))) }}
        </th>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Member</th>
            <th>Date Dividen</th>
            <th>Total</th>
            <th>Availability</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 0; @endphp
        @foreach ($devidens as $row)
            @php $no++; @endphp
            @php 
                $bankName = "";
                $rekening = "";
                if($row->bank != null){
                    $bankName = $row->bank;
                }else{
                    $bankName = "-";
                }

                if($row->account_number != null){
                    $rekening = $row->account_number;
                }else{
                    $rekening = "-";
                }

                $pencairan = 'Belum Dicairkan';

                if ($row->status == 0) {
                    $status = 'Tersedia';
                } elseif ($row->status == 1) {
                    $status = '';
                } elseif ($row->status == 2) {
                    $status = 'Terverifikasi';
                    $pencairan = ($row->deposit_id != null) ? 'Wallet' : (($row->channel == 'Dana') ? 'Dana' : 'Rekening');
                    if ($row->channel == 'DANA') {
                        $pencairan = 'DANA';
                    }
                } elseif ($row->status == 3) {
                    $status = 'Ditolak';
                } else {
                    $status = 'Undefined';
                    $pencairan = '-';
                }
            @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>ID : {{ $row->external_id }} <br style="mso-data-placement:same-cell;" />
                    {{ $row->name }} <br style="mso-data-placement:same-cell;" />
                    {{ $row->email }} <br style="mso-data-placement:same-cell;" />
                    {{ $row->phone }} <br style="mso-data-placement:same-cell;" />
                    {{ $bankName }} <br style="mso-data-placement:same-cell;" />
                    {{ $rekening }}
                </td>
                <td>
                    {{ tgl_indo(date('Y-m-d', strtotime($row->updated_at))).formatJam($row->updated_at) }}
                </td>
                <td>
                    {{ rupiahBiasa($row->devidend) }}
                </td>
                <td>
                    {{ $pencairan }}
                </td>
                <td>{{ $status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>