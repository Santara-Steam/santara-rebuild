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

    public function viewTargetUserTersedia()
    {
        return view('admin.crm.target-user');
    }

    public function viewListBroadcasting()
    {
        return view('admin.crm.broadcasting');
    }

    public function viewAddBroadcastiong()
    {
        $type = 'create';
        return view('admin.crm.add-broadcasting', compact('type'));
    }

    public function getBroadcasting(Request $request)
    {
        $start  = intval($request->start);
        $length = intval($request->length);

        $broadcasts = $this->fetchBroadcastingData($start, $length);

        $data = [];
        $no   = 1;

        if ($broadcasts != null) {
            foreach ($broadcasts as $broadcast) {
                $action       = '<a href="'.url('admin/crm/target-user-tersedia').'/'. $broadcast['id'] . '" class="btn btn-sm btn-santara-white">Detail</a>';
                if ($broadcast['status'] == 'draft' || $broadcast['status'] == 'scheduled') {
                    $action       = '
                        <a href="'.url("admin/push-notif").'/'.$broadcast['id'] . '" class="btn btn-sm btn-success">Push <i
                        class="la la-bell"></i></a>
                        <a href="'.url("admin/crm/broadcasting/edit").'/'. $broadcast['id'] . '" class="btn btn-sm btn-info-ghost">Edit</a>
                        <button type="button" value="' . $broadcast['id'] . '" class="btn btn-sm btn-danger delete-broadcast">Delete</a>
                ';
                }

                array_push($data, [
                    $no++,
                    $broadcast['name'],
                    ucfirst($broadcast['type']),
                    $broadcast['send_on'],
                    $broadcast['send_at'],
                    ucfirst($broadcast['status']),
                    $action
                ]);
            }
        }
        $output = [
            "data" => $data
        ];
        echo json_encode($output);
        exit();
    }

    public function fetchBroadcastingData($start, $length)
    {
        $limit = $start + 1;
        $offset = $length;
        $url = 'broadcast/?limit='.$limit.'&offset='.$offset;

        $result = null;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').$url, [
                'form_params' => [
                    'token' => app('request')->session()->get('token'),
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $broadcast = json_decode($response->getBody()->getContents(), TRUE);
                $result = ($broadcast['data']['total'] > 0) ? $broadcast['data']['data'] : '';
            }
        } catch (\Exception $exception) {
            $result = null;
        }

        return $result;
    }

    public function getListUserTargetTersedia(Request $request)
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
                                <div class="col-4 text-right">
                                    <a type="button" href="'.url('admin/crm/add-broadcasting').'/'. $target['id'] . '" class="btn btn-sm btn-santara-red">Gunakan Target User</a>
                                </div>
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
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'broadcast/target/detail/'.$id, [
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
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').$url, [
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
        $type = 'create';
        return view('admin.crm.add-broadcasting', compact('type', 'target'));
    }

    public function editBroadcasting($id)
    {
        $broadcast = $this->getBroadcastingDetail($id);
        $target = ($broadcast) ? $this->getTargetDetail($broadcast['broadcast_target_group_id']) : null;

        if($target) :
            $list = [];
            foreach ($target['list'] as $key => $value) {
                $list[$value['id']] = $value['params'];
            }
            $target['list'] = $list;
        endif;
        $type = 'update';
        return view('admin.crm.add-broadcasting', compact('type', 'target', 'broadcast'));
    }

    public function getDetailTargetUser($id)
    {
        $result = null;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'broadcast/target/detail/'.$id, [
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
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'broadcast/app-version?type=' . $type, [
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
                $v = str_replace(".", "", $v);
                $target_user = new \stdClass();
                $target_user->id = $k;
                $target_user->params = strip_tags($v);
                array_push($target['target'], $target_user);
            }
        }

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST',  config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'broadcast/target', [
                'headers' => [
                    'Authorization' => 'Bearer '.app('request')->session()->get('token'),
                    'Origin' => config('global.BASE_FILE_URL')
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
            $response = $client->request('PUT', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION'). 'broadcast/target/' . $request->id, [
                'headers' => [
                    'Authorization' => 'Bearer '.app('request')->session()->get('token'),
                    'Origin' => config('global.BASE_FILE_URL')
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
            $response = $client->request('DELETE', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'broadcast/targets/' . $id, [
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

    public function saveKonten(Request $request)
    {
        $input = $request->data;
        $url = config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'broadcast';
        $method = 'POST';
        if ($request->type == 'update') :
            $url = config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'broadcast/' . $request->broadcast_id;
            $method = 'PUT';
        endif;

        // $image = [ 0 => 'no-image.jpg', 1 => 'no-image.jpg' ];

        $method_upload = 'POST';
        for ($i = 0; $i < count($_FILES['data_image']); $i++) {
            $image[$i] = isset($input[$i]['filename']) ? $input[$i]['filename'] : '';
            if (isset($_FILES['data_image']['name'][$i]) && !$_FILES['data_image']['error'][$i]) {
                $data = [
                    [
                        'name' => 'location',
                        'contents' => 'broadcast/'
                    ], [
                        'name' => 'image',
                        'contents' => fopen($_FILES['data_image']['tmp_name'][$i], 'r'),
                        'filename' => $_FILES['data_image']['name'][$i]
                    ], [
                        'name' => 'type',
                        'contents' => 'images'
                    ]
                ];

                if (($request->type == 'update') && !empty($input[$i]['filename'])) :
                    $method_upload = 'PUT';
                    $data = [
                        [
                            'name' => 'location',
                            'contents' => 'broadcast/'
                        ], [
                            'name' => 'image',
                            'contents' => fopen($_FILES['data_image']['tmp_name'][$i], 'r'),
                            'filename' => $_FILES['data_image']['name'][$i]
                        ], [
                            'name' => 'type',
                            'contents' => 'images'
                        ], [
                            'name' => 'filename',
                            'contents' => isset($input[$i]['filename']) ? $input[$i]['filename'] : ''
                        ]
                    ];

                endif;

                try {
                    $client = new \GuzzleHttp\Client();

                    $response = $client->request($method_upload, config('global.BASE_API_ADMIN_URL').'upload', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                        ],
                        'multipart' => $data
                    ]);

                    $responseImage = json_decode($response->getBody()->getContents(), TRUE);
                    $image[$i] = $responseImage['data']['filename'];
                } catch (\Exception $exception) {
                    $image[$i] = isset($input[$i]['filename']) ? $input[$i]['filename']    : '';
                }
            }
        }

        foreach ($input as $key => $value) {
            $input[$key] = (object)$value;
            $input[$key]->image = isset($image[$key]) ? $image[$key] : '';
        }

        $konten['title'] = $request->konten_title;
        $konten['date'] = date("Y-m-d", strtotime($request->konten_date));
        $konten['time'] = $request->konten_time;
        $konten['type'] = (isset($request->konten_type) && $request->konten_type == 1) ? 'split' : 'regular';
        $konten['broadcast_categories_id'] = $request->konten_broadcast_categories_id;
        $konten['data'][] = ($konten['type'] == 'regular') ? $input[0] : $input;
        $konten = (object) $konten;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request($method,  $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . app('request')->session()->get('token')
                ],
                'json' => $konten
            ]);

            $data_return = json_decode($response->getBody()->getContents(), TRUE);
            $broadcast_id = $data_return['data']['id'];
            if ($request->type == 'update') :
                $broadcast_id = $request->broadcast_id;
            endif;
            $preview = null;
            if ($response->getStatusCode() == 200) {
                $preview = $this->getBroadcastingDetail($broadcast_id);
            }

            echo json_encode([
                'msg' => $response->getStatusCode(),
                'list' => $preview['list'],
                'target' => $preview['target'],
                'users' => $preview['users'],
                'broadcast_id' => $broadcast_id
            ]);
        } catch (\Exception $exception) {
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $body = json_decode($responseBody, true);
            echo json_encode(['msg' => $body]);
            return;
        }
    }

    public function savePublish(Request $request)
    {
        $id = $request->broadcast_id;
        $status = 'scheduled';

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('PUT', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'broadcast/status/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . app('request')->session()->get('token')
                ],
                'form_params' => [
                    'status'         => strip_tags($status)
                ]
            ]);

            echo json_encode(['msg' => $response->getStatusCode()]);
        } catch (\Exception $exception) {
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $body = json_decode($responseBody, true);
            echo json_encode(['msg' => $body['message']]);
            return;
        }
    }

    public function deleteBroadcasting($id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('DELETE', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION') . 'broadcast/' . $id, [
                'form_params' => [
                    'token'     => app('request')->session()->get('token'),
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

    public function getBroadcastingDetail($id)
    {
        $result = null;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION') . 'broadcast/detail/' . $id, [
                'form_params' => [
                    'token'  => app('request')->session()->get('token'),
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

    public function getCategories()
    {
        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION') . 'broadcast/categories', [
                'form_params' => [
                    'token' => app('request')->session()->get('token'),
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $categories = json_decode($response->getBody()->getContents(), TRUE);
                $result = $categories['data'];
            }
        } catch (\Exception $exception) {
            $result = null;
        }

        echo json_encode($result);
    }


}
