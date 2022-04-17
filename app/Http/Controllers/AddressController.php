<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regency;
use App\Models\Province;

class AddressController extends Controller
{

    public function getRegency(Request $request)
    {
        $search = $request->search;
        if($search != ""){
            $regency = Regency::where('is_deleted', 0)
                ->where('name', 'like', '%'.$search.'%')
                ->limit(5)
                ->select('id', 'name')
                ->get();
        }else{
            $regency = Regency::where('is_deleted', 0)
                ->limit(5)
                ->select('id', 'name')
                ->get();
        }
        return response()->json($regency);
    }
    
    public function getProvince(Request $request)
    {
        $search = $request->search;
        if($search != ""){
            $provinsi = Province::where('is_deleted', 0)
                ->where('name', 'like', '%'.$search.'%')
                ->limit(5)
                ->select('id', 'name')
                ->get();
        }else{
            $provinsi = Province::where('is_deleted', 0)
                ->limit(5)
                ->select('id', 'name')
                ->get();
        }
        return response()->json($provinsi);
    }

}
