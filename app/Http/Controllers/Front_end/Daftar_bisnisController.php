<?php

namespace App\Http\Controllers\Front_end;

use App\Models\emiten;
use App\Models\emiten_journey;
use App\Models\kategori;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Daftar_bisnisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front_end/daftar_bisnis/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $user = User::where('role_id',2)->get();
        $kategori = kategori::all();
        return view('front_end.daftar_bisnis.create',compact('kategori','user'));
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
        $em->trader_id = Auth::user()->trader->id;
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
            'message' => 'Berhasil Mendaftarkan Bisnis!!',
            'alert-type' => 'success'
        );

        $array = $logoFileSave.','.$coverFileSave.','.$galeriFileSave.','.$ownerFileSave;
        // dd($em);
        // return response()->json(['status' => 'Mantap']);
        return redirect('/')->with($notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
