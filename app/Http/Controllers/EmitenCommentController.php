<?php

namespace App\Http\Controllers;

use App\Models\emiten_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmitenCommentController extends Controller
{
    //
    function convertDateTimeDBtoIndo($string){
        // contoh : 2019-01-30 10:20:20
        
        $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
    
        $date = explode(" ", $string)[0];
        $time = explode(" ", $string)[1];
        
        $tanggal = explode("-", $date)[2];
        $bulan = explode("-", $date)[1];
        $tahun = explode("-", $date)[0];
        
        
    
        return $tanggal . " " . $bulanIndo[abs($bulan)] . " " . $tahun . " " . $time;
    }

    public function getcomment($id){

        $cmtt = emiten_comment::where('emiten_comments.emiten_id',$id)
        ->select('emiten_comments.comment as cm','emiten_comments.created_at as tm','traders.name as name','traders.photo as ph')
        ->leftjoin('traders','emiten_comments.trader_id','=','traders.id')
        ->leftjoin('users','traders.user_id','=','users.id')
        ->get();
        $cmtt2 = emiten_comment::where('emiten_comments.emiten_id',$id)
        ->select('emiten_comments.comment as cm','emiten_comments.created_at as tm','traders.name as name')
        ->leftjoin('traders','emiten_comments.trader_id','=','traders.id')
        ->leftjoin('users','traders.user_id','=','users.id')
        ->count();
        $error = 'https://storage.googleapis.com/asset-santara/santara.co.id/images/error/no-image-user-small.png';
        

        if($cmtt2 > 0){
        $cmt = "<div id='list-pralisting-comments' style='height: 350px; scroll-behavior: smooth; overflow: overlay;overflow-x:hidden'>";
        foreach ($cmtt as $key) {
            $trpho = config('global.STORAGE_BUCKET2')."kyc/".str_replace('/uploads/trader/', "",$key->ph);
            if(empty($key->photo) || $key->photo == null || isset($key->photo)){
              $photo = $trpho;
            }else{
              $photo = $error;
            }
            $cmt .= "<table width='95%' style='margin-bottom:10px;' class='mx-2 fs-m'>
            <tbody>
              <tr>
                <td valign='top' rowspan='2' width='15%' class='text-center'>
                  <img src='".$photo."' alt='".$key->name."'
                    onerror='this.onerror=null;this.src=".$error.";'
                    class='mt-1 rounded-circle' width='35' height='35'>
                </td>
                <td width='85%'>
                  <p class='mt-1 mb-0 text-break' style='font-size: 14px'><span style='font-size: 16px;
                  font-weight: bold;
                  color: black;'>".$key->name."</span> &nbsp; ".$key->cm."
                </p>
              </td>
            </tr>
            <tr>
              <td valign='top'>
                <small style='font-size:12px;padding-left: 19px'>
                  ".$this->convertDateTimeDBtoIndo($key->tm)."
                </small>
              </td>
            </tr>
          </tbody>
        </table>";
        }
        $cmt .="</div>";

        }else{
            $cmt = "Komentar masih kosong";
        }


        






        echo $cmt;
    }

    public function sendComment($id,Request $request){
        
        $data = $request->all();
        
        $cm = new emiten_comment();
        $cm->trader_id = Auth::user()->trader->id;
        $cm->emiten_id = $request->idem;
        $cm->comment = $request->comment;
        $cm->save();

        #create or update your data here

        return response()->json(['success'=>'Ajax request submitted successfully']);
    }
}
