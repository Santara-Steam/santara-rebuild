<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\trader;
use Illuminate\Support\Facades\Password;

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
            ->where('t.name', 'like', '%' .$searchValue . '%')
            ->select('users.id', 'users.uuid', 't.name', 'users.email', 
                    't.phone', 'users.attempt', 'users.created_at', 'r.name as role_name')
            ->get();
        
        $data = [];
        foreach($users as $row){

            $btn_action = '
                <a href="'.url('admin/setting/account/edit/'.$row->id).'" class="btn btn-primary btn-sm">Edit</a>
                <a href="'.url('admin/setting/account/reset-password/'.$row->id).'" class="btn btn-info btn-sm">Resend Password Reset</a>
                <button type="button" id="btnDelete" data-id="'.$row->id.'"  class="btn btn-danger btn-sm">Hapus</button>
            ';

            array_push($data, [
                'name' => $row->name,
                'email' => $row->email,
                'phone' => $row->phone,
                'attempt' => $row->attempt,
                'role' => $row->role,
                'created_at' => tgl_indo(date('Y-m-d', strtotime($row->created_at))).' '.formatJam($row->created_at),
                'aksi' => $btn_action
            ]);
        }
        return response()->json(["code" => 200, "data" => $data]);
    }

    public function edit($id)
    {
        $user = User::join('traders as t', 'users.id', '=', 't.user_id')
            ->where('users.id', $id)
            ->select('users.*', 't.phone', 't.is_verified as trader_is_verified')
            ->first();
        return view('admin.account.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $phone = $request->phone;
        if (substr($phone, 0, 1) == "0") {
            $phone = substr_replace($phone, "+62", 0, 1);
        }

        $user = User::find($id);
        $user->email = $request->email;
        $user->is_verified = $request->is_verified;
        $user->is_otp = $request->is_otp;
        $user->is_logged_in = $request->is_logged_in;
        $user->attempt = $request->attempt;
        $user->save();

        $trader = trader::where('user_id', $id)->update([
            'phone' => $phone,
            'is_verified' => $request->trader_is_verified
        ]);

        $notif = array(
            'message' => 'Berhasil mengubah data user',
            'alert-type' => 'success'
        );
        return redirect('admin/setting/account')->with($notif);
    }

    public function resendEmailReset($id)
    {
        $user = User::find($id);
     
        $token = Password::getRepository()->create($user);

        $user->sendPasswordResetNotification($token);
        $berhasil = array(
            'message' => 'Berhasil mengirim link reset password user',
            'alert-type' => 'success'
        );
        return redirect('admin/setting/account')->with($berhasil);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->is_deleted = 1;
        $user->save();
        return response()->json(["code" => 200, "msg" => "Berhasil hapus data"]);
    }


}
