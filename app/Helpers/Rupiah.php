<?php

function rupiah($angka) {
    $hasil_rupiah = '<div class="row justify-content-between ml-1 mr-1"><span>Rp</span>' . '<span>'.number_format($angka,2,',','.').'</span></div>';
    $hasil_rupiah = str_replace(",00","",$hasil_rupiah);
	return $hasil_rupiah;
}

function rupiahBiasa($angka){
    $hasil_rupiah = number_format($angka,2,',','.');
    $hasil_rupiah = str_replace(",00","",$hasil_rupiah);
	return 'Rp '.$hasil_rupiah;
}