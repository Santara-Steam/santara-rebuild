<?php

function formatJam($tanggal) {
   return date("H:i", strtotime($tanggal));
}

function formatJamLengkap($tanggal) {
	return date("H:i:s", strtotime($tanggal));
}

function formatTanggalJamSistem($tanggal) {
	return date("Y-m-d H:i:s", strtotime($tanggal));
}

function removeTgl000($tgl){
	return str_replace(" 00:00:00", "", $tgl);
}

function tgl_indo($tanggal){
	$bulan = array (
		1 => 'Januari',
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
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}