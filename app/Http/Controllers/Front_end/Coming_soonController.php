<?php

namespace App\Http\Controllers\Front_end;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\emiten;
use App\Models\emiten_comment;
use App\Models\emiten_journey;
use App\Models\emiten_vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Coming_soonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soon = emiten::select('emitens.*',db::raw('COALESCE(SUM(ev.likes),0) as likes'),db::raw('COALESCE(SUM(ev.vote),0) as vot'),db::raw("GROUP_CONCAT(IF(ev.likes = 1, ev.trader_id, NULL) SEPARATOR ',') as trdlike"),db::raw("GROUP_CONCAT(IF(ev.vote = 1, ev.trader_id, NULL) SEPARATOR ',') as trdvote"),db::raw('(
            SELECT count(id) from emiten_comments
            where emiten_id = emitens.id
            ) as cmt'))
        ->leftjoin('emiten_votes as ev','ev.emiten_id','=','emitens.id')
        ->leftjoin('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        ->where('emitens.is_deleted',0)
        ->where('emitens.is_active',0)
            ->where('emitens.is_verified',1)
            ->where('emitens.is_pralisting',1)
            ->where('emitens.is_coming_soon',1)
        // ->whereRaw('emiten_journeys.created_at in (SELECT max(created_at) from emiten_journeys GROUP BY emiten_journeys.emiten_id)')
        // ->where('emiten_journeys.title','=','Pra Penawaran Saham')
        // ->leftjoin('emiten_comments as ec','ec.emiten_id','=','emitens.id')
        ->groupBy('emitens.id')
        ->orderby('vot','DESC')
        ->get();

        return view('front_end/coming_soon/index',compact('soon'));
    }

    public function detail($id)
    {   
        $emt = emiten::where('id',$id)->first();
        $clike = emiten_vote::select(DB::raw('COALESCE(SUM(likes),0) as l'))
        ->where('emiten_id',$id)
        ->first();
        $cvote = emiten_vote::select(db::raw('COALESCE(SUM(vote),0) as v'))
        ->where('emiten_id',$id)
        ->first();
        $ccmt = emiten_comment::where('emiten_id',$id)
        ->count();
        // $status = emiten_journey::select('*')->where('emiten_id',$id)
        // ->whereRaw('created_at = (SELECT max(created_at) from emiten_journeys
        // where emiten_id = '.$id.')')
        // ->first();
        // dd($emt->id);
        if(Auth::user()){

            $value = db::table('emiten_votes')->where('emiten_id',$emt->id)
            ->where('trader_id',Auth::user()->trader->id)
            ->select(db::raw('COALESCE(minat,0) as m'))
            ->first();
        }else{
            $value = 0;
        }

        return view('front_end/coming_soon/show',compact('emt','clike','cvote','ccmt','value'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
