<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header;

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
        $pictures = time().'.'.$request->pictures->extension();  
        $request->pictures->move(public_path('headers'), $pictures);

        $mobile = time().'.'.$request->mobile->extension();  
        $request->mobile->move(public_path('headers'), $mobile);

        $header = new Header();
        $header->title = $request->title;
        $header->pictures = $pictures;
        $header->mobile = $mobile;
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
        $header = Header::find($id);
        $header->title = $request->title;
        if($request->hasFile('pictures')){
            \File::delete(public_path('public/headers/'.$header->pictures));
            $pictures = time().'.'.$request->pictures->extension();  
            $request->pictures->move(public_path('headers'), $pictures);
            $header->pictures = $pictures;
        }
        if($request->hasFile('mobile')){
            \File::delete(public_path('public/headers/'.$header->mobile));
            $mobile = time().'.'.$request->mobile->extension();  
            $request->mobile->move(public_path('headers'), $mobile);
            $header->mobile = $mobile;
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
        $header->status = 0;
        $header->save();
    }

}
