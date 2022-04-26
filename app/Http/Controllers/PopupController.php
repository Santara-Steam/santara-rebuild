<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Popup;
use App\Models\PopupDetail;
use Google\Cloud\Storage\StorageClient;

class PopupController extends Controller
{
    
    public function index()
    {
        $popups = Popup::join('pop_up_details as pp_detail', 'pp_detail.pop_up_id', '=', 'pop_up.id')
            ->where('pop_up.is_deleted', 0)
            ->select('pop_up.uuid', 'pop_up.is_active', 'pp_detail.title', 
                'pp_detail.type', 'pp_detail.start_date', 'pp_detail.finish_date')
            ->get();
        return view('admin.cms.popup.index', compact('popups'));
    }

    public function create()
    {
        return view('admin.cms.popup.add');
    }

    public function edit($uuid)
    {
        $popup = Popup::join('pop_up_details as pp_detail', 'pp_detail.pop_up_id', '=', 'pop_up.id')
            ->where('pop_up.is_deleted', 0)
            ->where('pop_up.uuid', $uuid)
            ->select('pop_up.uuid', 'pop_up.is_active', 'pop_up.title', 
                'pop_up.type', 'pop_up.start_date', 'pop_up.finish_date')
            ->first();
        return view('admin.cms.popup.edit', compact('popup'));
    }

    public function store(Request $request)
    {
        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);

        $filePicture = fopen($request->file('website_pict')->getPathName(), 'r');
        $newFolderName = 'santara.co.id/popup';
        $website_pict = $newFolderName.'/'.$request->file('website_pict')->getClientOriginalName();
        $bucket->upload($filePicture, [
            'predefinedAcl' => 'publicRead',
            'name' => $website_pict
        ]);

        $filePicture2 = fopen($request->file('mobile_pict')->getPathName(), 'r');
        $mobile_pict = $newFolderName.'/'.$request->file('mobile_pict')->getClientOriginalName();
        $bucket->upload($filePicture2, [
            'predefinedAcl' => 'publicRead',
            'name' => $mobile_pict
        ]);

        DB::transaction(function() use ($request) {
            $popup = new Popup();
            $popup->uuid = \Str::uuid();
            $popup->is_active = $request->is_active;
            $popup->created_by = \Auth::user()->id;
            $popup->save();

            $popupDetail = new PopupDetail();
            $popupDetail->uuid = \Str::uuid();
            $popupDetail->pop_up_id = $popup->id;
            $popupDetail->title = $request->title;
            $popupDetail->type = $request->type;
            $popupDetail->action_text = $request->action_text;
            $popupDetail->website_pict = $request->file('website_pict')->getClientOriginalName();
            $popupDetail->mobile_pict = $request->file('mobile_pict')->getClientOriginalName();
            $popupDetail->website_url = $request->website_url;
            $popupDetail->mobile_url = $request->mobile_url;
            $popupDetail->start_date = $request->start_date;
            $popupDetail->finish_date = $request->finish_date;
            $popupDetail->save();
        });

        $notif = array(
            'message' => 'Berhasil menambahkan popup',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/popup')->with($notif);

    }

    public function update(Request $request, $id)
    {
        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);

        if($request->hasFile('website_pict')){
            $filePicture = fopen($request->file('website_pict')->getPathName(), 'r');
            $newFolderName = 'santara.co.id/popup';
            $website_pict = $newFolderName.'/'.$request->file('website_pict')->getClientOriginalName();
            $bucket->upload($filePicture, [
                'predefinedAcl' => 'publicRead',
                'name' => $website_pict
            ]);
        }

        if($request->hasFile('mobile_pict')){
            $filePicture2 = fopen($request->file('mobile_pict')->getPathName(), 'r');
            $mobile_pict = $newFolderName.'/'.$request->file('mobile_pict')->getClientOriginalName();
            $bucket->upload($filePicture2, [
                'predefinedAcl' => 'publicRead',
                'name' => $mobile_pict
            ]);
        }

        DB::transaction(function() use ($request, $id) {
            $popup = Popup::where('uuid', $id)->update([
                'uuid' => \Str::uuid(),
                'is_active' => $request->is_active,
                'updated_by' => \Auth::user()->id
            ]);

            $popupDetail = Popup::where('uuid', $id)->first();

            if($request->hasFile('website_pict')){
                $popupDetail = PopupDetail::where('pop_up_id', $popupDetail->id)
                    ->update([
                        'title' => $request->title,
                        'type' => $request->type,
                        'action_text' => $request->action_text,
                        'website_pict' => $request->file('website_pict')->getClientOriginalName(),
                        'website_url' => $request->website_url,
                        'mobile_url' => $request->mobile_url,
                        'start_date' => $request->start_date,
                        'finish_date' => $request->finish_date
                    ]);
            }elseif($request->hasFile('mobile_pict')){
                $popupDetail = PopupDetail::where('pop_up_id', $popupDetail->id)
                    ->update([
                        'title' => $request->title,
                        'type' => $request->type,
                        'action_text' => $request->action_text,
                        'mobile_pict' => $request->file('mobile_pict')->getClientOriginalName(),
                        'website_url' => $request->website_url,
                        'mobile_url' => $request->mobile_url,
                        'start_date' => $request->start_date,
                        'finish_date' => $request->finish_date
                    ]);
            }else{
                $popupDetail = PopupDetail::where('pop_up_id', $popupDetail->id)
                    ->update([
                        'title' => $request->title,
                        'type' => $request->type,
                        'action_text' => $request->action_text,
                        'website_url' => $request->website_url,
                        'mobile_url' => $request->mobile_url,
                        'start_date' => $request->start_date,
                        'finish_date' => $request->finish_date
                    ]);
            }
        });

        $notif = array(
            'message' => 'Berhasil mengubah popup',
            'alert-type' => 'success'
        );
        return redirect('admin/cms/popup')->with($notif);
    
    }

    public function destroy($id)
    {
        Popup::where('uuid', $id)->update([
            'is_deleted' => 0
        ]);
        echo json_encode(['msg' => 200]);
    }
}
