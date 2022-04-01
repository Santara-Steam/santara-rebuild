<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TraderController extends Controller
{
    //
    public function edit_profile($id){
        $id;
        return view('user.profile.edit',compact('id'));
    }
}
