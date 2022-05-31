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
            ->select('pop_up.uuid', 'pop_up.is_active', 'pp_detail.*')
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
        if($request->action_button == 1 && $request->action_text == ''){
            $request->action_text = 'Ok';
        }

        $data_array = [
            [
                'name' => 'uuid',
                'contents' => $id
            ],
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

            $response = $client->request('PUT', config('global.BASE_API_CLIENT_URL').'/'.config('global.API_CLIENT_VERSION') . '/information/update-pop-up', [
                'headers' => [
                    'Authorization' => 'Bearer ' . app('request')->session()->get('token')
                ],
                'multipart' => $data_array
            ]);
            
            echo json_encode(['msg' => $response->getStatusCode()]);
            $code = $response->getStatusCode();
            if($code == 200){
                $notif = array(
                    'message' => 'Berhasil mengubah popup',
                    'alert-type' => 'success'
                );
            }else{
                $notif = array(
                    'message' => 'Gagal mengubah popup',
                    'alert-type' => 'alert'
                );
            }
            return redirect('admin/cms/popup')->with($notif);

        } catch (\Exception $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            echo json_encode(['msg' => $statusCode]);         
        }
    }

    public function destroy($id)
    {
        Popup::where('uuid', $id)->update([
            'is_deleted' => 1
        ]);
        echo json_encode(['msg' => 200]);
    }
}
