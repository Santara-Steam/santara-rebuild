<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header;
use Google\Cloud\Storage\StorageClient;

class HeaderController extends Controller
{
    
    public function index()
    {
        $headers = Header::where('status', 1)->get();
        return view('admin.cms.header.index', compact('headers'));
    }

    public function create()
    {
        return view('admin.cms.header.add');
    }

    public function edit($id)
    {
        $header = Header::find($id);
        return view('admin.cms.header.edit', compact('header'));
    }

    public function store(Request $request)
    { 
        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);
        $filePicture = fopen($request->file('pictures')->getPathName(), 'r');
        $newFolderName = 'santara.co.id/header';
        $pictures = $newFolderName.'/'.$request->file('pictures')->getClientOriginalName();
        $bucket->upload($filePicture, [
            'predefinedAcl' => 'publicRead',
            'name' => $pictures
        ]);

        $fileMobile = fopen($request->file('mobile')->getPathName(), 'r');
        $mobile = $newFolderName.'/'.$request->file('mobile')->getClientOriginalName();
        $bucket->upload($fileMobile, [
            'predefinedAcl' => 'publicRead',
            'name' => $mobile
        ]);

        $header = new Header();
        $header->title = $request->title;
        $header->pictures = $request->file('pictures')->getClientOriginalName();
        $header->mobile = $request->file('mobile')->getClientOriginalName();
        $header->redirection = $request->redirection;
        $header->status = 1;
        $header->save();
        $notif = array(
            'message' => 'Berhasil menambahkan kategori',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/header')->with($notif);
    }

    public function update(Request $request, $id)
    {
        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);
        $newFolderName = 'santara.co.id/header';

        $header = Header::find($id);
        $header->title = $request->title;
        if($request->hasFile('pictures')){
            $filePicture = fopen($request->file('pictures')->getPathName(), 'r');
            $pictures = $newFolderName.'/'.$request->file('pictures')->getClientOriginalName();
            $bucket->upload($filePicture, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);
            $header->pictures = $request->file('pictures')->getClientOriginalName();
        }
        if($request->hasFile('mobile')){
            $fileMobile = fopen($request->file('mobile')->getPathName(), 'r');
            $mobile = $newFolderName.'/'.$request->file('mobile')->getClientOriginalName();
            $bucket->upload($fileMobile, [
                'predefinedAcl' => 'publicRead',
                'name' => $mobile
            ]);
            $header->mobile = $request->file('mobile')->getClientOriginalName();
        }
        $header->redirection = $request->redirection;
        $header->status = 1;
        $header->save();
        $notif = array(
            'message' => 'Berhasil mengubah kategori',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/header')->with($notif);
    }

    public function destroy($id)
    {
        $header = Header::find($id);
        \File::delete(public_path('headers/'.$header->pictures));
        $header->status = 0;
        $header->save();
    }

}
