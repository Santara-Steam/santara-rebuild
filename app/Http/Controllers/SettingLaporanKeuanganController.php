<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialReportSetting;
use Google\Cloud\Storage\StorageClient;

class SettingLaporanKeuanganController extends Controller
{

    public function index()
    {
        $tutor = FinancialReportSetting::first();
        return view('admin.setting-tutor.index', compact('tutor'));
    }

    public function store(Request $request)
    {
        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);
        $folderName = 'santara.co.id/images/content';
        
        if($request->id != ""){
            $tutor = FinancialReportSetting::find($request->id);
        }else{
            $tutor = new FinancialReportSetting();
        }

        $tutor->name = 'Tutorial';
        $tutor->group = $request->group;
        if($request->group == 'document'){
            $fileDokumen = fopen($request->file('document')->getPathName(), 'r');
            $dokumenFileSave = 'documen-tutor-keu'.time().'.pdf';
            $fileDokumen = $folderName.'/'.$dokumenFileSave;
            $bucket->upload($fileDokumen, [
                'predefinedAcl' => 'publicRead',
                'name' => $fileDokumen
            ]);
            $tutor->value = $dokumenFileSave;
        }else{
            $tutor->value = $request->value;
        }
        $tutor->is_deleted = 0;
        $tutor->save();

        $notif = array(
            'message' => 'Berhasil menambahkan tutorial laporan keuangan',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notif);

    }



}
