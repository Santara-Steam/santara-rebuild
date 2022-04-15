<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CRMController extends Controller
{
    
    public function viewTargetUser()
    {
        return view('admin.crm.index');
    }

    public function addTargetUser()
    {
        $type = 'create';
        return view('admin.crm.add-target-user', compact('type'));
    }

    public function editTargetUser($id)
    {
        $type = 'update';
        $target = $this->getTargetDetail($id);
        $list = [];
        foreach ($target['list'] as $key => $value) {
            $list[$value['id']] = $value['params'];
        }
        $target['list'] = $list;
        return view('admin.crm.add-target-user', compact('type', 'target'));
    }

    public function getListUserTarget(Request $request)
    {
        $start  = intval($request->start);
        $length = intval($request->length);

        $targets = $this->fetchTargetUser($start, $length);

        $data = [];

        if ($targets != null) {
            foreach ($targets['data'] as $target) {
                $list = null;
                foreach ($target['list'] as $k => $v) :
                    switch ($v['name']) {
                        case 'Status KYC':
                            $params = ($v['params'] == 1) ? 'Sudah KYC' : 'Belum KYC';
                            break;
                        case 'Gender':
                            $params = ($v['params'] == 'f') ? 'Perempuan' : 'Laki-laki';
                            break;
                        case 'Umur':
                            $params = $v['params'] . ' Tahun';
                            break;
                        case 'Kepemilikan Saham':
                        case 'Sisa Limit Investasi':
                            $params = $v['params']['text'];
                            break;
                        default:
                            $params = $v['params'];
                            break;
                    }

                    $list .= '<div class="col-md-3">
                            <div class="card border border-light rounded">
                                <div class="card-body">
                                <h4 class="card-title">' . $v['name'] . '</h4>
                                <p class="card-text">' . $params . '</p>
                                </div>
                            </div>
                        </div>';
                endforeach;

                $target_user  = '<div class="row justify-content-between my-1">
                                <label class="col-4"><b>' . $target['name'] . '</b></label>
                                <span class="col-2 text-right">
                                    <a href="'.url('admin/crm/edit-target-user').'/'.$target['id'].'" class="btn btn-sm btn-info-ghost">Edit</a>
                                    <button type="button" value="' . $target['id'] . '" class="btn btn-sm btn-info-ghost delete-target">Delete</a
                                </span>
                             </div>
                             <div class="row">' . $list . '</div>
                             <div class="row my-1">
                                <label class="col-2"><b>Target Count : </b> ' . $target['total_users'] . ' User</label>
                             </div>
                             ';

                array_push($data, [
                    $target_user
                ]);
            }
        }
        $output = [
            "data" => $data
        ];
        echo json_encode($output);
        exit();
    }

    private function getTargetDetail($id)
    {
        $result = null;
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', env('BASE_API_ADMIN_URL').env('API_ADMIN_VERSION').'broadcast/target/detail/'.$id, [
                'form_params' => [
                    'token' => app('request')->session()->get('token'),
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $detail = json_decode($response->getBody()->getContents(), TRUE);
                $result = $detail['data'];
            }
        } catch (\Exception $exception) {
            $result = null;
        }

        return $result;
    }


    public function fetchTargetUser($start, $length)
    {
        $limit = $start + 1;
        $offset = 5;
        $url = 'broadcast/target/?limit=' . $limit . '&offset=' . $offset;
        $result = null;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', env('BASE_API_ADMIN_URL').env('API_ADMIN_VERSION').$url, [
                'form_params' => [
                    'token' => app('request')->session()->get('token'),
                ]
            ]);
            if ($response->getStatusCode() == 200) {
                $target = json_decode($response->getBody()->getContents(), TRUE);
                $result = $target['data'];
            }
        } catch (\Exception $exception) {
            $result = null;
        }

        return $result;
    }

    public function addBroadcasting($targetId)
    {
        $target = $this->getDetailTargetUser($targetId);
        $list = [];
        foreach ($target['list'] as $key => $value) {
            $list[$value['id']] = $value['params'];
        }
        $target['list'] = $list;
        return response()->json(["data" => $target]);
    }

    public function getDetailTargetUser($id)
    {
        $result = null;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', env('BASE_API_ADMIN_URL').env('API_ADMIN_VERSION').'broadcast/target/detail/'.$id, [
                'form_params' => [
                    'token' => app('request')->session()->get('token'),
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $detail = json_decode($response->getBody()->getContents(), TRUE);
                $result = $detail['data'];
            }
        } catch (\Exception $exception) {
            $result = null;
        }

        return $result;
    }

    public function getVersion(Request $request)
    {
        $type = $request->type;
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', env('BASE_API_ADMIN_URL').env('API_ADMIN_VERSION').'broadcast/app-version?type=' . $type, [
                'form_params' => [
                    'token'  => app('request')->session()->get('token'),
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $version = json_decode($response->getBody()->getContents(), TRUE);
                $result = $version['data'];
            }
        } catch (\Exception $exception) {
            $result = null;
        }

        return response()->json($result);
    }

    public function saveTarget(Request $request)
    {
        $target['name'] = $request->target_name;
        $target['is_saved'] = (isset($request->target_is_save)) ? $request->target_is_save : 1;
        $target['target'] = [];
        foreach ($request->target as $k => $v) {
            if ($v != '') {
                if (($k == 10) && ($v == 'Unlimited')) {
                    $v = '999999999999';
                }
                $target_user = new \stdClass();
                $target_user->id = $k;
                $target_user->params = strip_tags($v);
                array_push($target['target'], $target_user);
            }
        }

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST',  env('BASE_API_ADMIN_URL').env('API_ADMIN_VERSION').'broadcast/target', [
                'headers' => [
                    'Authorization' => 'Bearer '.app('request')->session()->get('token'),
                    'Origin' => env('BASE_FILE_URL')
                ],
                'json' => $target
            ]);

            $data = json_decode($response->getBody()->getContents(), TRUE);
            echo json_encode(['msg' => $response->getStatusCode(), 'id' => $data['data']['id']]);
            return;
        } catch (\Exception $exception) {
            $exception->getResponse()->getStatusCode();
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $body = json_decode($responseBody, true);
            echo json_encode(['msg' => $body['message']]);
            return;
        }
    }

    public function updateTarget(Request $request)
    {
        $target['name'] = $request->target_name;
        $target['is_saved'] = 1;
        $target['target'] = [];
        foreach ($request->target as $k => $v) {
            if ($v) {
                $target_user = new \stdClass();
                $target_user->id = $k;
                $target_user->params = strip_tags($v);
                array_push($target['target'], $target_user);
            }
        }

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('PUT', env('BASE_API_ADMIN_URL').env('API_ADMIN_VERSION'). 'broadcast/target/' . $request->id, [
                'headers' => [
                    'Authorization' => 'Bearer '.app('request')->session()->get('token'),
                    'Origin' => env('BASE_FILE_URL')
                ],
                'json' => $target
            ]);

            $data = json_decode($response->getBody()->getContents(), TRUE);
            echo json_encode(['msg' => $response->getStatusCode()]);
            return;
        } catch (\Exception $exception) {
            $exception->getResponse()->getStatusCode();
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $body = json_decode($responseBody, true);
            echo json_encode(['msg' => $body['message']]);
            return;
        }
    }

    public function deleteTarget($id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('DELETE', env('BASE_API_ADMIN_URL').env('API_ADMIN_VERSION').'broadcast/targets/' . $id, [
                'form_params' => [
                    'token' => app('request')->session()->get('token'),
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                echo json_encode(['msg' => $response->getStatusCode()]);
            }
        } catch (\Exception $exception) {
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $body = json_decode($responseBody, true);
            echo json_encode(['msg' => $body['message']]);
            return;
        }
    }



}
