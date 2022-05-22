<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class KycController extends Controller
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

        if($kyc[3]->data != null){
            $kyc[3]->data->idcard_photo = ($kyc[1]->data->idcard_photo) ? $kyc[1]->data->idcard_photo : '';
        }

        $active = 'kyc-individu';
        $title = 'Detail KYC Individu';
        $update_url = url('admin/kyc/update_url');
        $confirm_url = url('admin/kyc/confirm_url');
        $form_footer = 'form_footer';

        return view('admin.kyc.detail', compact('active', 'kyc', 'tab', 'action', 'title', 
            'update_url', 'confirm_url', 'form_footer'));

    }

    private function dataKyc($uuid) {
		$kyc = array();
		$tab = array(
			'1' => 'biodata-pribadi', 
			'2' => 'biodata-keluarga', 
			'3' => 'alamat', 
			'4' => 'pekerjaan', 
			'5' => 'informasi-pajak', 
			'6' => 'bank'); 

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
            
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . 'traders/individual-'.$phase.'/' . $uuid, [
                'headers' => $headers,
			]);

            if ( $response->getStatusCode() == 200 ) {
                $data= json_decode($response->getBody()->getContents(), TRUE);
            }
        } catch (\Exception $exception) {
            $data = null;
		}

		$kyc = (object)[
			'uuid' 		=> $uuid,
			'page' 		=> $page,
			'data' 		=> (count((array)$data) > 0) ? (object)$data : null
		];
		
		return $kyc;		
	}

    public function getMarital($id = null) {
		$result = '';
		if ($id != null ){
			$marital = array (
				'1' => 'Single',
				'2' => 'Menikah (Married)',
				'3' => 'Duda (Widower)',
				'4' => 'Janda (Widow)'
			);            
			$result = ($id == 'all') ? $marital : $marital[$id];
		}
		return $result;
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

		$tab = (object)[
			'1' => (object)['title' => 'Biodata Pribadi', 'page' => 'biodata-pribadi', 'status' => $data->status_kyc1],
			'2' => (object)['title' => 'Biodata Keluarga', 'page' => 'biodata-keluarga' , 'status' => $data->status_kyc2],
			'3' => (object)['title' => 'Alamat', 'page' => 'alamat' , 'status' => $data->status_kyc3],
			'4' => (object)['title' => 'Pekerjaan', 'page' => 'pekerjaan' , 'status' => $data->status_kyc4],
			'5' => (object)['title' => 'Informasi Pajak', 'page' => 'informasi-pajak' , 'status' => $data->status_kyc5],				
			'6' => (object)['title' => 'Bank', 'page' => 'bank' , 'status' => $data->status_kyc6]
		];

		return $tab;
	}

    public function confirm(Request $request)
    {
        $user = $request->user;
        $data = $this->getDataConfirmation($request->kyc, $user);
        $last_kyc_submission_id = $user['last_kyc_submission_id'];

        try {
			$client = new \GuzzleHttp\Client();
			$response = $client->request('PUT', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . 'kyc-submission-detail/submit/' . $last_kyc_submission_id, [
				'headers' => [
					'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
					'Origin'        => config('global.BASE_FILE_URL'),
					'Content-Type'	=> 'application/json'
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
			// $response = $exception->getResponse();
			// $responseBody = $response->getBody()->getContents();
			// $body = json_decode($responseBody,true);
			// echo json_encode(['msg' => $body['message'] ]); 
			return;
		}	
    }

    public function update(Request $request)
    {
        echo "Hai";
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

    private function statuskyc($uuid) {
		$data = null;
		$return = false;

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

		$value = array_values((array)$data);
		if (array_unique($value) === array('verified')) { 
			$return = true;
		}

		return $return;
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
