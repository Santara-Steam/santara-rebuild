<?php

namespace App\Http\Controllers;

use App\Models\book_saham;
use App\Models\emiten;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookSahamController extends Controller
{
    //
    public function index(){
        $book = book_saham::all();

        return view('admin.pesan_saham.index',compact('book'));
    }
    public function index_user(){
        $book = book_saham::where('trader_id',Auth::user()->trader->id)->get();

        return view('user.order.index',compact('book'));
        // dd(Auth::user()->trader->id);
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
        $bs->order_id = 'PS'.time();
        $bs->trader_id = $request->get('trader_id');
        $bs->emiten_id = $request->get('emiten_id');
        $bs->lembar_saham = $request->get('lembar_saham');
        $bs->total_amount = $request->get('lembar_saham')*$emiten->price;
        $bs->bukti_tranfer = $BuktiTransferFileSave;
        $bs->save();
    }

    public function store_user(Request $request){

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
        $bs->order_id = 'PS'.time();
        $bs->trader_id = Auth::user()->trader->id;
        $bs->emiten_id = $request->get('emiten_id');
        $bs->lembar_saham = $request->get('lembar_saham');
        $bs->total_amount = $request->get('lembar_saham')*$emiten->price;
        $bs->bukti_tranfer = $BuktiTransferFileSave;
        $bs->save();

        $notif = array(
            'message' => 'Pesan Saham Berhasil!, Silahkan Transfer ke Rekening yang Tertera',
            'alert-type' => 'success'
        );
        return redirect('upload_transfer/'.$bs->id)->with($notif);
    }

    public function pay($id){
        $trx = book_saham::where('id',$id)->first();
        if ($trx->trader_id != Auth::user()->trader->id) {
            $notif = array(
                'message' => 'Bukan transaksi Anda Brader',
                'alert-type' => 'fail'
            );
            return redirect('/')->with($notif);
        }else{
        return view('front_end.coming_soon.pay',compact('trx'));
        }
    }

    public function detail($id){

        $book = book_saham::where('id',$id)->first();
        
        return view('admin.pesan_saham.detail',compact('book'));
    }

    public function detail_user($id){

        $book = book_saham::where('id',$id)->first();
        
            return view('user.order.detail',compact('book'));
        
    }

    public function upload_bukti(Request $request,$id){
        if($request->hasFile("bukti_transfer")){
            $BuktiTransferNameWithExt = $request->file('bukti_transfer')->getClientOriginalName() ;
            $BuktiTransferFileName = pathinfo ($BuktiTransferNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('bukti_transfer')->getClientoriginalExtension();
            $BuktiTransferFileSave = 'bukti_transfer_'.time().'.'.$extension;
            $path = $request->file('bukti_transfer')->storeAs('public/bukti_transfer',$BuktiTransferFileSave) ;
        }else{
            $BuktiTransferFileSave = '-';
        }

        $book = book_saham::where('id',$id)->first();
        $book->bukti_tranfer = $BuktiTransferFileSave;
        $book->save();

        $notif = array(
            'message' => 'Bukti Transfer Berhasil Di Upload',
            'alert-type' => 'success'
        );
        return redirect('/user/pesan_saham')->with($notif);
    }
    public function upload_bukti_user(Request $request,$id){
        if($request->hasFile("bukti_transfer")){
            $BuktiTransferNameWithExt = $request->file('bukti_transfer')->getClientOriginalName() ;
            $BuktiTransferFileName = pathinfo ($BuktiTransferNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('bukti_transfer')->getClientoriginalExtension();
            $BuktiTransferFileSave = 'bukti_transfer_'.time().'.'.$extension;
            $path = $request->file('bukti_transfer')->storeAs('public/bukti_transfer',$BuktiTransferFileSave) ;
        }else{
            $BuktiTransferFileSave = '-';
        }

        $book = book_saham::where('id',$id)->first();
        $book->bukti_tranfer = $BuktiTransferFileSave;
        if ($book->trader_id != Auth::user()->trader->id) {
            $notif = array(
                'message' => 'Bukan transaksi Anda Brader',
                'alert-type' => 'fail'
            );
            return redirect()->back()->with($notif);
        }else{
            if ($book->bukti_tranfer != "-" ) {
                $notif = array(
                    'message' => 'Bukti Transfer sudah di Upload ya Brader, Tunggu Verifikasi',
                    'alert-type' => 'warn'
                );
                return redirect()->back()->with($notif);
            }else{
                $book->save();
                $notif = array(
                    'message' => 'Bukti Transfer Berhasil Di Upload',
                    'alert-type' => 'success'
                );
                return redirect('detail-coming-soon/'.$book->emiten_id)->with($notif);
            }
        }
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
