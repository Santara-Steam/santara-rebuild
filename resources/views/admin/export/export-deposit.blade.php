<table>
    <thead>
        <tr>
            <th colspan="7">
                Data Penarikan Rentang Waktu {{ tgl_indo(date('Y-m-d', strtotime($tglAwal))) }} Sampai {{ tgl_indo(date('Y-m-d', strtotime($tglAkhir))) }}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Member</th>
            <th>Created</th>
            <th>Payment</th>
            <th>Nominal</th>
            <th>Split Fee</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php $no = 0; 
        foreach($deposit as $row){
            $no++;
            $bank_to = '-';
            $bank_from = '-';
            $account_number = '-';
            if($row->channel){
                if($row->channel == 'VA' || isset($row->virtual_account)) {
                    $channel        = 'Virtual Account';
                    $account_number = $row->va_account_number;
                    $bank_to        = $row->va_bank;
                }elseif($row->channel == 'BANKTRANSFER') {
                    $channel        = 'Bank Transfer';
                    $bank_from      = $row->bank_from;
                    $account_number = $row->account_number;

                    switch($row->bank_to) {
                        case 1:
                            $bank_to = 'BCA';
                            break;
                        case 2:
                            $bank_to = 'MANDIRI';
                            break;
                        case 3:
                            $bank_to = 'BRI';
                            break;
                        default:
                            $bank_to = '-';
                            break;
                    }
                }elseif($row->channel == 'DANA') {
                    $channel = 'DANA';
                }elseif($row->channel == 'ONEPAY') {
                    $channel = 'Other Payment (ONEPAY)';
                }else{
                    $channel = 'Bank Transfer';
                }
            }else{
                $channel = $row->created_by;
            }

            $status = "";
            if($row->status == 1){
                $status = 'Sudah';
            }else if($row->status == 2){
                $status = 'Ditolak';
            }else{
                $status = 'Menunggu Pembayaran';
            }
    ?>
        <tr>
            <td><?= $no ?></td>
            <td>
                ID : <?= $row->transaction_no ?>  <br style="mso-data-placement:same-cell;" />
                <?= $row->trader_name ?>  <br style="mso-data-placement:same-cell;" />
                <?= $row->email ?>  <br style="mso-data-placement:same-cell;" />
                <?= $row->phone ?> 
            </td>
            <td>
                <?= tgl_indo(date('Y-m-d', strtotime($row->created_at))).' '.formatJam($row->created_at) ?>
            </td>
            <td>
                Method : <?= $channel ?> <br style="mso-data-placement:same-cell;" />
                Sender : <?= $bank_from ?> <br style="mso-data-placement:same-cell;" />
                Receiver : <?= $bank_to ?> <br style="mso-data-placement:same-cell;" />
                Acount : <?= $account_number ?>
            </td>
            <td>
                <?= rupiahBiasa($row->amount + $row->fee) ?>
            </td>
            <td><?= rupiahBiasa($row->split_fee) ?></td>
            <td>
                <?= $status ?>
            </td>
        </tr>
    <?php   } ?>
         
    </tbody>
</table>