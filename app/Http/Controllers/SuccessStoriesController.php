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
        // $storage = new StorageClient([
		// 	'keyFilePath' => 'santara-cloud-1261a9724a56.json',
		// 	'projectId' => 'santara-cloud'
		// ]);
        // $bucket = $storage->bucket(env('STORAGE_GOOGLE_BUCKET'));
        // $uploadPicture = $bucket->upload(
        //     file_get_contents($request->file('image')->getPathName()),
        //     [
        //         'name' => "santara.co.id/success_story/" . $request->file('image')->getClientOriginalName()
        //     ]
        // );
        // $uploadPicture->acl()->add('allUsers', 'READER');

        $image = time().'.'.$request->image->extension();  
        $request->image->move(public_path('testimoni'), $image);
    
        $successStories = new SuccessStories();
        $successStories->title = $request->title;
        $successStories->subtitle = $request->subtitle;
        $successStories->description = $request->description;
        //$successStories->image = $request->file('image')->getClientOriginalName();
        $successStories->image = $image;
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
            \File::delete(public_path('testimoni/'.$successStories->image));
            $image = time().'.'.$request->image->extension();  
            $request->image->move(public_path('testimoni'), $image);
            $successStories->image = $image;
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
        \File::delete(public_path('testimoni/'.$successStories->image));
        $successStories->status = 0;
        $successStories->save();
    }

}
