<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trails;

class NewKycController extends Controller
{

    public function belumKyc()
    {
        return view('admin.kyc.belum_kyc');
    }
    
    public function getBelumKyc(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $filter = $request->get('filter');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; 
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value'];

        $totalRecords = $this->getCount("0");
        $totalRecordswithFilter = $this->getCountFilter("0", $searchValue);
        $kyc = $this->getData("0", $searchValue, $start, $rowperpage);

        $data = [];
        foreach($kyc as $row){
            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at)));
            $button = '<button class="btn btn-info btn-sm" onclick="tabelHistory(' . $row->id . ',\'' . $row->name . '\')">History</button>&nbsp;';

            array_push($data, [
                "name" => $row->name,
                "email" => $row->email,
                "hp" => $row->phone,
                "action" => $button
            ]);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
    
        echo json_encode($response);
        exit;
    }

    public function getQueryTrail($user_id)
    {
        $trails = Trails::where('user_id', $user_id)
            ->where('is_deleted', 0)
            ->where('created_at', 'DESC')
            ->select('event', 'note', 'created_at', 'user_agent', 'ip_address')
            ->get();
        $data = [];
        foreach($trails as $row){

            $created_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at))).' '.formatJam($row->created_at);

            array_push($data, [
                'event' => $row->event,
                'created_at' => $created_at,
                'note' => $row->note,
                'user_agent' => $row->user_agent,
                'ip_address' => $row->ip_address
            ]);
        }
        return response()->json(["data" => $data]);
    }

    public function getCount($status)
    {
        $kyc = User::join('traders as t', 'users.id', '=', 't.user_id')
            ->where('users.is_deleted', 0)
            ->where('users.is_verified_kyc', 0)
            ->where('users.is_verified_kyc', $status)
            ->select('count(*) as allcount')
            ->count();
        return $kyc;
    }

    public function getCountFilter($status, $searchValue)
    {
        $kyc = User::join('traders as t', 'users.id', '=', 't.user_id')
            ->where('users.is_deleted', 0)
            ->where('users.is_verified_kyc', 0)
            ->where('t.name', 'like', '%' .$searchValue . '%')
            ->where('users.is_verified_kyc', $status)
            ->select('users.id', 't.name', 't.id as trader_id', 'users.email', 't.phone', 'users.verified_kyc_image', 
                't.verification_photo', 'users.updated_at', 'users.ket_penolakan')
            ->count();
        return $kyc;
    }

    public function getData($status, $searchValue, $start, $rowperpage)
    {
        $kyc = User::join('traders as t', 'users.id', '=', 't.user_id')
            ->where('users.is_deleted', 0)
            ->where('users.is_verified_kyc', 0)
            ->where('t.name', 'like', '%' .$searchValue . '%')
            ->where('users.is_verified_kyc', $status)
            ->select('users.id', 't.name', 't.id as trader_id', 'users.email', 't.phone', 'users.verified_kyc_image', 
                't.verification_photo', 'users.updated_at', 'users.ket_penolakan')
            ->orderBy('users.updated_at', 'ASC')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        return $kyc;
    }

}
