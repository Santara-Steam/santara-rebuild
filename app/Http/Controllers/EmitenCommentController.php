<?php

namespace App\Http\Controllers;

use App\Models\emiten_comment;
use Illuminate\Http\Request;

class EmitenCommentController extends Controller
{
    //
    public function getcomment($id){
        $cmtt = emiten_comment::where('emiten_id',$id)
        ->select('emiten_comments.comment as cm','emiten_comments.created_at as tm','users.name as name')
        ->join('traders','emiten_comments.trader_id','=','traders.id')
        ->join('users','traders.user_id','=','users.id')
        ->get();

        if($cmtt){
        $cmt = "<div id='list-pralisting-comments' style='height: 350px; scroll-behavior: smooth; overflow: overlay;overflow-x:hidden'>";
        foreach ($cmtt as $key) {
            $cmt .= "<table width='95%' class='mx-2 fs-m'>
            <tbody>
              <tr>
                <td valign='top' rowspan='2' width='15%'>
                  <img src='https://fire.santarax.com:3701/uploads/trader-photo/photo-1601797993036.jpg' alt='Kurniawan'
                    onerror='this.onerror=null;this.src='https://storage.googleapis.com/asset-santara/santara.co.id/images/error/no-image-user-small.png';'
                    class='mt-1 rounded-circle' width='35' height='35'>
                </td>
                <td width='85%'>
                  <p class='mt-1 mb-0 text-break' style='font-size: 14px'><span class=' fw-bold'>".$key->name."</span> &nbsp; ini
                  dummy atau asli ya min
                </p>
              </td>
            </tr>
            <tr>
              <td valign='top'>
                <small class='fw-light' style='font-size:12px'>
                  <p>03 Desember 2021</p>
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
}
