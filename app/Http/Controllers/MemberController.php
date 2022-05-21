<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Investor;

class MemberController extends Controller
{
    
    public function index()
    {
        return view('admin.member-trader.index');
    }

    public function fetchData(Request $request)
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

        $totalRecords = User::join('traders as t', 't.user_id', '=', 'users.id')
            ->join('balance_utama as bu', 'bu.trader_id', '=', 't.id')
            ->select('count(*) as allcount')
            ->where('users.is_deleted', 0)
            ->count();

        $totalRecordswithFilter = User::join('traders as t', 't.user_id', '=', 'users.id')
            ->join('balance_utama as bu', 'bu.trader_id', '=', 't.id')
            ->where('users.is_deleted', 0)
            ->where('t.name', 'like', '%' .$searchValue . '%')
            ->count();

        $users = User::join('traders as t', 't.user_id', '=', 'users.id')
            ->join('balance_utama as bu', 'bu.trader_id', '=', 't.id')
            ->skip($start)
            ->take($rowperpage)
            ->select('users.email', 'users.id', 't.id as trader_id', 't.name', 
                't.phone', 'bu.balance')
            ->where('users.is_deleted', 0)
            ->where('t.name', 'like', '%' .$searchValue . '%')
            ->orderBy('users.created_at', 'DESC')
            ->get();
        
        $data = [];
        foreach($users as $row){
            $btnAction = '<button type="button" onclick="portofolio('.$row->id.',\''.$row->name.'\')" class="btn btn-sm btn-primary">Portofolio</button>';

            array_push($data, [
                'id' => $row->id,
                'name' => $row->name,
                'email' => $row->email,
                'phone' => $row->phone,
                'action' => $btnAction
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

    public function portofolio($userId)
    {
        $balance = User::join('traders as t', 't.user_id', '=', 'users.id')
            ->join('balance_utama as bu', 'bu.trader_id', '=', 't.id')
            ->where('users.id', $userId)
            ->where('users.is_deleted', 0)
            ->where('t.is_deleted', 0)
            ->select('bu.balance')
            ->first();
        $saldo = 0;
        if($balance != null){
            $saldo = $balance->balance;
        }
        try {
            $client = new \GuzzleHttp\Client();

            $headers = [
                'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
            ];

            $responseToken = $client->request('GET', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . 'finance-report/list-member-portofolio/?user_id=' . $userId, [
                'headers' => $headers,
            ]);

            if ($responseToken->getStatusCode() == 200) {
                $tokens = json_decode($responseToken->getBody()->getContents(), TRUE);
                echo json_encode(["token" => $tokens, "saldo" => rupiahBiasa($saldo)]);
                return;
            }
        } catch (\Exception $exception) {
            echo json_encode($exception);
            return;
        }
    }

    public function exportInvestor()
    {
        return Excel::download(new Investor(), 'Data Investor.xlsx');
    }

}
