<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $update_url = url('admin/kyc/update_url');
        $confirm_url = url('admin/kyc/confirm_url');
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

		$tab = (object)[
			'1' => (object)['title' => 'Biodata Perusahaan', 'page' => 'biodata-perusahaan', 'status' => $data->status_kyc1],
			'2' => (object)['title' => 'Pajak & Perizinan', 'page' => 'pajak-perizinan', 'status' => $data->status_kyc2],
			'3' => (object)['title' => 'Alamat', 'page' => 'alamat', 'status' => $data->status_kyc3],
			'4' => (object)['title' => 'Penanggung Jawab', 'page' => 'penanggung-jawab', 'status' => $data->status_kyc4],
			'5' => (object)['title' => 'Aset Perusahaan', 'page' => 'aset-perusahaan', 'status' => $data->status_kyc5],				
			'6' => (object)['title' => 'Profit & Preferensi', 'page' => 'profit-preferensi', 'status' => $data->status_kyc6],
			'7' => (object)['title' => 'Dokumen Perusahaan', 'page' => 'dokumen-perusahaan', 'status' => $data->status_kyc7],
			'8' => (object)['title' => 'Bank Perusahaan', 'page' => 'bank-perusahaan', 'status' => $data->status_kyc8],
		];

		return $tab;
	}

}
