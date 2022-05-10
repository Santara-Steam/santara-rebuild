<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    
    public function index()
    {
        return view('admin.account.index');
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

        $totalRecords = User::join('roles as r', 'r.id', '=', 'users.role_id')
            ->join('traders as t', 't.id', '=', 't.user_id')
            ->where('users.is_deleted', 0)
            ->orderBy('users.id', 'DESC')
            ->select('count(*) as allcount')
            ->count();
        $totalRecordswithFilter = User::join('roles as r', 'r.id', '=', 'users.role_id')
            ->join('traders as t', 'users.id', '=', 't.user_id')
            ->where('users.is_deleted', 0)
            ->orderBy('users.id', 'DESC')
            ->where('t.name', 'like', '%' .$searchValue . '%')
            ->count();
        $users = User::join('roles as r', 'r.id', '=', 'users.role_id')
            ->join('traders as t', 'users.id', '=', 't.user_id')
            ->where('users.is_deleted', 0)
            ->orderBy('users.id', 'DESC')
            ->skip($start)
            ->take($rowperpage)
            ->select('users.id', 'users.uuid', 't.name', 'users.email', 
                    't.phone', 'users.attempt', 'users.created_at', 'r.name as role_name')
            ->get();
        
        $data = [];
        foreach($users as $row){

            $btn_action = '
                <a href="'.url('admin/setting/account/edit/'.$row->id).'" class="btn btn-primary btn-sm">Edit</a>
                <a href="" class="btn btn-danger btn-sm">Hapus</a>
            ';

            array_push($data, [
                'name' => $row->name,
                'email' => $row->email,
                'phone' => $row->phone,
                'attempt' => $row->attempt,
                'role' => $row->role,
                'created_at' => $row->created_at,
                'aksi' => $btn_action
            ]);
        }
        return response()->json(["code" => 200, "data" => $data]);
    }

    public function edit($id)
    {
        $user = User::join('traders as t', 'users.id', '=', 't.user_id')
            ->where('users.id', $id)
            ->first();
        return view('admin.account.edit', compact('user'));
    }

}
