<?php

namespace App\Http\Controllers;

use App\Models\emiten;
use App\Models\emiten_journey;
use App\Models\kategori;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmitenController extends Controller
{
    //
    public function index(){
        $emiten = emiten::where('emitens.is_deleted',0)
        ->select('emitens.*','categories.category as ktg','emiten_journeys.title as sts')
        ->join('categories', 'categories.id','=','emitens.category_id')
        ->join('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        ->whereRaw('emiten_journeys.created_at in (SELECT max(created_at) from emiten_journeys GROUP BY emiten_journeys.emiten_id)')
        ->get();
        
        return view('admin.emiten.index',compact('emiten'));
    }

    public function add(){
        $kategori = kategori::all();
        return view('admin.emiten.add',compact('kategori'));
    }

    public function validator(array $data){
        return Validator::make($data,[
            'company_name' => ['required'],
            'logo' => ['required'],
            
        ]);
    }
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        // $file = $request->file('logo')->store('logo_perusahaan', 'public');
        if($request->hasFile("logo")){
            $logoNameWithExt = $request->file('logo')->getClientOriginalName() ;
            $logoFileName = pathinfo ($logoNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientoriginalExtension();
            $logoFileSave = 'logo'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs('public/pictures',$logoFileSave) ;
        }else{
            $logoFileSave = 'noimage.jpg';
        }
        if($request->hasFile("cover")){
            $coverNameWithExt = $request->file('cover')->getClientOriginalName() ;
            $coverFileName = pathinfo ($coverNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover')->getClientoriginalExtension();
            $coverFileSave = 'cover'.time().'.'.$extension;
            $path = $request->file('cover')->storeAs('public/pictures',$coverFileSave) ;
        }else{
            $coverFileSave = 'noimage.jpg';
        }
        if($request->hasFile("galeri")){
            $galeriNameWithExt = $request->file('galeri')->getClientOriginalName() ;
            $galeriFileName = pathinfo ($galeriNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('galeri')->getClientoriginalExtension();
            $galeriFileSave = 'galeri'.time().'.'.$extension;
            $path = $request->file('galeri')->storeAs('public/pictures',$galeriFileSave) ;
        }else{
            $galeriFileSave = 'noimage.jpg';
        }
        if($request->hasFile("owner")){
            $ownerNameWithExt = $request->file('owner')->getClientOriginalName() ;
            $ownerFileName = pathinfo ($ownerNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('owner')->getClientoriginalExtension();
            $ownerFileSave = 'owner'.time().'.'.$extension;
            $path = $request->file('owner')->storeAs('public/pictures',$ownerFileSave) ;
        }else{
            $ownerFileSave = 'noimage.jpg';
        }
        // emiten::insert([
        //     'company_name' => $request->get('company_name'),
        //     'pictures' => $logoFileSave,
        // ]);

        $em = new emiten();
        $em->company_name = $request->get('company_name');
        $em->owner_name = $request->get('nama_owner');
        $em->category_id = $request->get('kategori');
        $em->avg_annual_turnover_previous_year = $request->get('omset1');
        $em->avg_annual_turnover_current_year = $request->get('omset2');
        $em->avg_capital_needs = $request->get('perkiraan_dana');
        $em->avg_general_share_amount = $request->get('saham_dilepas');
        $em->avg_turnover_after_becoming_a_publisher= $request->get('omset_penerbit');
        $em->avg_annual_dividen= $request->get('deviden_tahunan');
        $em->youtube= $request->get('video_profile');
        $em->facebook= $request->get('fb');
        $em->website= $request->get('web');
        $em->instagram= $request->get('ig');
        $em->business_description= $request->get('deskripsi');
        $em->pictures = $logoFileSave.','.$coverFileSave.','.$galeriFileSave.','.$ownerFileSave;
        $em->save();

        $emj = new emiten_journey();
        $emj->emiten_id = $em->id;
        $emj->title = "Pra Penawaran Saham";
        $emj->save();
        $notif = array(
            'message' => 'Data Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        $array = $logoFileSave.','.$coverFileSave.','.$galeriFileSave.','.$ownerFileSave;
        // dd($em);
        // return response()->json(['status' => 'Mantap']);
        return redirect('/admin/emiten');
    }

    public function edit(emiten $emiten,$id){
        $emiten = emiten::where('id',$id)->first();
        $picture = explode(',',$emiten->pictures);
        if(empty($picture[0])){
            $picture[0] = '-';
        }else{
            $picture[0];
        }
        if(empty($picture[1])){
            $picture[1] = '-';
        }else{
            $picture[1];
        }
        if(empty($picture[2])){
            $picture[2] = '-';
        }else{
            $picture[2];
        }
        if(empty($picture[3])){
            $picture[3] = '-';
        }else{
            $picture[3];
        }
        $kategori = kategori::all();
        // dd($s);
        return view('admin.emiten.edit',compact('kategori','emiten','picture'));
    }

    public function update(request $request,emiten $emiten,$id){
        $emiten = emiten::where('id',$id)->first();
        $picture = explode(',',$emiten->pictures);

        if(empty($picture[0])){
            $picture[0] = '-';
        }else{
            $picture[0];
        }
        if(empty($picture[1])){
            $picture[1] = '-';
        }else{
            $picture[1];
        }
        if(empty($picture[2])){
            $picture[2] = '-';
        }else{
            $picture[2];
        }
        if(empty($picture[3])){
            $picture[3] = '-';
        }else{
            $picture[3];
        }

        if($request->hasFile("logo")){
            $logoNameWithExt = $request->file('logo')->getClientOriginalName() ;
            $logoFileName = pathinfo ($logoNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientoriginalExtension();
            $logoFileSave = 'logo'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs('public/pictures',$logoFileSave) ;
        }else{
            $logoFileSave = $picture[0];
        }

        if($request->hasFile("cover")){
            $coverNameWithExt = $request->file('cover')->getClientOriginalName() ;
            $coverFileName = pathinfo ($coverNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover')->getClientoriginalExtension();
            $coverFileSave = 'cover'.time().'.'.$extension;
            $path = $request->file('cover')->storeAs('public/pictures',$coverFileSave) ;
        }else{
            $coverFileSave = $picture[1];
        }
        if($request->hasFile("galeri")){
            $galeriNameWithExt = $request->file('galeri')->getClientOriginalName() ;
            $galeriFileName = pathinfo ($galeriNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('galeri')->getClientoriginalExtension();
            $galeriFileSave = 'galeri'.time().'.'.$extension;
            $path = $request->file('galeri')->storeAs('public/pictures',$galeriFileSave) ;
        }else{
            $galeriFileSave = $picture[2];
        }
        if($request->hasFile("owner")){
            $ownerNameWithExt = $request->file('owner')->getClientOriginalName() ;
            $ownerFileName = pathinfo ($ownerNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('owner')->getClientoriginalExtension();
            $ownerFileSave = 'owner'.time().'.'.$extension;
            $path = $request->file('owner')->storeAs('public/pictures',$ownerFileSave) ;
        }else{
            $ownerFileSave = $picture[3];
        }

        $emiten->company_name = $request->get('company_name');
        $emiten->owner_name = $request->get('nama_owner');
        $emiten->category_id = $request->get('kategori');
        $emiten->avg_annual_turnover_previous_year = $request->get('omset1');
        $emiten->avg_annual_turnover_current_year = $request->get('omset2');
        $emiten->avg_capital_needs = $request->get('perkiraan_dana');
        $emiten->avg_general_share_amount = $request->get('saham_dilepas');
        $emiten->avg_turnover_after_becoming_a_publisher= $request->get('omset_penerbit');
        $emiten->avg_annual_dividen= $request->get('deviden_tahunan');
        $emiten->youtube= $request->get('video_profile');
        $emiten->facebook= $request->get('fb');
        $emiten->website= $request->get('web');
        $emiten->instagram= $request->get('ig');
        $emiten->business_description= $request->get('deskripsi');
        $emiten->pictures = $logoFileSave.','.$coverFileSave.','.$galeriFileSave.','.$ownerFileSave;
        $emiten->code_emiten = $request->get('code_emiten');
        $emiten->trademark = $request->get('brand');
        $emiten->price = $request->get('harga_saham');
        $emiten->save();

        // dd($logoFileSave);
        return redirect('/admin/emiten');
    }

    public function delete($id){
        $emiten = emiten::where('id',$id)->first();
        $emiten->is_deleted = 1;
        $emiten->save();

        return redirect('/admin/emiten');
    }
}
