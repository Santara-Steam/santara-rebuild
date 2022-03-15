<?php

namespace App\Http\Controllers\Front_end;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $now_playing = emitens_old::whereRaw('CURDATE() BETWEEN emitens.begin_period and emitens.end_period')
        ->select('emitens.*','categories.category as ktg','emiten_journeys.title as sts','emiten_journeys.date as sd',
        db::raw('SUM(IF(t.is_verified = 1, t.amount, 0)) / emitens.price as terjual')
        )
        ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        ->leftjoin('transactions as t', 't.emiten_id','=','emitens.id')
        ->join('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        ->whereRaw('emiten_journeys.created_at in (SELECT max(created_at) from emiten_journeys GROUP BY emiten_journeys.emiten_id)')
        ->groupby('emitens.id')
        ->get();

        $sold_out = emitens_old::where('emitens.is_active',1)
        ->select('emitens.*','categories.category as ktg')
        ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        ->where('emitens.is_deleted',0)
        ->whereRaw('CURDATE() NOT BETWEEN emitens.begin_period and emitens.end_period')
        ->orderby('emitens.id','DESC')
        ->get();

        return view('front_end/home/index',compact('now_playing','sold_out'));
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
