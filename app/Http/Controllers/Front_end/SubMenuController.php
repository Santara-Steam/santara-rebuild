<?php

namespace App\Http\Controllers\Front_end;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SantaraVideos;

class SubMenuController extends Controller
{
    public function tentang()
    {
        return view('front_end/sub_menu/tentang');
    }
    public function testimoni()
    {
        return view('front_end/sub_menu/testimoni');
    }
    public function pemodal()
    {
        return view('front_end/sub_menu/pemodal');
    }
    public function penerbit()
    {
        return view('front_end/sub_menu/penerbit');
    }
    public function support()
    {
        return view('front_end/sub_menu/support');
    }
    public function kontak()
    {
        return view('front_end/sub_menu/kontak');
    }
    public function pertanyaan()
    {
        return view('front_end/sub_menu/pertanyaan');
    }

    public function video()
    {
        $santaraVideos = SantaraVideos::join('santara_video_categories as svc', 'svc.id', '=', 'santara_videos.category')
            ->leftJoin('santara_video_histories as svh', 'svh.santara_video_id', '=','santara_videos.id')
            ->where('santara_videos.is_deleted', 0)
            ->orWhere('svh.is_deleted', 0)
            ->select('santara_videos.uuid', 'santara_videos.title', 'santara_videos.description', 'santara_videos.link','svc.category', 
                \DB::raw('coalesce(sum(svh.status = "like"), 0) as likes'),
                \DB::raw('coalesce(sum(svh.status = "dislike"), 0) as dislikes'),
                \DB::raw('coalesce(sum(svh.status = "view"), 0) as views'),
                'santara_videos.is_actived', 'santara_videos.created_at')
            ->groupBy('santara_videos.uuid')
            ->orderBy('santara_videos.created_at', 'DESC')
            ->get();
            
        return view('front_end/sub_menu/video', compact('santaraVideos'));
    }
}
