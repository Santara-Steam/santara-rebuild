<?php

namespace App\Http\Controllers\Front_end;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\emiten;
use App\Models\emiten_vote;
use App\Models\emitens_old;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $now_playing = emitens_old::whereRaw('CURDATE() BETWEEN emitens.begin_period and emitens.end_period')
        // ->select('emitens.*','categories.category as ktg','emiten_journeys.title as sts','emiten_journeys.date as sd',
        // db::raw('SUM(IF(t.is_verified = 1, t.amount, 0)) / emitens.price as terjual')
        // )
        // ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        // ->leftjoin('transactions as t', 't.emiten_id','=','emitens.id')
        // ->join('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        // ->whereRaw('emiten_journeys.created_at in (SELECT max(created_at) from emiten_journeys GROUP BY emiten_journeys.emiten_id)')
        // ->groupby('emitens.id')
        // ->get();

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

        $sold_out = emitens_old::where('emitens.is_active',1)
        ->select('emitens.*','categories.category as ktg')
        ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        ->where('emitens.is_deleted',0)
        ->whereRaw('CURDATE() NOT BETWEEN emitens.begin_period and emitens.end_period')
        ->orderby('emitens.id','DESC')
        ->get();

        $soon = emiten::select('emitens.*',db::raw('COALESCE(SUM(ev.likes),0) as likes'),db::raw('COALESCE(SUM(ev.vote),0) as vot'),db::raw("GROUP_CONCAT(IF(ev.likes = 1, ev.trader_id, NULL) SEPARATOR ',') as trdlike"),db::raw("GROUP_CONCAT(IF(ev.vote = 1, ev.trader_id, NULL) SEPARATOR ',') as trdvote"),db::raw('(
            SELECT count(id) from emiten_comments
            where emiten_id = emitens.id
            ) as cmt'))
        ->leftjoin('emiten_votes as ev','ev.emiten_id','=','emitens.id')
        ->join('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        ->where('emitens.is_deleted',0)
        ->whereRaw('emiten_journeys.created_at in (SELECT max(created_at) from emiten_journeys GROUP BY emiten_journeys.emiten_id)')
        ->where('emiten_journeys.title','=','Pra Penawaran Saham')
        // ->leftjoin('emiten_comments as ec','ec.emiten_id','=','emitens.id')
        ->groupBy('emitens.id')
        ->orderby('emitens.id','DESC')
        ->get()
        ;

        return view('front_end/home/index',compact('now_playing','sold_out','soon'));
        // dd($now_playing);
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
