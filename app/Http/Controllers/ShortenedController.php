<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shortened;

class ShortenedController extends Controller
{
    
    public function index()
    {
        $shorteneds = Shortened::all();
        return view('admin.cms.shortened.index', compact('shorteneds'));
    }

    public function create()
    {
        return view('admin.cms.shortened.add');
    }

    public function edit($id)
    {
        $shortened = Shortened::find($id);
        return view('admin.cms.shortened.edit', compact('shortened'));
    }

    public function store(Request $request)
    {
        $shortened = new Shortened();
        $shortened->uuid = \Str::uuid();
        $shortened->title = $request->title;
        $shortened->link = $request->link;
        $shortened->url = $request->url;
        $shortened->status = 1;
        $shortened->save();
        $notif = array(
            'message' => 'Berhasil menambahkan shortened',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/shortened')->with($notif);
    
    }

    public function update(Request $request, $id)
    {
        $shortened = Shortened::find($id);
        $shortened->uuid = \Str::uuid();
        $shortened->title = $request->title;
        $shortened->link = $request->link;
        $shortened->url = $request->url;
        $shortened->status = 1;
        $shortened->save();
        $notif = array(
            'message' => 'Berhasil mengubah shortened',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/shortened')->with($notif);
    }

    public function destroy($id)
    {
        $shortened = Shortened::find($id);
        $shortened->delete();
        echo json_encode(['msg' => 200]);
    }


}
