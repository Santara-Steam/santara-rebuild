<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialReportSetting;

class SettingLaporanKeuanganController extends Controller
{

    public function index()
    {
        return view('admin.setting-tutor.index');
    }



}
