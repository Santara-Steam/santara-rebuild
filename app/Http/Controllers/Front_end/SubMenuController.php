<?php

namespace App\Http\Controllers\Front_end;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
