<?php 

function emiten($limit, $offset, $search, $minimal, $maksimal, $category, $sort, $type, $jenis)
	{
		// $CI = &get_instance();
		$data = null;
		$url = '/v3.7.1/emitens/emiten?projectValue1=' . $minimal . '&projectValue2=' . $maksimal . '&category=' . $category . '&search=' . $search . '&sort=' . $sort . '&pageSize=' . $limit . '&pageNumber=' . $offset . '&type=' . $type . '&jenis=' . $jenis;

		try {
			$client = new GuzzleHttp\Client();

			$headers = [
				'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
				'Accept'        => 'application/json',
				'Content-type'  => 'application/json'
			];

			$response = $client->request('GET', env("BASE_API_CLIENT_URL") . $url, [
				'headers' => $headers,
			]);

			if ($response->getStatusCode() == 200) {
				$data = json_decode($response->getBody()->getContents(), TRUE);
			}
		} catch (\Exception $exception) {
			$data = null;
		}

		return $data;
	}