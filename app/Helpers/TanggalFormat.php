<?php

function formatHariJam($tanggal) {
   return date('d M Y', strtotime($tanggal)).' '.date("H:i", strtotime($tanggal));
}