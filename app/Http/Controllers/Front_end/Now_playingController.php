<?php

namespace App\Http\Controllers\Front_end;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\book_saham;
use App\Models\emiten;
use App\Models\emiten_comment;
use App\Models\emiten_journey;
use App\Models\emiten_vote;
use App\Models\emitens_old;
use App\Models\Transactions;
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
        $now_playing = emiten::select('emitens.*','emitens.avg_capital_needs as lbr','categories.category as ktg', 'emiten_journeys.date as sd', 'emiten_journeys.end_date as ed', db::raw('SUM(IF(book_sahams.isValid = 1, book_sahams.total_amount, 0))  as terjual'),db::raw('SUM(IF(book_sahams.isValid = 1, book_sahams.total_amount, 0)) / emitens.avg_capital_needs  as per'))
        // ->leftjoin('emiten_votes as ev','ev.emiten_id','=','emitens.id')
        ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        ->join('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        ->leftjoin('book_sahams', 'book_sahams.emiten_id','=','emitens.id')
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
        $boks = book_saham::select(db::raw('SUM(total_amount) as tot'))
        ->where('emiten_id',$id)->where('isValid',1)->first();

        $bok = Transactions::select(db::raw('SUM(IF(transactions.is_verified = 1 AND transactions.is_deleted = 0, transactions.amount, 0))  as tot'))
        ->where('emiten_id',$id)->first();
        
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

        return view('front_end/now_playing/show',compact('emt','clike','cvote','ccmt','status','bok'));
        
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
