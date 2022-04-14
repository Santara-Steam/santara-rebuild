<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
				$file = '<a href="' . $laporan['download'] . '?token=' . config('global.TOKEN') . '" title="unduh">Unduh</a>';

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
				'Authorization' => 'Bearer '.config('global.TOKEN'),
				'Accept'        => 'application/json',
				'Content-type'  => 'application/json'
			];
			$response = $client->request('GET', config('global.BASE_API_ADMIN_URL').'finance-report/'.$url, [
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
			$response = $client->request('PUT', config('global.BASE_API_ADMIN_URL').'finance-report?id='.$id, [
				'headers' => [
					'Authorization' => 'Bearer '.config('global.TOKEN')
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



}
