<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoCategory;

class KategoriVideoController extends Controller
{
    
    public function index()
    {
        $kategoriVideo = VideoCategory::where('is_deleted', 0)
            ->select('category', 'created_at', 'updated_at', 'uuid')
            ->get();
        return view('admin.cms.video_category.index', compact('kategoriVideo'));
    }

    public function create()
    {
        return view('admin.cms.video_category.add');
    }

    public function edit($id)
    {
        $kategoriVideo = VideoCategory::where('uuid',$id)->first();
        return view('admin.cms.video_category.edit', compact('kategoriVideo'));
    }

    public function saveData(Request $request)
    {
            $url = ($request->uuid == '') ? '/videos/add-category' : '/videos/update-category/'. $request->uuid;
            $method = ($request->uuid == '') ? 'POST' : 'PUT';
            $message = ($request->uuid == '') ? 'Berhasil menambahkan kategori video' : 'Berhasil mengubah kategori video';
            try {
                $client = new \GuzzleHttp\Client();       

                $response = $client->request($method, config('global.BASE_API_CLIENT_URL').'/'.config('global.API_CLIENT_VERSION').$url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . app('request')->session()->get('token')
                    ],
                    'multipart' => [
                        [
                            'name' => 'category',
                            'contents' => $request->category
                        ]
                    ]
                ]);
                
                $notif = array(
                    'message' => $message,
                    'alert-type' => 'success'
                );
                return redirect('admin/cms/video-category')->with($notif);

            } catch (\Exception $exception) {
                $statusCode = $exception->getResponse()->getStatusCode();
                echo json_encode(['msg' => $statusCode]);         
            }
    }

    public function destroy($uuid){
        return VideoCategory::where('uuid', $uuid)->update([
            'is_deleted' => 1
        ]);
    }

}
