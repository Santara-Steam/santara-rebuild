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
use Google\Cloud\Storage\StorageClient;

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
        // $user = User::where('role_id',2)->get();
        $kategori = kategori::all();
        return view('front_end.daftar_bisnis.create',compact('kategori'));
    }

    public function validator(array $data){
        return Validator::make($data,[
            'company_name' => ['required'],
            'logo' => ['required'],
            
        ]);
    }
    public function store(Request $request)
    {
        // $this->validator($request->all())->validate();
        // $file = $request->file('logo')->store('logo_perusahaan', 'public');
        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);
        $folderName = 'santara.co.id/token';
        
        $namapt = emiten::where('company_name', 'like', '%' .  $request->get('company_name') . '%')->first();

        if ($namapt) {
            $notif = array(
                'message' => 'Nama Perusahaan Sama!!',
                'alert-type' => 'fail'
            );
    
            // $array = $logoFileSave.','.$coverFileSave.','.$galeriFileSave.','.$ownerFileSave;
            // dd($em);
            // return response()->json(['status' => 'Mantap']);
            return redirect()->back()->with($notif);
        }else{
        if($request->hasFile('thumbnail')){
            $extension = $request->file('thumbnail')->getClientoriginalExtension();
            $fileThumbnail = fopen($request->file('thumbnail')->getPathName(), 'r');
            $logoFileSave = 'thumbnail'.time().'.'.$extension;
            $pictures = $folderName.'/'.$logoFileSave;
            $bucket->upload($fileThumbnail, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);
        }else{
            $logoFileSave = 'noimage.jpg';
        }

        if($request->hasFile('banner')){
            $extension = $request->file('banner')->getClientoriginalExtension();
            $fileBanner = fopen($request->file('banner')->getPathName(), 'r');
            $coverFileSave = 'banner'.time().'.'.$extension;
            $pictures = $folderName.'/'.$coverFileSave;
            $bucket->upload($fileBanner, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);
        }else{
            $coverFileSave = 'noimage.jpg';
        }
        if($request->hasFile("galeri")){
            $extension = $request->file('galeri')->getClientoriginalExtension();
            $fileGaleri1 = fopen($request->file('galeri')->getPathName(), 'r');
            $galeri1FileSave = 'galeri1'.time().'.'.$extension;
            $pictures = $folderName.'/'.$galeri1FileSave;
            $bucket->upload($fileGaleri1, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);

            // $galeriNameWithExt = $request->file('galeri1')->getClientOriginalName() ;
            // $galeriFileName = pathinfo ($galeriNameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file('galeri1')->getClientoriginalExtension();
            // $galeriFileSave = 'galeri1'.time().'.'.$extension;
            // $path = $request->file('galeri1')->storeAs('public/pictures',$galeriFileSave) ;
        }else{
            $galeri1FileSave = 'noimage.jpg';
        }
        if($request->hasFile("galeri2")){
            $extension = $request->file('galeri2')->getClientoriginalExtension();
            $fileGaleri2 = fopen($request->file('galeri2')->getPathName(), 'r');
            $galeri2FileSave = 'galeri2'.time().'.'.$extension;
            $pictures = $folderName.'/'.$galeri2FileSave;
            $bucket->upload($fileGaleri2, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);

            // $galeri2NameWithExt = $request->file('galeri2')->getClientOriginalName() ;
            // $galeri2FileName = pathinfo ($galeri2NameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file('galeri2')->getClientoriginalExtension();
            // $galeri2FileSave = 'galeri2'.time().'.'.$extension;
            // $path = $request->file('galeri2')->storeAs('public/pictures',$galeri2FileSave) ;
        }else{
            $galeri2FileSave = 'noimage.jpg';
        }
        if($request->hasFile("galeri3")){
            $extension = $request->file('galeri3')->getClientoriginalExtension();
            $fileGaleri3 = fopen($request->file('galeri3')->getPathName(), 'r');
            $galeri3FileSave = 'galeri3'.time().'.'.$extension;
            $pictures = $folderName.'/'.$galeri3FileSave;
            $bucket->upload($fileGaleri3, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);

            // $galeri3NameWithExt = $request->file('galeri3')->getClientOriginalName() ;
            // $galeri3FileName = pathinfo ($galeri3NameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file('galeri3')->getClientoriginalExtension();
            // $galeri3FileSave = 'galeri3'.time().'.'.$extension;
            // $path = $request->file('galeri3')->storeAs('public/pictures',$galeri3FileSave) ;
        }else{
            $galeri3FileSave = 'noimage.jpg';
        }
        // if($request->hasFile("galeri1")){
        //     $galeri1NameWithExt = $request->file('galeri1')->getClientOriginalName() ;
        //     $galeri1FileName = pathinfo ($galeri1NameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('galeri1')->getClientoriginalExtension();
        //     $galeri1FileSave = 'galeri1'.time().'.'.$extension;
        //     $path = $request->file('galeri1')->storeAs('public/pictures',$galeri1FileSave) ;
        // }else{
        //     $galeri1FileSave = 'noimage.jpg';
        // }
        // if($request->hasFile("galeri2")){
        //     $galeri2NameWithExt = $request->file('galeri2')->getClientOriginalName() ;
        //     $galeri2FileName = pathinfo ($galeri2NameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('galeri2')->getClientoriginalExtension();
        //     $galeri2FileSave = 'galeri2'.time().'.'.$extension;
        //     $path = $request->file('galeri2')->storeAs('public/pictures',$galeri2FileSave) ;
        // }else{
        //     $galeri2ileSave = 'noimage.jpg';
        // }
        // if($request->hasFile("galeri3")){
        //     $galeri3NameWithExt = $request->file('galeri3')->getClientOriginalName() ;
        //     $galeri3FileName = pathinfo ($galeri3NameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('galeri3')->getClientoriginalExtension();
        //     $galeri3FileSave = 'galeri3'.time().'.'.$extension;
        //     $path = $request->file('galeri3')->storeAs('public/pictures',$galeri3FileSave) ;
        // }else{
        //     $galeri3FileSave = 'noimage.jpg';
        // }
        if($request->hasFile("owner")){
            $extension = $request->file('owner')->getClientoriginalExtension();
            $fileOwner = fopen($request->file('owner')->getPathName(), 'r');
            $ownerFileSave = 'owner'.time().'.'.$extension;
            $pictures = $folderName.'/'.$ownerFileSave;
            $bucket->upload($fileOwner, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);
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
            $logo = str_replace('storage/app/public/pictures/','',$request->logo);
        }
        if($request->cover == null){
            $cover = 'default2.png';
        }else{
            $cover = str_replace('storage/app/public/pictures/','',$request->cover);
        }
        if($request->galeri == null){
            $galeri = 'default.png';
        }else{
            $galeri = str_replace('storage/app/public/pictures/','',$request->galeri);
        }
        if($request->galeri2 == null){
            $galeri2 = 'default.png';
        }else{
            $galeri2 = str_replace('storage/app/public/pictures/','',$request->galeri2);
        }
        if($request->galeri3 == null){
            $galeri3 = 'default.png';
        }else{
            $galeri3 = str_replace('storage/app/public/pictures/','',$request->galeri3);
        }
        if($request->owner == null){
            $owner = 'default1.png';
        }else{
            $owner = str_replace('storage/app/public/pictures/','',$request->owner);
        }


        $em = new emiten();
        $em->uuid = \Str::uuid();
        $em->company_name = $request->get('company_name');
        $em->trademark = $request->get('nama_brand');
        $em->trader_id = Auth::user()->trader->id;
        $em->owner_name = $request->get('nama_owner');
        $em->category_id = $request->get('kategori');
        $em->price = str_replace(".", "", $request->get('harga_saham'));
        $em->avg_annual_turnover_previous_year = str_replace(".", "", $request->get('omset1'));
        $em->avg_annual_turnover_current_year = str_replace(".", "", $request->get('omset2'));
        $em->avg_capital_needs = str_replace(".", "", $request->get('perkiraan_dana'));
        $em->avg_general_share_amount = str_replace(".", "", $request->get('saham_dilepas'));
        $em->avg_turnover_after_becoming_a_publisher= str_replace(".", "", $request->get('omset_penerbit'));
        $em->avg_annual_dividen= str_replace(".", "", $request->get('deviden_tahunan'));
        $em->youtube= str_replace("youtu.be/", "www.youtube.com/embed/", $request->get('video_profile'));
        $em->facebook= $request->get('fb');
        $em->website= $request->get('web');
        $em->instagram= $request->get('ig');
        $em->business_description= $request->get('deskripsi');
        $em->admin_desc= $request->get('bio_owner');
        $em->pictures = $logo.','.$cover.','.$owner.','.$galeri.','.$galeri2.','.$galeri3;
        // $em->pictures = $logoFileSave.','.$coverFileSave.','.$ownerFileSave.','.$galeri1FileSave.','.$galeri2FileSave.','.$galeri3FileSave;
        $em->is_deleted = 0;
        $em->is_active = 0;
        $em->is_verified = 1;
        $em->is_pralisting = 1;
        $em->is_coming_soon = 1;
        $em->is_verified_by_ceo = 0;

        $em->save();

        $emj = new emiten_journey();
        $emj->emiten_id = $em->id;
        $emj->title = "Pra Penawaran Saham";
        $emj->save();
        $notif = array(
            'message' => 'Berhasil Mendaftarkan Bisnis!!',
            'alert-type' => 'success'
        );

        // dd($logo);

        // $array = $logoFileSave.','.$coverFileSave.','.$galeriFileSave.','.$ownerFileSave;
        // dd($em);
        // return response()->json(['status' => 'Mantap']);
        return redirect('/')->with($notif);
        }
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
