<table>
    <thead>
        <tr>
            <th colspan="7">
                Data Transaksi Rentang Waktu {{ tgl_indo(date('Y-m-d', strtotime($tglAwal))) }} Sampai {{ tgl_indo(date('Y-m-d', strtotime($tglAkhir))) }}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Transaksi</th>
            <th>Member</th>
            <th>Created At</th>
            <th>Total (RP)</th>
            <th>Split Fee</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0; 
        foreach($transactions as $row){
            $no++;
            $idTransaksi = "";
            $stock = 0;
            $stock_price = 0;
            if($row->transaction_no != null){
                $idTransaksi = $row->transaction_no;
            }else{
                $idTransaksi = $row->transaction_serial;
            }

            if($row->channel == "MARKET"){
                $market = App\Models\Markets::where('transaction_id', $row->id)
                    ->select('stock', 'stock_price')
                    ->first();
                if($market != null){
                    $stock = $market->stock;
                    $stock_price = $market->stock_price;
                }
            }

            if($row->status == 'CREATED'){
                $status = "Belum Konfirmasi";
            }elseif($row->status == 'WAITING FOR VERIFICATION'){
				$status = "Menunggu Konfirmasi";
            }elseif ($row->status == 'VERIFIED') {
                $status = "Lunas";
            }elseif ($row->status == 'EXPIRED'){
				$status = "Kadaluarsa";
            }else{
				$status = "Belum Konfirmasi";
            }
        ?>
        <tr>
            <td><?= $no ?></td>
            <td>
                ID : <?= $idTransaksi ?> <br style="mso-data-placement:same-cell;" />
                Token : <?= $row->code_emiten ?> <br style="mso-data-placement:same-cell;" />
                Price : <?= rupiahBiasa($row->stock_price) ?> <br style="mso-data-placement:same-cell;" />
                Qty : <?= $stock ?>
            </td>
            <td>
                <?= $row->trader_name ?>  <br style="mso-data-placement:same-cell;" />
                <?= $row->user_email ?>  <br style="mso-data-placement:same-cell;" />
                <?= $row->phone ?>
            </td>
            <td>
                <?= tgl_indo(date('Y-m-d', strtotime($row->created_at))).' '.formatJam($row->created_at) ?>
            </td>
            <td>
                <?= rupiahBiasa($row->amount) ?>
            </td>
            <td>
                <?= rupiah($row->split_fee) ?>
            </td>
            <td>
                <?= $status ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>