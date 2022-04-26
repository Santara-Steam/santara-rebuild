<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuccessStories;
use Google\Cloud\Storage\StorageClient;

class SuccessStoriesController extends Controller
{
    
    public function index()
    {
        $successStories = SuccessStories::where('status', 1)->get();
        return view('admin.cms.success_stories.index', compact('successStories'));
    }

    public function create()
    {
        return view('admin.cms.success_stories.add');
    }

    public function edit($id)
    {
        $testimoni = SuccessStories::find($id);
        return view('admin.cms.success_stories.edit', compact('testimoni'));
    }

    public function store(Request $request)
    {
        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);
        $fileSource = fopen($request->file('image')->getPathName(), 'r');
        $newFolderName = 'santara.co.id/success_story';
        $googleCloudStoragePath = $newFolderName.'/'.$request->file('image')->getClientOriginalName();
        $bucket->upload($fileSource, [
            'predefinedAcl' => 'publicRead',
            'name' => $googleCloudStoragePath
        ]);
    
        $successStories = new SuccessStories();
        $successStories->title = $request->title;
        $successStories->subtitle = $request->subtitle;
        $successStories->description = $request->description;
        $successStories->image = $request->file('image')->getClientOriginalName();
        $successStories->save();
        $notif = array(
            'message' => 'Berhasil menambahkan testimoni',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/testimoni')->with($notif);
    }

    public function update(Request $request, $id)
    {
        $successStories = SuccessStories::find($id);
        $successStories->title = $request->title;
        $successStories->subtitle = $request->subtitle;
        $successStories->description = $request->description;
        if($request->hasFile('image')){
            $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
            $bucket = $storage->bucket($storageBucketName);
            $fileSource = fopen($request->file('image')->getPathName(), 'r');
            $newFolderName = 'santara.co.id/success_story';
            $googleCloudStoragePath = $newFolderName.'/'.$request->file('image')->getClientOriginalName();
            $bucket->upload($fileSource, [
                'predefinedAcl' => 'publicRead',
                'name' => $googleCloudStoragePath
            ]);
            $successStories->image = $request->file('image')->getClientOriginalName();
        }
        $successStories->save();
        $notif = array(
            'message' => 'Berhasil menambahkan testimoni',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/testimoni')->with($notif);
    }

    public function destroy($id)
    {
        $successStories = SuccessStories::find($id);
        $successStories->status = 0;
        $successStories->save();
        echo json_encode(['msg' => 200]); 
    }

}
