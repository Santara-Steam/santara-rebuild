<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class KycController extends Controller
{

	public function summaryKYC()
	{
		$status = $this->getStatusStatistic();
		return view('admin.kyc.summary-kyc-individu', compact('status'));
	}

	private function getStatusStatistic() {
		$data = null;

        try {
            $client = new \GuzzleHttp\Client();
                    
            $headers = [
                'Authorization' => 'Bearer ' . app('request')->session()->get('token'),        
                'Accept'        => 'application/json',
                'Content-type'  => 'application/json'
            ];
            
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . 'traders/status-statisticIndividual', [
                'headers' => $headers,
			]);

            if ( $response->getStatusCode() == 200 ) {
                $data= json_decode($response->getBody()->getContents(), TRUE);
            }
        } catch (\Exception $exception) {
            $data = null;
		}

		$status = (count((array)$data) > 0) ? (object)$data : null;
		
		return $status;		
	}

	public function belumKYC()
	{
		return view('admin.kyc.belum-kyc-individu');
	}

	public function pembaruanKYC()
	{
		return view('admin.kyc.pembaruan-data-kyc-individu');
	}

	public function menungguVerifikasiKYC()
	{
		return view('admin.kyc.menunggu-verifikasi-kyc-individu');
	}

	public function ditolakKYC()
	{
		return view('admin.kyc.tolak-data-kyc-individu');
	}

	public function terverifikasiKYC()
	{
		return view('admin.kyc.terverifikasi-data-kyc-individu');
	}

	public function fetchDataBelumKYC(Request $request)
	{
		$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $filter = $request->get('filter');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; 
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value'];

        $totalRecords = $this->getCount(null);
        $totalRecordswithFilter = $this->getCountFilter(null, $searchValue);
        $kyc = $this->getData(null, $searchValue, $start, $rowperpage);

		$data = [];
        foreach($kyc as $row){
            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at)));
            $button = '<a class="btn btn-info-ghost btn-sm" href="'.url('admin/kyc/konfirmasi/'.$row->trader_uuid).'">Detail</a>';
				
				switch ($row->status) {
					case "data_updated":
						$status = "<span style='font-weight: bold;color: #666EE8'>Pembaruan Data</span>";
						break;
					case "verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi</span>";
						$button = '<a href="' . url('admin/kyc/konfirmasi/'.$row->trader_uuid) . '" 
						class="btn btn-info btn-sm btn-block" title="Konfirmasi">Verifikasi</a>';
						  break;
					case "rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak</span>";
						break;	
					case "kustodian_verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi Kustodian</span>";
						break;	
					case "kustodian_rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak Kustodian</span>";
						break;
					case "verified":
						$status = "<span style='font-weight: bold;color: #0E7E4A'>Terverifikasi</span>";
						break;																			  
					default:
						$status = "<span style='font-weight: bold;color: #000000'>Belum Kyc</span>";
				}

            array_push($data, [
                "name" => $row->name,
                "email" => $row->email,
                "updated_at" => $updated_at,
				"status" => $status,
                "action" => $button
            ]);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
    
        echo json_encode($response);
        exit;
	}

	public function fetchDataPembaruanDataKYC(Request $request)
	{
		$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $filter = $request->get('filter');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; 
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value'];

        $totalRecords = $this->getCount('data_updated');
        $totalRecordswithFilter = $this->getCountFilter('data_updated', $searchValue);
        $kyc = $this->getData('data_updated', $searchValue, $start, $rowperpage);

		$data = [];
        foreach($kyc as $row){
            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at)));
            $button = '<a class="btn btn-info-ghost btn-sm" href="'.url('admin/kyc/konfirmasi/'.$row->trader_uuid).'">Detail</a>';
				
				switch ($row->status) {
					case "data_updated":
						$status = "<span style='font-weight: bold;color: #666EE8'>Pembaruan Data</span>";
						break;
					case "verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi</span>";
						$button = '<a href="' . url('admin/kyc/konfirmasi/'.$row->trader_uuid) . '" 
						class="btn btn-info btn-sm btn-block" title="Konfirmasi">Verifikasi</a>';
						  break;
					case "rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak</span>";
						break;	
					case "kustodian_verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi Kustodian</span>";
						break;	
					case "kustodian_rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak Kustodian</span>";
						break;
					case "verified":
						$status = "<span style='font-weight: bold;color: #0E7E4A'>Terverifikasi</span>";
						break;																			  
					default:
						$status = "<span style='font-weight: bold;color: #000000'>Belum Kyc</span>";
				}

            array_push($data, [
                "name" => $row->name,
                "email" => $row->email,
                "updated_at" => $updated_at,
				"status" => $status,
                "action" => $button
            ]);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
    
        echo json_encode($response);
        exit;
	}

	public function fetchDataMenungguVerifikasiKYC(Request $request)
	{
		$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $filter = $request->get('filter');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; 
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value'];

        $totalRecords = $this->getCount('verifying');
        $totalRecordswithFilter = $this->getCountFilter('verifying', $searchValue);
        $kyc = $this->getData('verifying', $searchValue, $start, $rowperpage);

		$data = [];
        foreach($kyc as $row){
            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at)));
            $button = '<a class="btn btn-info-ghost btn-sm" href="'.url('admin/kyc/konfirmasi/'.$row->trader_uuid).'">Detail</a>';
				
				switch ($row->status) {
					case "data_updated":
						$status = "<span style='font-weight: bold;color: #666EE8'>Pembaruan Data</span>";
						break;
					case "verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi</span>";
						$button = '<a href="' . url('admin/kyc/konfirmasi/'.$row->trader_uuid) . '" 
						class="btn btn-info btn-sm btn-block" title="Konfirmasi">Verifikasi</a>';
						  break;
					case "rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak</span>";
						break;	
					case "kustodian_verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi Kustodian</span>";
						break;	
					case "kustodian_rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak Kustodian</span>";
						break;
					case "verified":
						$status = "<span style='font-weight: bold;color: #0E7E4A'>Terverifikasi</span>";
						break;																			  
					default:
						$status = "<span style='font-weight: bold;color: #000000'>Belum Kyc</span>";
				}

            array_push($data, [
                "name" => $row->name,
                "email" => $row->email,
                "updated_at" => $updated_at,
				"status" => $status,
                "action" => $button
            ]);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
    
        echo json_encode($response);
        exit;
	}

	public function fetchDataTolakKYC(Request $request)
	{
		$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $filter = $request->get('filter');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; 
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value'];

        $totalRecords = $this->getCount('rejected');
        $totalRecordswithFilter = $this->getCountFilter('rejected', $searchValue);
        $kyc = $this->getData('rejected', $searchValue, $start, $rowperpage);

		$data = [];
        foreach($kyc as $row){
            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at)));
            $button = '<a class="btn btn-info-ghost btn-sm" href="'.url('admin/kyc/konfirmasi/'.$row->trader_uuid).'">Detail</a>';
				
				switch ($row->status) {
					case "data_updated":
						$status = "<span style='font-weight: bold;color: #666EE8'>Pembaruan Data</span>";
						break;
					case "verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi</span>";
						$button = '<a href="' . url('admin/kyc/konfirmasi/'.$row->trader_uuid) . '" 
						class="btn btn-info btn-sm btn-block" title="Konfirmasi">Verifikasi</a>';
						  break;
					case "rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak</span>";
						break;	
					case "kustodian_verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi Kustodian</span>";
						break;	
					case "kustodian_rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak Kustodian</span>";
						break;
					case "verified":
						$status = "<span style='font-weight: bold;color: #0E7E4A'>Terverifikasi</span>";
						break;																			  
					default:
						$status = "<span style='font-weight: bold;color: #000000'>Belum Kyc</span>";
				}

            array_push($data, [
                "name" => $row->name,
                "email" => $row->email,
                "updated_at" => $updated_at,
				"status" => $status,
                "action" => $button
            ]);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
    
        echo json_encode($response);
        exit;
	}

	public function fetchDataTerverifikasiKYC(Request $request)
	{
		$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $filter = $request->get('filter');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; 
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value'];

        $totalRecords = $this->getCount('verified');
        $totalRecordswithFilter = $this->getCountFilter('verified', $searchValue);
        $kyc = $this->getData('verified', $searchValue, $start, $rowperpage);

		$data = [];
        foreach($kyc as $row){
            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at)));
            $button = '<a class="btn btn-info-ghost btn-sm" href="'.url('admin/kyc/konfirmasi/'.$row->trader_uuid).'">Detail</a>';
				
				switch ($row->status) {
					case "data_updated":
						$status = "<span style='font-weight: bold;color: #666EE8'>Pembaruan Data</span>";
						break;
					case "verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi</span>";
						$button = '<a href="' . url('admin/kyc/konfirmasi/'.$row->trader_uuid) . '" 
						class="btn btn-info btn-sm btn-block" title="Konfirmasi">Verifikasi</a>';
						  break;
					case "rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak</span>";
						break;	
					case "kustodian_verifying":
						$status = "<span style='font-weight: bold;color: #EEAA5B'>Menunggu Verifikasi Kustodian</span>";
						break;	
					case "kustodian_rejected":
						$status = "<span style='font-weight: bold;color: #BF2D30'>Ditolak Kustodian</span>";
						break;
					case "verified":
						$status = "<span style='font-weight: bold;color: #0E7E4A'>Terverifikasi</span>";
						break;																			  
					default:
						$status = "<span style='font-weight: bold;color: #000000'>Belum Kyc</span>";
				}

            array_push($data, [
                "name" => $row->name,
                "email" => $row->email,
                "updated_at" => $updated_at,
				"status" => $status,
                "action" => $button
            ]);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
    
        echo json_encode($response);
        exit;
	}

	public function getCount($status)
    {
		$kyc = User::join('traders as t', 'users.id', '=', 't.user_id')
			->leftJoin('kyc_submissions as ks', 'ks.id', '=', 't.last_kyc_submission_id')
			->where('users.is_deleted', 0)
			->where('ks.status', $status)
			->where('t.trader_type', 'personal')
			->orWhere('t.trader_type', '')
			->count();
		return $kyc;
	}

	public function getCountFilter($status, $searchValue)
    {
		$kyc = User::join('traders as t', 'users.id', '=', 't.user_id')
			->leftJoin('kyc_submissions as ks', 'ks.id', '=', 't.last_kyc_submission_id')
			->where('users.is_deleted', 0)
			->where('t.name', 'like', '%' .$searchValue . '%')
			->where('ks.status', $status)
			->where('t.trader_type', 'personal')
			->orWhere('t.trader_type', '')
			->count();
        return $kyc;
    }

	public function getData($status, $searchValue, $start, $rowperpage)
    {
        $kyc = User::join('traders as t', 'users.id', '=', 't.user_id')
			->leftJoin('kyc_submissions as ks', 'ks.id', '=', 't.last_kyc_submission_id')
            ->where('users.is_deleted', 0)
            ->where('t.name', 'like', '%' .$searchValue . '%')
            ->where('ks.status', $status)
			->where('t.trader_type', 'personal')
			->orWhere('t.trader_type', '')
            ->select('users.uuid as user_uuid', 'users.id as user_id', 'users.email', 'users.role_id', 
					'users.is_verified as user_is_verified', 't.uuid as trader_uuid', 't.name', 't.phone',
					't.has_submit_kyc', 't.is_verified as is_verified', 't.trader_type', 'ks.status', 
					't.tnc', 't.created_at', 't.updated_at')
            ->orderBy('users.updated_at', 'ASC')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        return $kyc;
    }

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
					$this->notification($uuid->uuid);
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
