<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class LaporanKeuanganController extends Controller
{

    public function index()
    {
        return view('admin.laporan_keuangan.index');
    }
    
    public function getLaporanKeuangan(Request $request)
    {
        $start  = intval($request->start);
		$length = intval($request->length);
		$filter = $request->filter;
		$search = $request->search;
		$periode = $request->periode;

        $laporan_keuangan = $this->fetchDataKeuangan($start, $length, $filter, $periode, $search['value']);

        $data = array();
		$no   = 1;
		if ($laporan_keuangan != null) {
			foreach ($laporan_keuangan as $laporan) {

				$action  = '';
				if ($laporan['status'] == 'rejected' || $laporan['status'] == 'verifying') {
					$action .= '<a href="#" onClick="verifiedLaporan(\'' . $laporan['id'] . '\')" class="btn btn-success btn-sm btn-block" title="verifikasi">Verifikasi</a>';
				}

				if ($laporan['status'] == 'verified' || $laporan['status'] == 'verifying') {
					$action .= '<a href="#" onClick="rejectedLaporan(\'' . $laporan['id'] . '\')" class="btn btn-info-ghost btn-sm btn-block" title="tolak">Tolak</a>';
					// $editable = ($laporan['editable'] == 1) ? 'checked' : '';
					$editable = 'checked';
					$action .= '<div class="content-center" style="padding: .25rem 1rem; border: 1px dashed #ddd; margin-top: .5rem;"><input type="checkbox" name="editable" id="editable_' . $laporan['id'] . '" ' . $editable . '/> Edit</div>';
				}

				$version = '<a href="' . $laporan['finance_report'] . '" target="_blank" title="unduh">Version ' . $laporan['version'] . '</a>';
				$file = '<a href="' . $laporan['download'] . '?token=' . app('request')->session()->get('token') . '" title="unduh">Unduh</a>';

				if ($laporan['status'] == 'rejected') {
					$status = '<a href="#" title="deskripsi" onclick="showDesc(\'' . $laporan['last_status_desc'] . '\')">Ditolak</a>';
				} elseif ($laporan['status'] == 'verifying') {
					$status = 'Menunggu Verifikasi';
				} elseif ($laporan['status'] == 'verified') {
					$status = 'Terverifikasi';
				} elseif ($laporan['status'] == 'update data') {
					if ($laporan['last_status'] == 'rejected') {
						$status = '<a href="#" title="deskripsi" onclick="showDesc(\'' . $laporan['last_status_desc'] . '\')">Ditolak</a>';
					} else {
						$status = 'Perbaharui Data';
					}
				} else {
					$status = '-';
				}


				array_push($data, [
					$no++,
					$laporan['id'],
					$laporan['name'],
					$version,
					$file,
					$laporan['periode'],
					$status,
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

    public function fetchDataKeuangan($length, $start, $filter, $periode, $search){
        $limit = ($length / $start) + 1;
		$offset = $start;

        $url = '?periode=' . $periode . '&status=' . $filter . '&search=' . $search . '&offset=' . $offset . '&limit=' . $limit;
        $laporan_keuangan = null;

        try {
			$client = new \GuzzleHttp\Client();
			$headers = [
				'Authorization' => 'Bearer '.app('request')->session()->get('token'),
				'Accept'        => 'application/json',
				'Content-type'  => 'application/json'
			];
			$response = $client->request('GET', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION').'finance-report/'.$url, [
				'headers' => $headers,
			]);

			if ($response->getStatusCode() == 200) {
				$data = json_decode($response->getBody()->getContents(), TRUE);
				$laporan_keuangan = (count($data['data']) > 0) ? $data['data']['data'] : null;
			}
		} catch (\Exception $exception) {
			$laporan_keuangan = null;
		}

        return $laporan_keuangan;
    }

    public function confirmLaporan(Request $request)
	{
		$id  = $request->id;
		$status = $request->status;

		if ($status == 'rejected') {
			$data = [
				'reason' => $request->reason,
				'status' => $status
			];
		} else {
			$data = [
				'status' => $status
			];
		}
		$data['editable'] = $request->editable;

		try {
			$client = new \GuzzleHttp\Client();
			$response = $client->request('PUT', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION').'finance-report?id='.$id, [
				'headers' => [
					'Authorization' => 'Bearer '.app('request')->session()->get('token')
				],
				'form_params' => $data
			]);

			echo json_encode(['msg' => $response->getStatusCode()]);
			return;
		} catch (\Exception $exception) {
			$response = $exception->getResponse();
			$responseBody = $response->getBody()->getContents();
			$body = json_decode($responseBody, true);
			echo json_encode(['msg' => $body['message']]);
			return;
		}
	}
	public function getLastReport($uuid){
		// if (!$this->session->user) {
		// 	redirect('user/login');
		// }

		$url =  config('global.BASE_API_CLIENT_URL') . '/v3.7.1/finance-report/copy-last-report/' . $uuid . '/';

		try {
			$client = new \GuzzleHttp\Client();

			$headers = [
				'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
				'Accept'        => 'application/json',
				'Content-type'  => 'application/json'
			];

			$response = $client->request('GET', $url, [
				'headers' => $headers,
			]);

			$return_report = json_decode($response->getBody()->getContents());
			echo json_encode(['msg' => $response->getStatusCode(), 'id' => $return_report->data->id]);
			return;
		} catch (\Exception $exception) {
			$response = $exception->getResponse();
			$responseBody = $response->getBody()->getContents();
			$body = json_decode($responseBody, true);
			echo json_encode(['msg' => $body['message']]);
			return;
		}
	}

	public function detail($uuid = null, $id = null)
	{
		// if (!$this->session->user  || !ispermitted('READ_PENERBIT_BISNIS')) {
		// 	redirect('user/login');
		// }

		$report = ($id == null) ? 'created' : 'updated';
		if (($uuid == null) or ($uuid == '')) {
			redirect('/penerbit/bisnis');
		}
		// $status = $this->getStatus($uuid);
		// if (!$status) {
		// 	redirect('/penerbit/bisnis');
		// }

		$tab = [
			'1' => 'Realisasi Penggunaan Dana',
			'2' => 'Laporan Laba Rugi',
			'3' => 'Perkembangan Perusahaan',
			'4' => 'Informasi Lain',
			'5' => 'Laporan Manual & Bukti Operasional',
			'6' => 'Publikasi'
		];

		$data = [
			'profit_loss' 				=> ($report == 'created') ? null : $this->getData($uuid, 'profit-loss', null, $id),
			'fund_realization_plans' 	=> ($report == 'created') ? null : $this->getData($uuid, 'fund-realization-plans', null, $id),
			'strategy' 					=> ($report == 'created') ? null : $this->getData($uuid, 'strategy', null, $id),
			'other'                     => ($report == 'created') ? null : $this->getData($uuid, 'other', null, $id),
			'manual'					=> ($report == 'created') ? null : $this->getData($uuid, 'manual', null, $id),
			'publication'				=> ($report == 'created') ? null : $this->getData($uuid, 'publication', 'document', $id)
		];

		if ($report == 'created') :
			$fund_plans = $this->getData($uuid, 'fund-plans', null, $id);
			$data['fund_realization_plans']['data']['list_fund_plans'] = $fund_plans['data']['list_fund_plans'];
		endif;

		if ($data['publication'] != null) :
			$data['publication_id']      = $data['profit_loss']['data']['id'];
		endif;
		unset($report);

		// dd($uuid."/".$id);
		// $this->load->view('member/main_page', [
		// 	'page'   => 'member/laporan_keuangan/detail',
		// 	'active' => 'laporan-keuangan',
		// 	'tab'    => $tab,
		// 	'data'	 => $data,
		// 	'uuid'   => $uuid,
		// 	'id'     => $id
		// ]);
		return view('user.emiten.detail_lapkeu',compact('uuid'));
	}

	public function new_detail($uuid = null){
		return view('user.emiten.new_detail_lapkeu',compact('uuid'));
	}

	private function getData($uuid, $tab, $type = null, $id = null)
	{
		// if (!$this->session->user) {
		// 	redirect('user/login');
		// }

		$url = config('global.BASE_API_CLIENT_URL') . '/v3.7.1/finance-report/' . $tab . '/' . $uuid . '/' .  $id;

		try {
			$client = new \GuzzleHttp\Client();

			$headers = [
				'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
				'Accept'        => 'application/json',
				'Content-type'  => 'application/json'
			];

			$response = $client->request('GET', $url, [
				'headers' => $headers,
			]);
			if ($type == 'document') :
				$data = $url . '?token=' . app('request')->session()->get('token');
			else :
				$data = json_decode($response->getBody()->getContents(), TRUE);
			endif;
		} catch (\Exception $exception) {
			$data = null;
		}

		// echo json_encode(['data' => $data]);
		return $data;
	}
	
	public function delete(Request $request){
		// if (!$this->session->user) {
		// 	redirect('user');
		// 	return;
		// }

		$data = array('id' => $request->id,'uuid' => $request->uuid);;

		try {
			$client = new \GuzzleHttp\Client();
			$response = $client->request('DELETE', config('global.BASE_API_CLIENT_URL') . '/v3.7.1/finance-report/delete/' . $data['uuid'] . '/' . $data['id'], [
				'form_params' => [
					'token'     => app('request')->session()->get('token'),
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
}
