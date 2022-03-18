<?php

namespace App\Http\Controllers;

use App\Models\book_saham;
use App\Models\emiten;
use App\Models\User;
use Illuminate\Http\Request;

class BookSahamController extends Controller
{
    //
    public function index(){
        $book = book_saham::all();

        return view('admin.pesan_saham.index',compact('book'));
    }

    public function create(){
        $user = User::where('role_id',2)->get();
        $emiten = emiten::all();
        return view('admin.pesan_saham.add',compact('user','emiten'));
    }

    public function store(Request $request){

        if($request->hasFile("bukti_transfer")){
            $BuktiTransferNameWithExt = $request->file('bukti_transfer')->getClientOriginalName() ;
            $BuktiTransferFileName = pathinfo ($BuktiTransferNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('bukti_transfer')->getClientoriginalExtension();
            $BuktiTransferFileSave = 'bukti_transfer_'.time().'.'.$extension;
            $path = $request->file('bukti_transfer')->storeAs('public/bukti_transfer',$BuktiTransferFileSave) ;
        }else{
            $BuktiTransferFileSave = '-';
        }

        $emiten = emiten::where('id',$request->get('emiten_id'))->first();

        $bs = new book_saham;
        $bs->trader_id = $request->get('trader_id');
        $bs->emiten_id = $request->get('emiten_id');
        $bs->lembar_saham = $request->get('lembar_saham');
        $bs->total_amount = $request->get('lembar_saham')*$emiten->price;
        $bs->bukti_tranfer = $BuktiTransferFileSave;
        $bs->save();
    }

    public function detail($id){

        $book = book_saham::where('id',$id)->first();
        
        return view('admin.pesan_saham.detail',compact('book'));
    }

    public function approve($id){
        $book = book_saham::where('id',$id)->first();
        $book->isValid = 1;
        $book->save();
        $notif = array(
            'message' => 'Bukti Transfer Berhasil Di Konfirmasi',
            'alert-type' => 'success'
        );
        return redirect('/admin/pesan_saham')->with($notif);
        
    }
    public function reject($id){
        $book = book_saham::where('id',$id)->first();
        $book->isValid = 2;
        $book->save();

        $notif = array(
            'message' => 'Bukti Transfer Berhasil Di Tolak',
            'alert-type' => 'success'
        );
        return redirect('/admin/pesan_saham')->with($notif);
    }
}
