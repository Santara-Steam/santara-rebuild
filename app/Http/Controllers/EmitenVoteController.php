<?php

namespace App\Http\Controllers;

use App\Models\emiten_vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EmitenVoteController extends Controller
{
    //
    public function addlike($id){
        $vote = emiten_vote::where('trader_id',Auth::user()->trader->id)
        ->where('emiten_id',$id)->first();

        if($vote){
            $em = $vote;
        }else{
            $em = new emiten_vote();
        }
        $em->trader_id = Auth::user()->trader->id;
        $em->emiten_id = $id;
        $em->likes = 1;
        $em->save();

        return redirect()->back();
    }
    public function sublike($id){
        $vote = emiten_vote::where('trader_id',Auth::user()->trader->id)
        ->where('emiten_id',$id)->first();

        if($vote){
            $em = $vote;
        }else{
            $em = new emiten_vote();
        }
        $em->trader_id = Auth::user()->trader->id;
        $em->emiten_id = $id;
        $em->likes = 0;
        $em->save();

        return redirect()->back();
    }
    public function addvote($id){
        $vote = emiten_vote::where('trader_id',Auth::user()->trader->id)
        ->where('emiten_id',$id)->first();

        if($vote){
            $em = $vote;
        }else{
            $em = new emiten_vote();
        }
        $em->trader_id = Auth::user()->trader->id;
        $em->emiten_id = $id;
        $em->vote = 1;
        $em->save();

        return redirect()->back();
    }
    public function subvote($id){
        $vote = emiten_vote::where('trader_id',Auth::user()->trader->id)
        ->where('emiten_id',$id)->first();

        if($vote){
            $em = $vote;
        }else{
            $em = new emiten_vote();
        }
        $em->trader_id = Auth::user()->trader->id;
        $em->emiten_id = $id;
        $em->vote = 0;
        $em->save();

        return redirect()->back();
    }

    public function addlikeajx($id){
        $vote = emiten_vote::where('trader_id',Auth::user()->trader->id)
        ->where('emiten_id',$id)->first();

        if($vote){
            $em = $vote;
        }else{
            $em = new emiten_vote();
        }
        $em->trader_id = Auth::user()->trader->id;
        $em->emiten_id = $id;
        $em->likes = 1;
        $em->save();

        // return redirect()->back();
    }
    public function sublikeajx($id){
        $vote = emiten_vote::where('trader_id',Auth::user()->trader->id)
        ->where('emiten_id',$id)->first();

        if($vote){
            $em = $vote;
        }else{
            $em = new emiten_vote();
        }
        $em->trader_id = Auth::user()->trader->id;
        $em->emiten_id = $id;
        $em->likes = 0;
        $em->save();

        // return redirect()->back();
    }
    public function addvoteajx($id){
        $vote = emiten_vote::where('trader_id',Auth::user()->trader->id)
        ->where('emiten_id',$id)->first();

        if($vote){
            $em = $vote;
        }else{
            $em = new emiten_vote();
        }
        $em->trader_id = Auth::user()->trader->id;
        $em->emiten_id = $id;
        $em->vote = 1;
        $em->save();

        // return redirect()->back();
    }
    public function subvoteajx($id){
        $vote = emiten_vote::where('trader_id',Auth::user()->trader->id)
        ->where('emiten_id',$id)->first();

        if($vote){
            $em = $vote;
        }else{
            $em = new emiten_vote();
        }
        $em->trader_id = Auth::user()->trader->id;
        $em->emiten_id = $id;
        $em->vote = 0;
        $em->save();

        // return redirect()->back();
    }

    public function clike($id){
        $clike = emiten_vote::select(db::raw('COALESCE(SUM(likes),0) as l'))
        ->where('emiten_id',$id)
        ->first();

        $count = $clike->l;
        // $count = $id;

        echo $count;
    }
    public function cvote($id){
        $clike = emiten_vote::select(db::raw('COALESCE(SUM(vote),0) as v'))
        ->where('emiten_id',$id)
        ->first();

        $count = $clike->v;
        // $count = $id;

        echo $count;
    }
}
