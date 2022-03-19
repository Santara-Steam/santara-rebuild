<?php

namespace App\Http\Controllers;

use App\Models\emiten_comment;
use Illuminate\Http\Request;

class EmitenCommentController extends Controller
{
    //
    public function getcomment($id){
        $cmtt = emiten_comment::where('emiten_id',$id)->get();

        foreach ($cmtt as $key => $value) {
            $ide[] = $value['id'];
        }

        $cmt[] = $ide;
        
        echo $cmt;
    }
}
