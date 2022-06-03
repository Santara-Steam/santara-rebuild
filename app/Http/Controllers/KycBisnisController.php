<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class KycBisnisController extends Controller
{

    public function konfirmasi($uuid)
    {
        return $this->detail( $uuid , 'konfirmasi');
    }
    
    public function detail($uuid, $action)
    {
        if($action == 'edit'){
            $country = DB::table('countries')->where('is_deleted', 0)->get();
            $province = DB::table('provinces')->where('is_deleted', 0)->get();
            $regencies = DB::table('regencies')->where('is_deleted', 0)->get();
            $kyc['address']['country'] = $country;
            $kyc['address']['province'] = $province;
            $kyc['address']['regencies'] = $regencies;
        }

        $kyc = $this->dataKyc($uuid);
		$tab = $this->dataTab($uuid);

        $active = 'kyc-bisnis';
        $title = 'Detail KYC Bisnis';
        $update_url = url('admin/kyc-bisnis/update_url');
        $confirm_url = url('admin/kyc-bisnis/confirm_url');
        $form_footer = 'form_footer';

        return view('admin.kyc_bisnis.detail', compact('active', 'kyc', 'tab', 'action', 'title', 
            'update_url', 'confirm_url', 'form_footer'));

    }

    private function dataKyc($uuid) {
		$kyc = array();
		$tab = array(
			'1' => 'biodata-perusahaan', 
			'2' => 'pajak-perizinan', 
			'3' => 'alamat', 
			'4' => 'penanggung-jawab', 
			'5' => 'aset-perusahaan', 
			'6' => 'profit-preferensi',
			'7' => 'dokumen-perusahaan', 
			'8' => 'bank-perusahaan'); 

		foreach ($tab as $k => $v): 
			$kyc[$k] = $this->getDetailKyc($uuid,$k,$v);
		endforeach;

		return $kyc;
	}

    private function getDetailKyc($uuid, $phase, $page) {
		$data = null;

        try {
            $client = new \GuzzleHttp\Client();
                    
            $headers = [
                'Authorization' => 'Bearer ' . app('request')->session()->get('token'),        
                'Accept'        => 'application/json',
                'Content-type'  => 'application/json'
            ];
            
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . 'traders/company-'.$phase.'/' . $uuid, [
                'headers' => $headers,
			]);

            if ( $response->getStatusCode() == 200 ) {
                $data= json_decode($response->getBody()->getContents(), TRUE);
            }
        } catch (\Exception $exception) {
            $data = null;
		}

		$kyc = (object)[
			'data' 		=> (count((array)$data) > 0) ? (object)$data : null,
			'page' 		=> $page,
			'uuid' 		=> $uuid
		];
		
		return $kyc;		
	}

    private function dataTab($uuid){
		$data = null;

        try {
            $client = new \GuzzleHttp\Client();
                    
            $headers = [
                'Authorization' => 'Bearer ' . app('request')->session()->get('token'),        
                'Accept'        => 'application/json',
                'Content-type'  => 'application/json'
            ];
            
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . 'traders/status-kyc-trader/'. $uuid, [
                'headers' => $headers,
			]);

            if ( $response->getStatusCode() == 200 ) {
                $data= (object)json_decode($response->getBody()->getContents(), TRUE);
            }
        } catch (\Exception $exception) {
            $data = null;
		}

		$data = (object)$data;


        if(count(get_object_vars(($data))) != 0){
            $tab = (object)[
                '1' => (object)['title' => 'Biodata Perusahaan', 'page' => 'biodata-perusahaan', 'status' => isset($data->status_kyc1) ? $data->status_kyc1 : "verifying"],
                '2' => (object)['title' => 'Pajak & Perizinan', 'page' => 'pajak-perizinan', 'status' => isset($data->status_kyc2) ? $data->status_kyc2 : "verifying"],
                '3' => (object)['title' => 'Alamat', 'page' => 'alamat', 'status' => isset($data->status_kyc3) ? $data->status_kyc3 : "verifying"],
                '4' => (object)['title' => 'Penanggung Jawab', 'page' => 'penanggung-jawab', 'status' => isset($data->status_kyc4) ? $data->status_kyc4 : "verifying"],
                '5' => (object)['title' => 'Aset Perusahaan', 'page' => 'aset-perusahaan', 'status' => isset($data->status_kyc5) ? $data->status_kyc5 : "verifying"],				
                '6' => (object)['title' => 'Profit & Preferensi', 'page' => 'profit-preferensi', 'status' => isset($data->status_kyc6) ? $data->status_kyc6 : "verifying"],
                '7' => (object)['title' => 'Dokumen Perusahaan', 'page' => 'dokumen-perusahaan', 'status' => isset($data->status_kyc7) ? $data->status_kyc7 : "verifying"],
                '8' => (object)['title' => 'Bank Perusahaan', 'page' => 'bank-perusahaan', 'status' => isset($data->status_kyc8) ? $data->status_kyc8 : "verifying"],
            ];
        }else{
            $tab = (object)[
                '1' => (object)['title' => 'Biodata Perusahaan', 'page' => 'biodata-perusahaan', 'status' => 'verifying'],
                '2' => (object)['title' => 'Pajak & Perizinan', 'page' => 'pajak-perizinan', 'status' => 'verifying'],
                '3' => (object)['title' => 'Alamat', 'page' => 'alamat', 'status' => 'verifying'],
                '4' => (object)['title' => 'Penanggung Jawab', 'page' => 'penanggung-jawab', 'status' => 'verifying'],
                '5' => (object)['title' => 'Aset Perusahaan', 'page' => 'aset-perusahaan', 'status' => 'verifying'],				
                '6' => (object)['title' => 'Profit & Preferensi', 'page' => 'profit-preferensi', 'status' => 'verifying'],
                '7' => (object)['title' => 'Dokumen Perusahaan', 'page' => 'dokumen-perusahaan', 'status' => 'verifying'],
                '8' => (object)['title' => 'Bank Perusahaan', 'page' => 'bank-perusahaan', 'status' => 'verifying'],
            ];
        }

		return $tab;
	}

    public function confirm(Request $request) {
		$user = $request->user;
        $last_kyc_submission_id = $user['last_kyc_submission_id'];
		$data = $this->getDataConfirmation($request->kyc, $user);		

		try {
			$client = new \GuzzleHttp\Client();
			$response = $client->request('PUT', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . 'kyc-submission-detail/submit/'. $last_kyc_submission_id, [
				'headers' => [
					'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
					'Origin'        => config('global.BASE_FILE_URL'),
				],
				'json' => $data->submission
			]);
			
			if ( $response->getStatusCode() == 200 ) {
				$uuid = User::join('traders as t', 't.user_id', '=', 'users.id')
                    ->where('t.uuid', $data->submission['trader_uuid'])
                    ->select('users.uuid')
                    ->first();
				if( ($data->status == true) && ($this->statuskyc($data->submission['trader_uuid']) == true) ){
					//$this->notification($uuid->uuid);
				}
				echo json_encode(['msg' => $response->getStatusCode() ]); 
				return;	
			}

		} catch (\Exception $exception) {
            echo json_encode(['msg' => $exception]);
			return;	
		}	
	}

    private function getDataConfirmation($input, $user){
		$status = true;
		$error = [];
		$data = [
			'trader_uuid' => $user['trader_uuid'],
			'step_id'     => $user['step_id']
		];
		
		foreach ($input as $k => $v) {
			if(substr($v['name'],0,6) == 'error_'){
				$error[$v['name']] = $v['value'];				
			}
		}

		foreach ($input as $k => $v) {
			if(substr($v['name'],0,6) != 'error_'){
				if($v['value'] == 0){
					$data[$v['name']] = [(object)[
						'status' => FALSE, 
						'error' => $error['error_'.$v['name']]
					]];
					$status = false;
				}
	
				if($v['value'] == 1){
					$data[$v['name']] = [(object)[
						'status' => TRUE,
						'error' => null 
					]];
				}
			}
		}

		$result = (object)[];
		$result->submission = $data;
		$result->status = $status;

		return $result;
	}

    private function notification($uuid)
    {
        $return = false;
        $client = new GuzzleHttp\Client();
        $headers = [
            'Authorization' => 'Bearer ' . app('request')->session()->get('token'),        
            'Accept'        => 'application/json',
            'Content-type'  => 'application/json'
        ];  

        try {        
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . 'traders/trader-verify-notification/' . $uuid, [
                'headers' => $headers,
            ]);

            if ( $response->getStatusCode() == 200 ) {
                $return = true;
            }

        } catch (\Exception $exception) {
            $return = false;
        }

        return $return;
    }




}
