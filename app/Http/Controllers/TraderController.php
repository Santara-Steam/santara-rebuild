<?php

namespace App\Http\Controllers;

use App\Models\trader;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function portofolio(){
        $uid = Auth::user()->id;
        $port = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->leftjoin('categories as c','c.id','=','e.category_id')
                ->where('users.id', $uid)
                ->where('tr.is_deleted', 0)
                ->where('tr.last_status', 'VERIFIED')
                ->select('c.category as cat','e.company_name','e.trademark',db::raw('MAX(tr.created_at) as cr'),db::raw('SUM(tr.amount/e.price) as lembar'),db::raw('SUM(tr.amount) as tot'))
                ->groupBy('e.id')
                ->get();
        return view('user.portofolio.index',compact('port'));
    }
}
