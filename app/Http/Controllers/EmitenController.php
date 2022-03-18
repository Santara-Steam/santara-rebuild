<?php

namespace App\Http\Controllers;

use App\Models\emiten;
use App\Models\emiten_journey;
use App\Models\kategori;
use App\Models\trader;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmitenController extends Controller
{
    //
    public function index(){
        $emiten = emiten::where('emitens.is_deleted',0)
        ->select('emitens.*','categories.category as ktg','emiten_journeys.title as sts','emiten_journeys.date as sd', 'emiten_journeys.end_date as ed')
        ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        ->join('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        ->whereRaw('emiten_journeys.created_at in (SELECT max(created_at) from emiten_journeys GROUP BY emiten_journeys.emiten_id)')
        ->get();
        
        return view('admin.emiten.index',compact('emiten'));
    }

    public function add(){
        $user = User::where('role_id',2)->get();
        $kategori = kategori::all();
        return view('admin.emiten.add',compact('kategori','user'));
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
        if($request->logo == null){
            $logo = 'default1.png';
        }else{
            $logo = str_replace('public/upload/','',$request->logo);
        }
        if($request->cover == null){
            $cover = 'default2.png';
        }else{
            $cover = str_replace('public/upload/','',$request->cover);
        }
        if($request->galeri == null){
            $galeri = 'default.png';
        }else{
            $galeri = str_replace('public/upload/','',$request->galeri);
        }
        if($request->galeri2 == null){
            $galeri2 = 'default.png';
        }else{
            $galeri2 = str_replace('public/upload/','',$request->galeri2);
        }
        if($request->galeri3 == null){
            $galeri3 = 'default.png';
        }else{
            $galeri3 = str_replace('public/upload/','',$request->galeri3);
        }
        if($request->owner == null){
            $owner = 'default1.png';
        }else{
            $owner = str_replace('public/upload/','',$request->owner);
        }


        $em = new emiten();
        $em->company_name = $request->get('company_name');
        $em->trader_id = $request->get('pemilik');
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
        $em->pictures = $logo.','.$cover.','.$owner.','.$galeri.','.$galeri2.','.$galeri3;
        $em->save();

        $emj = new emiten_journey();
        $emj->emiten_id = $em->id;
        $emj->title = "Pra Penawaran Saham";
        $emj->save();
        $notif = array(
            'message' => 'Emiten Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        // $array = $logoFileSave.','.$coverFileSave.','.$galeriFileSave.','.$ownerFileSave;
        // dd($em);
        // return response()->json(['status' => 'Mantap']);
        return redirect('/admin/emiten')->with($notif);
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
        if(empty($picture[4])){
            $picture[4] = '-';
        }else{
            $picture[4];
        }
        if(empty($picture[5])){
            $picture[5] = '-';
        }else{
            $picture[5];
        }
        if(empty($picture[6])){
            $picture[6] = '-';
        }else{
            $picture[6];
        }
        $kategori = kategori::all();
        $user = User::where('role_id',2)->get();
        // dd($s);
        return view('admin.emiten.edit',compact('kategori','emiten','picture','user'));
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
        if(empty($picture[4])){
            $picture[4] = '-';
        }else{
            $picture[4];
        }
        if(empty($picture[5])){
            $picture[5] = '-';
        }else{
            $picture[5];
        }
        if(empty($picture[6])){
            $picture[6] = '-';
        }else{
            $picture[6];
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

        if($request->logo == null){
            $logo = 'default1.png';
        }else{
            $logo = str_replace('public/upload/','',$request->logo);
        }
        if($request->cover == null){
            $cover = 'default2.png';
        }else{
            $cover = str_replace('public/upload/','',$request->cover);
        }
        if($request->galeri == null){
            $galeri = 'default.png';
        }else{
            $galeri = str_replace('public/upload/','',$request->galeri);
        }
        if($request->galeri2 == null){
            $galeri2 = 'default.png';
        }else{
            $galeri2 = str_replace('public/upload/','',$request->galeri2);
        }
        if($request->galeri3 == null){
            $galeri3 = 'default.png';
        }else{
            $galeri3 = str_replace('public/upload/','',$request->galeri3);
        }
        if($request->owner == null){
            $owner = 'default1.png';
        }else{
            $owner = str_replace('public/upload/','',$request->owner);
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
        $emiten->pictures = $logo.','.$cover.','.$owner.','.$galeri.','.$galeri2.','.$galeri3;
        $emiten->code_emiten = $request->get('code_emiten');
        $emiten->trademark = $request->get('brand');
        $emiten->price = $request->get('harga_saham');
        $emiten->save();
        $notif = array(
            'message' => 'Penerbit Berhasil Di Edit',
            'alert-type' => 'success'
        );
        // dd($logoFileSave);
        return redirect('/admin/emiten')->with($notif);
    }

    public function delete($id){
        $emiten = emiten::where('id',$id)->first();
        $emiten->is_deleted = 1;
        $emiten->save();
        $notif = array(
            'message' => 'Emiten Berhasil Di Hapus',
            'alert-type' => 'success'
        );
        return redirect('/admin/emiten')->with($notif);
    }

    public function emiten_status(Request $request,$id){
        $emj = new emiten_journey();
        $emj->emiten_id = $id;
        $emj->title = $request->get('title');
        $emj->date = $request->get('start_date');
        $emj->end_date = $request->get('end_date');
        $emj->save();

        $notif = array(
            'message' => 'Update Status Emiten Berhasil!!',
            'alert-type' => 'success'
        );

        return redirect('/admin/emiten')->with($notif);
    }
    public function logocropImg()
    {
          $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'public/upload/logo_' . time() . '.png';
            file_put_contents($image_name, $data);
            echo $image_name;
    }
    public function galericropImg()
    {
          $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'public/upload/galeri_' . time() . '.png';
            file_put_contents($image_name, $data);
            echo $image_name;
    }
    public function covercropImg()
    {
          $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'public/upload/cover_' . time() . '.png';
            file_put_contents($image_name, $data);
            echo $image_name;
    }
    public function ownercropImg()
    {
          $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'public/upload/owner_' . time() . '.png';
            file_put_contents($image_name, $data);
            echo $image_name;
    }
}
