<?php 
function month($date){
    $month = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

$exp = explode('-', $date);
 
return $exp[2] . ' ' . $month[ (int)$exp[1] ] . ' ' . $exp[0];
}
?>