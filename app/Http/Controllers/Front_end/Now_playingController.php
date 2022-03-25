<?php

namespace App\Http\Controllers\Front_end;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\emiten;
use App\Models\emiten_comment;
use App\Models\emiten_journey;
use App\Models\emiten_vote;
use App\Models\emitens_old;
use Illuminate\Support\Facades\DB;

class Now_playingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now_playing = emiten::select('emitens.*','categories.category as ktg')
        // ->leftjoin('emiten_votes as ev','ev.emiten_id','=','emitens.id')
        ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        ->join('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        ->whereRaw('emiten_journeys.created_at in (SELECT max(created_at) from emiten_journeys GROUP BY emiten_journeys.emiten_id)')
        ->where('emitens.is_deleted',0)
        ->where('emiten_journeys.title','=','Penawaran Saham')
        // ->leftjoin('emiten_comments as ec','ec.emiten_id','=','emitens.id')
        ->groupBy('emitens.id')
        ->orderby('emitens.id','DESC')
        ->get()
        ;
        return view('front_end/now_playing/index',compact('now_playing'));
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
        $status = emiten_journey::select('*')->where('emiten_id',$id)
        ->whereRaw('created_at = (SELECT max(created_at) from emiten_journeys
        where emiten_id = '.$id.')')
        ->first();

        return view('front_end/now_playing/show',compact('emt','clike','cvote','ccmt','status'));
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
