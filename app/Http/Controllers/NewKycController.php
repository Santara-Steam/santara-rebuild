<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trails;
use App\Models\trader;

class NewKycController extends Controller
{

    public function belumKyc()
    {
        return view('admin.kyc.belum_kyc');
    }

    public function sudahKyc()
    {
        return view('admin.kyc.sudah_kyc');
    }

    public function approveKyc()
    {
        return view('admin.kyc.approve_kyc');
    }

    public function rejectKyc()
    {
        return view('admin.kyc.reject_kyc');
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

    public function getSudahKyc(Request $request)
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

        $totalRecords = $this->getCount("1");
        $totalRecordswithFilter = $this->getCountFilter("1", $searchValue);
        $kyc = $this->getData("1", $searchValue, $start, $rowperpage);

        $data = [];
        foreach($kyc as $row){
            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at)));
            $button = ' <button class="btn btn-primary btn-sm" style="margin-bottom:5px" onclick="foto(\'' . $row->verified_kyc_image .  '\',\'' . $row->verification_photo .  '\',\'' . $row->name . '\')"><i class="fa fa-camera"></i>Foto</button>&nbsp;
                <button class="btn btn-info btn-sm" style="margin-bottom:5px" onclick="tabelHistory(' . $row->id .  ',\'' . $row->name . '\')">History</button>&nbsp;
                <button class="btn btn-success btn-sm" style="margin-bottom:5px" onclick="approve(' . $row->id .  ',\'' . $row->name . '\')">Approve</button>&nbsp;
                <button class="btn btn-danger btn-sm" style="margin-bottom:5px" onclick="reject(' . $row->id .  ',\'' . $row->name . '\')">Reject</button>&nbsp;';

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

    public function getApproveKyc(Request $request)
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

        $totalRecords = $this->getCount("2");
        $totalRecordswithFilter = $this->getCountFilter("2", $searchValue);
        $kyc = $this->getData("2", $searchValue, $start, $rowperpage);

        $data = [];
        foreach($kyc as $row){
            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at)));
            $button = ' <button class="btn btn-primary btn-sm" style="margin-bottom:5px" onclick="foto(\'' . $row->verified_kyc_image .  '\',\'' . $row->verification_photo .  '\',\'' . $row->name . '\')"><i class="fa fa-camera"></i>Foto</button>&nbsp;
                <button class="btn btn-info btn-sm" style="margin-bottom:5px" onclick="tabelHistory(' . $row->id .  ',\'' . $row->name . '\')">History</button>&nbsp;
                <button class="btn btn-danger btn-sm" style="margin-bottom:5px" onclick="reject(' . $row->id .  ',\'' . $row->name . '\')">Reject</button>&nbsp;';

            $dataAdmin = $this->getAdmin($row->trader_id, 'disetujui');
            if ($dataAdmin != 'null') {
                $admin = $dataAdmin;
            } else {
                $admin = '-';
            }

            array_push($data, [
                "admin" => $admin,
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

    public function getRejectKyc(Request $request)
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

        $totalRecords = $this->getCount("3");
        $totalRecordswithFilter = $this->getCountFilter("3", $searchValue);
        $kyc = $this->getData("3", $searchValue, $start, $rowperpage);

        $data = [];
        foreach($kyc as $row){
            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at)));
            $button = ' <button class="btn btn-primary btn-sm" style="margin-bottom:5px" onclick="foto(\'' . $row->verified_kyc_image .  '\',\'' . $row->verification_photo .  '\',\'' . $row->name . '\')"><i class="fa fa-camera"></i>Foto</button>&nbsp;
                <button class="btn btn-info btn-sm" style="margin-bottom:5px" onclick="tabelHistory(' . $row->id .  ',\'' . $row->name . '\')">History</button>&nbsp;
                <button class="btn btn-success btn-sm" style="margin-bottom:5px" onclick="approve(' . $row->id .  ',\'' . $row->name . '\')">Approve</button>&nbsp;';
            
            $dataAdmin = $this->getAdmin($row->trader_id, 'ditolak');
            if ($dataAdmin != 'null') {
                $admin = $dataAdmin;
            } else {
                $admin = '-';
            }

            array_push($data, [
                "admin" => $admin,
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
            ->orderBy('created_at', 'DESC')
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
            ->where('users.is_verified_kyc', $status)
            ->select('count(*) as allcount')
            ->count();
        return $kyc;
    }

    public function getCountFilter($status, $searchValue)
    {
        $kyc = User::join('traders as t', 'users.id', '=', 't.user_id')
            ->where('users.is_deleted', 0)
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

    public function getAdmin($traderId, $status)
    {
        $trader = trader::join('log_approval_new_kyc as log', 'log.approval_id', '=', 'traders.user_id')
            ->where('log.trader_id', $traderId)
            ->where('log.status_kyc', $status)
            ->orderBy('log.id', 'DESC')
            ->select('traders.name')
            ->first();
        return $trader->name;
    }

    public function putApprove($id)
    {
        try {
            $client = new \GuzzleHttp\Client();

            $endpoint = $client->request('POST', config("global.BASE_API_ADMIN_URL").config('global.API_ADMIN_VERSION') . 'users/update-status-iskyc/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                ],
                'form_params' => [
                    'status' => 2,
                ]
            ]);

            echo $endpoint->getBody()->getContents();
            return;
        } catch (\Exception $exception) {
            echo json_encode($exception);
            return;
        }
    }

    public function putReject(Request $request, $id)
    {
        $keterangan = $request->keterangan;
        try {
            $client = new \GuzzleHttp\Client();
            
            $endpoint = $client->request('POST', config("global.BASE_API_ADMIN_URL").config('global.API_ADMIN_VERSION') . 'users/update-status-iskyc/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                ],
                'form_params' => [
                    'status' => 3,
                    'keterangan' => $keterangan
                ]
            ]);

            echo $endpoint->getBody()->getContents();
            return;
        } catch (\Exception $exception) {
            echo json_encode($exception);
            return;
        }
    }

}
