<?php

function rupiah($angka) {
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    $hasil_rupiah = str_replace(",00","",$hasil_rupiah);
	return $hasil_rupiah;
}