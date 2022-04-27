<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SantaraVideos;

class SantaraVideosController extends Controller
{
    
    public function index()
    {
        $santaraVideos = SantaraVideos::join('santara_video_categories as svc', 'svc.id', '=', 'santara_videos.category')
            ->leftJoin('santara_video_histories as svh', 'svh.santara_video_id', '=','santara_videos.id')
            ->where('santara_videos.is_deleted', 0)
            ->orWhere('svh.is_deleted', 0)
            ->select('santara_videos.uuid', 'santara_videos.title', 'svc.category', 
                \DB::raw('coalesce(sum(svh.status = "like"), 0) as likes'),
                \DB::raw('coalesce(sum(svh.status = "dislike"), 0) as dislikes'),
                \DB::raw('coalesce(sum(svh.status = "view"), 0) as views'),
                'santara_videos.is_actived', 'santara_videos.created_at')
            ->groupBy('santara_videos.uuid')
            ->orderBy('santara_videos.created_at', 'DESC')
            ->get();
        return view('admin.cms.video.index', compact('santaraVideos'));
    }

    public function create()
    {
        $categories = $this->categories();
        return view('admin.cms.video.add', compact('categories'));
    }

    public function edit($uuid)
    {
        $categories = $this->categories();
        $santaraVideo = SantaraVideos::where('santara_videos.uuid', $uuid)
            ->first();
        return view('admin.cms.video.edit', compact('santaraVideo', 'categories'));
    }

    private function categories() {
        $categories = null;

        try {
            $client = new \GuzzleHttp\Client();
	
            $headers = [
                'Authorization' => 'Bearer ' . app('request')->session()->get('token'),        
                'Accept'        => 'application/json',
                'Content-type'  => 'application/json'
            ];          

            $response = $client->request('GET', config('global.BASE_API_CLIENT_URL').'/'.config('global.API_CLIENT_VERSION') . '/videos/category', [
                'headers' => $headers,
			]);


            if ( $response->getStatusCode() == 200 ) {
                $categories = json_decode($response->getBody()->getContents(), TRUE); 
            }

        } catch (\Exception $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
        }	
        
        return $categories;
    }

    public function saveData(Request $request)
    {
        $url = ($request->uuid == '') ? '/videos/add-video' : '/videos/update-video/'. $request->uuid;
        $method = ($request->uuid == '') ? 'POST' : 'PUT';
        $message = ($request->uuid == '') ? 'Berhasil menambahkan video' : 'Berhasil mengubah video';
        try {
            $client = new \GuzzleHttp\Client();       

            $response = $client->request($method, config('global.BASE_API_CLIENT_URL').'/'.config('global.API_CLIENT_VERSION').$url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . app('request')->session()->get('token')
                ],
                'multipart' => [
                    [
                        'name' => 'title',
                        'contents' => $request->title
                    ],                        
                    [
                        'name' => 'category',
                        'contents' => $request->category
                    ],
                    [
                        'name' => 'description',
                        'contents' => $request->description
                    ],
                    [
                        'name' => 'link',
                        'contents' => $request->link
                    ]
                ]
            ]);
            
            $notif = array(
                'message' => $message,
                'alert-type' => 'success'
            );
            return redirect('admin/cms/video')->with($notif);

        } catch (\Exception $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            echo json_encode(['msg' => $statusCode]);         
        }
    }

    public function destroy($uuid)
    {
        return SantaraVideos::where('uuid', $uuid)->update([
            'is_deleted' => 1
        ]);
    }

    public function setStatus($uuid, $status)
    {
        return SantaraVideos::where('uuid', $uuid)->update([
            'is_actived' => $status
        ]);
    }

}
