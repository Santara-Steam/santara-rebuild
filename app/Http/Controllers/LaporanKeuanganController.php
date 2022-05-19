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
		return view('user.emiten.detail_lapkeu',compact('uuid','data','tab','id'));
	}

	public function new_detail($uuid = null){
		$id = null;
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
		// dd($data);
		return view('user.emiten.new_detail_lapkeu',compact('uuid','data','tab'));
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

	public function saveReport(Request $request){
		// $data = $this->input->post();
		$data = array($request->all());
		$data_arr = [];
		$tab = null;

		$data_arr['emiten_uuid'] = strip_tags($data['uuid']);

		if ($data['tab'] != 'publication') :
			$data_arr['month'] = strip_tags($data['month']);
			$data_arr['year'] = strip_tags($data['year']);
		endif;

		if (isset($data['version_desc'])) :
			$data_arr['version_desc'] = strip_tags($data['version_desc']);
		endif;

		if ($data['tab'] == 'fund_realization_plans') :
			$tab = 'fund-realization-plans';

			$data_arr['show_fund_plan'] 		= (isset($data['show_fund_plan'])) ? strip_tags($data['show_fund_plan']) : null;
			$data_arr['show_fund_realization'] 	= (isset($data['show_fund_realization'])) ? strip_tags($data['show_fund_realization']) : null;
			$data_arr['fund_realization_desc'] 	= (isset($data['fund_realization_desc'])) ? strip_tags($data['fund_realization_desc']) : null;
			$data_arr['fund_realization_total'] = (isset($data['fund_realization_total'])) ? str_replace(".", "", $data['fund_realization_total']) : null;
			$list_fund_realization = [];
			if (($data_arr['show_fund_realization']) && isset($data['list_fund_realization'])) {
				$list_fund_realization =  array_values((array)json_decode(json_encode($data['list_fund_realization'])));
				foreach ($list_fund_realization as $key => $value) {
					$value->amount = str_replace(".", "", strip_tags($value->amount));
					$value->desc = strip_tags($value->desc);
				}
			}

			$data_arr['list_fund_realization']  = $list_fund_realization;
		endif;

		if ($data['tab'] == 'profit_loss') :
			$tab = 'profit-loss';

			$data_arr['show_profit_loss'] = (isset($data['show_profit_loss'])) ? strip_tags($data['show_profit_loss']) : null;
			$data_arr['profit_loss_desc'] = (isset($data['show_profit_loss'])) ? strip_tags($data['profit_loss_desc']) : null;

			$profit_loss = (isset($data['profit_loss'])) ? array_values((array)json_decode(json_encode($data['profit_loss']))) : null;
			if ($profit_loss != null) :
				$table = [
					0 => 'sales',
					1 => 'cogs',
					2 => 'cost',
					3 => 'other',
					4 => 'tax'
				];

				foreach ($profit_loss as $key => $value) {
					$value->name = strip_tags($value->name);
					foreach ($table as $k => $v) {
						$value->$v->list = (!empty($value->$v->list)) ? array_values((array)$value->$v->list) : [];
						if (!empty($value->$v->list)) :
							foreach ($value->$v->list as $x => $y) {
								$y->amount = str_replace(".", "", strip_tags($y->amount));
								$y->desc   = strip_tags($y->desc);
							}
						endif;

						$value->$v->total = str_replace(".", "", strip_tags($value->$v->total));
					}
				}

				$data_arr['profit_loss'] = $profit_loss;
			endif;
		endif;

		if ($data['tab'] == 'strategy') :
			$tab = 'strategy';

			$data_arr['show_strategy'] 	= (isset($data['show_strategy'])) ? strip_tags($data['show_strategy']) : null;
			$data_arr['show_growth'] 	= (isset($data['show_growth'])) ? strip_tags($data['show_growth']) : null;
			$data_arr['strategy_video'] = (isset($data['show_growth'])) ? strip_tags($data['strategy_video']) : null;

			if ($data_arr['show_strategy']) {
				$image = (isset($_FILES['strategy_image'])) ? count($_FILES['strategy_image']['name']) : 0;
				$delete = (isset($data['image_strategy_delete'])) ? count($data['image_strategy_delete']) : 0;
				$count = $image - $delete;
				if ($count < 1) {
					echo json_encode(['msg' => 'Photo <b>Strategi Perusahaan</b> tidak boleh kosong']);
					return;
				}
			}

			if ($data_arr['show_growth']) {
				$image = (isset($_FILES['growth_image'])) ? count($_FILES['growth_image']['name']) : 0;
				$delete = (isset($data['image_growth_delete'])) ? count($data['image_growth_delete']) : 0;
				$count = $image - $delete;
				if ($count < 1) {
					echo json_encode(['msg' => 'Photo <b>Perkembangan Outlet</b> tidak boleh kosong']);
					return;
				}
			}

			if (isset($data['image_strategy_delete']) && (count($data['image_strategy_delete']))) :
				$this->fileDelete($data['image_strategy_delete'], 'strategy', $data['id']);
			endif;

			if (isset($data['image_growth_delete']) && (count($data['image_growth_delete']))) :
				$this->fileDelete($data['image_growth_delete'], 'growth', $data['id']);
			endif;

			$file_strategy_name = isset($data['file_strategy_name']) ? $data['file_strategy_name'] : null;
			if (isset($_FILES['strategy_image'])) {
				$this->fileUpload($_FILES['strategy_image'], $data['strategy_desc'], $file_strategy_name, $data['id'], 'strategy');
			}

			$file_growth_name = isset($data['file_growth_name']) ? $data['file_growth_name'] : null;
			if (isset($_FILES['growth_image'])) {
				$this->fileUpload($_FILES['growth_image'], $data['growth_desc'], $file_growth_name, $data['id'], 'growth');
			}

		endif;

		if ($data['tab'] == 'other') :
			$tab = 'other';

			$data_arr['show_deed'] = (isset($data['show_deed'])) ? strip_tags($data['show_deed']) : null;
			$data_arr['show_ksei'] = (isset($data['show_ksei'])) ? strip_tags($data['show_ksei']) : null;

			if ($data_arr['show_deed']) {
				$image = (isset($_FILES['deeds_image'])) ? count($_FILES['deeds_image']['name']) : 0;
				$delete = (isset($data['image_deed_delete'])) ? count($data['image_deed_delete']) : 0;
				$count = $image - $delete;
				if ($count < 1) {
					echo json_encode(['msg' => 'Photo <b>Akta Perusahaan</b> tidak boleh kosong']);
					return;
				}
			}

			if ($data_arr['show_ksei']) {
				$image = (isset($_FILES['kseis_image'])) ? count($_FILES['kseis_image']['name']) : 0;
				$delete = (isset($data['image_ksei_delete'])) ? count($data['image_ksei_delete']) : 0;
				$count = $image - $delete;
				if ($count < 1) {
					echo json_encode(['msg' => 'Photo <b>KSEI</b> tidak boleh kosong']);
					return;
				}
			}

			if (isset($data['image_deed_delete']) && (count($data['image_deed_delete']))) :
				$this->fileDelete($data['image_deed_delete'], 'deed', $data['id']);
			endif;

			if (isset($data['image_ksei_delete']) && (count($data['image_ksei_delete']))) :
				$this->fileDelete($data['image_ksei_delete'], 'ksei', $data['id']);
			endif;

			$file_deed_name = isset($data['file_deed_name']) ? $data['file_deed_name'] : null;
			if (isset($_FILES['deeds_image'])) {
				$this->fileUpload($_FILES['deeds_image'], $data['deeds_desc'], $file_deed_name, $data['id'], 'deed');
			}

			$file_ksei_name = isset($data['file_ksei_name']) ? $data['file_ksei_name'] : null;
			if (isset($_FILES['kseis_image'])) {
				$this->fileUpload($_FILES['kseis_image'], $data['kseis_desc'], $file_ksei_name, $data['id'], 'ksei');
			}

		endif;

		if ($data['tab'] == 'manual') :
			$tab = 'manual';
			$allowed =  array('jpeg', 'png', 'jpg');

			$data_arr['manual'] = 0;
			$ext = null;
			if (isset($_FILES['logo']) && !$_FILES['logo']['error']) {
				$ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
				$logo = [
					[
						'name' => 'image',
						'contents' => fopen($_FILES['logo']['tmp_name'], 'r'),
						'filename' => $_FILES['logo']['name']
					], [
						'name' => 'desc',
						'contents' => ''
					]
				];

				if ($ext != null && in_array($ext, $allowed)) :
					$file_logo_name = isset($data['file_logo_name']) ? $data['file_logo_name'] : null;
					if (isset($file_logo_name) && $file_logo_name != null) :
						$this->mediaUploadUpdate($logo, $data['id'], $file_logo_name, 'logo');
					else :
						$this->mediaUpload($logo, $data['id'], 'logo');
					endif;
				endif;
			}

			if (isset($_FILES['manual_report']) && !$_FILES['manual_report']['error']) {
				$ext = strtolower(pathinfo($_FILES['manual_report']['name'], PATHINFO_EXTENSION));
				$manual_report = [
					[
						'name' => 'image',
						'contents' => fopen($_FILES['manual_report']['tmp_name'], 'r'),
						'filename' => $_FILES['manual_report']['name']
					], [
						'name' => 'desc',
						'contents' => ''
					]
				];
				if ($ext != null && ($ext == 'pdf')) :
					$this->mediaUpload($manual_report, $data['id'], 'manual');
				endif;
				$data_arr['manual'] = 1;
			}

			if (isset($data['image_pos_delete']) && (count($data['image_pos_delete']))) :
				$this->fileDelete($data['image_pos_delete'], 'pos', $data['id']);
			endif;

			$file_pos_name = isset($data['file_pos_name']) ? $data['file_pos_name'] : null;
			if (isset($_FILES['pos_image'])) {
				$this->fileUpload($_FILES['pos_image'], $data['pos_desc'], $file_pos_name, $data['id'], 'pos');
			}

		endif;

		$data_save = json_decode(json_encode($data_arr));

		if ($data['tab'] == 'publication') :
			$url = '/v3.7.1/finance-report/submit-publication/' . $data['uuid'] . '/' . $data['id'];
			$method = 'POST';
		else :
			$url = '/v3.7.1/finance-report/' . $tab . '/';
			$method = 'POST';
			if ($data['action'] == 'update') {
				$url .= $data['id'];
				$method = 'PUT';
			}
		endif;

		try {
			$client = new \GuzzleHttp\Client();

			$headers = [
				'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
				'Accept'        => 'application/json',
				'Content-type'  => 'application/json'
			];

			$response = $client->request($method, config('global.BASE_API_CLIENT_URL') . $url, [
				'headers' => $headers,
				'json' => $data_save
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
}
