<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    public function index()
    {
        return view('admin.category.index');
    }

    public function fethData(Request $request)
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

        $totalRecords = Category::where('is_deleted', 0)
            ->select('count(*) as allcount')
            ->count();
        $totalRecordswithFilter = Category::where('is_deleted', 0)
            ->where('category', 'like', '%' .$searchValue . '%')
            ->count();
        $categories = Category::where('is_deleted', 0)
            ->skip($start)
            ->take($rowperpage)
            ->orderBy('category', 'ASC')
            ->get();
        
        return response()->json([  
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $categories
        ]);
    }

    public function store(Request $request)
    {
        $simpan = Category::create([
            "uuid" => \Str::uuid(),
            "category" => $request->category,
            "is_deleted" => 0,
            "created_by" => \Auth::user()->id
        ]);
        return response()->json(["message" => "Berhasil Tambah Kategori"]);
    }

    public function update(Request $request, $id)
    {
        $update = Category::where('id', $id)->update([
            "category" => $request->category,
            "updated_at" => \Auth::user()->id
        ]);
        return response()->json(["message" => "Berhasil Update Kategori"]);
    }

    public function destroy($id)
    {
        $update = Category::where('id', $id)->delete();
        return response()->json(["message" => "Berhasil Hapus Kategori"]);
    }

}
