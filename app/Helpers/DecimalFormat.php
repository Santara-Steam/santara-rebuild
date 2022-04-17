<?php

function decimalFormat($angka) {
    return number_format($angka, 0, ',', '.');
}