<?php

namespace App\Http\Controllers\Front_end;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\emitens_old;
use Illuminate\Support\Facades\DB;
use App\Models\Transactions_old;
use App\Models\emiten_journey_old;

class Sold_outController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sold_out = emitens_old::where('emitens.is_active',1)
        ->select('emitens.*','categories.category as ktg', DB::raw("SUM(devidend.devidend) as dvd"),  DB::raw("COUNT(devidend.devidend) as dvc"))
        ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        ->leftjoin('devidend', 'devidend.emiten_id','=','emitens.id')
        ->where('emitens.is_deleted',0)
        ->whereRaw('CURDATE() NOT BETWEEN emitens.begin_period and emitens.end_period')
        ->orderby('emitens.id','DESC')
        ->groupBy('emitens.id')
        ->get();

        return view('front_end/sold_out/index',compact('sold_out'));
    }

    public function detail($id)
    {
        $emt = emitens_old::where('id',$id)->first();
        
        $bok = Transactions_old::select(db::raw('SUM(IF(transactions.is_verified = 1 AND transactions.is_deleted = 0, transactions.amount, 0))  as tot'))
        ->where('emiten_id',$id)->first();

        $status = emiten_journey_old::select('*')->where('emiten_id',$id)
        ->whereRaw('created_at = (SELECT max(created_at) from emiten_journeys
        where emiten_id = '.$id.')')
        ->first();

        return view('front_end/sold_out/show',compact('emt','bok','status'));
        
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
