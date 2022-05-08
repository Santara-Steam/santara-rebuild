<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supporters;
use Google\Cloud\Storage\StorageClient;

class SupportersController extends Controller
{
    
    public function index()
    {
        $supporters = Supporters::where('name', '<>', 'ojk')
            ->where('status', 1)
            ->get();
        return view('admin.cms.supporters.index', compact('supporters'));
    }

    public function create()
    {
        return view('admin.cms.supporters.add');
    }

    public function edit($id)
    {
        $supporter = Supporters::find($id);
        return view('admin.cms.supporters.edit', compact('supporter'));
    }

    public function store(Request $request)
    {
        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);
        $fileSource = fopen($request->file('logo')->getPathName(), 'r');
        $newFolderName = 'santara.co.id/supporter';
        $googleCloudStoragePath = $newFolderName.'/'.$request->file('logo')->getClientOriginalName();
        $bucket->upload($fileSource, [
            'predefinedAcl' => 'publicRead',
            'name' => $googleCloudStoragePath
        ]);

        $supporter = new Supporters();
        $supporter->name = $request->name;
        $supporter->link = $request->link;
        $supporter->status = 1;
        $supporter->logo = $request->file('logo')->getClientOriginalName();
        $supporter->save();
        $notif = array(
            'message' => 'Berhasil menambahkan supporter',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/supporter')->with($notif);
    
    }

    public function update(Request $request, $id)
    {
        $supporter = Supporters::find($id);
        if($request->hasFile('logo')){
            $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
            $bucket = $storage->bucket($storageBucketName);
            $fileSource = fopen($request->file('logo')->getPathName(), 'r');
            $newFolderName = 'santara.co.id/supporter';
            $googleCloudStoragePath = $newFolderName.'/'.$request->file('logo')->getClientOriginalName();
            $bucket->upload($fileSource, [
                'predefinedAcl' => 'publicRead',
                'name' => $googleCloudStoragePath
            ]);
            $supporter->logo = $request->file('logo')->getClientOriginalName();
        }
        $supporter->name = $request->name;
        $supporter->link = $request->link;
        $supporter->save();
        $notif = array(
            'message' => 'Berhasil mengubah supporter',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/supporter')->with($notif);
    }

    public function destroy($id)
    {
        $supporter = Supporters::find($id);
        $supporter->status = 0;
        $supporter->save();
        echo json_encode(['msg' => 200]);
    }


}
