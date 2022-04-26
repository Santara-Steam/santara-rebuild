<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Popup;
use App\Models\PopupDetail;
use App\Models\trader;
use DB;
use Google\Cloud\Storage\StorageClient;

class PopupController extends Controller
{
    
    public function index()
    {
        $popups = Popup::join('pop_up_details as pp_detail', 'pp_detail.pop_up_id', '=', 'pop_up.id')
            ->where('pop_up.is_deleted', 0)
            ->orderBy('pp_detail.start_date', 'DESC')
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
        if($request->action_button == 1 && $request->action_text == ''){
            $request->action_text = 'Ok';
        }

        $data_array = [
            [
                'name' => 'is_active',
                'contents' => $request->is_active
            ],                        
            [
                'name' => 'title',
                'contents' => $request->title
            ],
            [
                'name' => 'type',
                'contents' => $request->type
            ],                        
            [
                'name' => 'action_text',
                'contents' => $request->action_text
            ],						
            [
                'name' => 'website_url',
                'contents' => $request->website_url
            ],
            [
                'name' => 'mobile_url',
                'contents' => $request->mobile_url
            ],
            [
                'name' => 'emiten_uuid',
                'contents' => null
            ],
            [
                'name' => 'start_date',
                'contents' => $request->start_date
            ],
            [
                'name' => 'finish_date',
                'contents' => $request->finish_date
            ]
        ];

        if($request->hasFile('website_pict')) {			
            $website_pict_photo = [
                [
                    'name' => 'website_pict',
                    'contents' => fopen($request->file('website_pict')->getPathName(), 'r'),
                    'filename' => $request->file('website_pict')->getClientOriginalName()
                ]
            ];

            $data_array = array_merge($data_array, $website_pict_photo);   
        }
        
        if($request->hasFile('mobile_pict')) {			
            $mobile_pict_photo = [
                [
                    'name' => 'mobile_pict',
                    'contents' => fopen($request->file('mobile_pict')->getPathName(), 'r'),
                    'filename' => $request->file('mobile_pict')->getClientOriginalName()
                ]
            ];

            $data_array = array_merge($data_array, $mobile_pict_photo);   
        }

        try {
            $client = new \GuzzleHttp\Client();       

            $response = $client->request('POST', config('global.BASE_API_CLIENT_URL').'/'.config('global.API_CLIENT_VERSION') . '/information/create-pop-up', [
                'headers' => [
                    'Authorization' => 'Bearer ' . app('request')->session()->get('token')
                ],
                'multipart' => $data_array
            ]);
            
            $notif = array(
                'message' => 'Berhasil menambahkan popup',
                'alert-type' => 'success'
            );
            return redirect('admin/cms/popup')->with($notif);

        } catch (\Exception $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            echo json_encode(['msg' => $statusCode]);         
        }

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
