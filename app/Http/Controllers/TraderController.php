<?php

namespace App\Http\Controllers;

use App\Models\trader;
use App\Models\User;
use Illuminate\Http\Request;

class TraderController extends Controller
{
    //
    public function edit_profile($id){
        $user = User::where('id',$id)->first();
        return view('user.profile.edit',compact('user'));
    }
    public function update_profile(request $request,user $user,$id){
        $user = User::where('id',$id)->first();
        if($request->profile == null){
            $profile = 'default1.png';
        }else{
            $profile = str_replace('public/storage/pictures/','',$request->profile);
        }
        $trader = trader::where('user_id',$id)->first();
        $trader->name = $request->name;
        $trader->photo = $profile;
        $trader->save();
        $notif = array(
            'message' => 'Edit Profile Berhasil!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notif);
    }
}
