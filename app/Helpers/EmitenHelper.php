<?php

namespace App\Helpers;

use App\Models\emiten;
use App\Models\emitens_old;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class EmitenHelper
{
    const TOKEN = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjMxODAyNCwiZGF0YSI6eyJpZCI6MzE4MDI0LCJ1dWlkIjoiMWI0Zjg2ZmEtMjhlYS00ZTJhLWEyMjgtNDNmNzBkN2I5MTNlIiwiZW1haWwiOiJyaXNmYW5kaWJheXUxOUBnbWFpbC5jb20iLCJjcmVhdGVkX2F0IjoiMjAyMi0wNC0wNiAxMDo1NTozNCIsInVwZGF0ZWRfYXQiOiIyMDIyLTA2LTI3IDIxOjI5OjA4IiwiZGVsZXRlZF9hdCI6bnVsbCwicm9sZV9pZCI6MiwiaXNfdmVyaWZpZWQiOjEsInR3b19mYWN0b3JfYXV0aCI6MCwidHdvX2ZhY3Rvcl9zZWNyZXQiOm51bGwsImlzX2xvZ2dlZF9pbiI6MSwiaXNfZGVsZXRlZCI6MCwiY3JlYXRlZF9ieSI6bnVsbCwidXBkYXRlZF9ieSI6bnVsbCwiaXNfb3RwIjoxLCJhdHRlbXB0IjoyLCJhdHRlbXB0X2VtYWlsIjowLCJmaW5nZXJfcHJpbnQiOm51bGwsImF0dGVtcHRfb3RwIjowLCJhdHRlbXB0X3BpbiI6MCwibmFtZSI6IlJpc2ZhbmRpIiwidHJhZGVyX3R5cGUiOiJwZXJzb25hbCIsImlzX3Jlc2V0X3Bhc3N3b3JkIjoxLCJpc192ZXJpZmllZF9reWMiOjEsInJvbGVfbmFtZSI6IlRyYWRlciJ9LCJpYXQiOjE2NTY0MjYwMjJ9.jyss5lVypmDbNx7foVZ2lUqXpphXBYW45B45NQxAvog";

    public static function Active()
    {
        return self::Query()
            ->get();
    }

    public static function NowPlaying($limit = 99, $offset = 1, $search = null, $minimal = null, $maksimal = null, $category = null, $sort = null, $type = "saham", $jenis = "notfull")
    {
        $data = null;
        $url = '/v3.7.1/emitens/emiten?projectValue1='
            . $minimal
            . '&projectValue2='
            . $maksimal
            . '&category='
            . $category
            . '&search='
            . $search
            . '&sort='
            . $sort
            . '&pageSize='
            . $limit . '&pageNumber='
            . $offset . '&type='
            . $type . '&jenis='
            . $jenis;

        try {
            $client = new Client();

            $headers = [
                'Authorization' => self::TOKEN,
                'Accept'        => 'application/json',
                'Content-type'  => 'application/json'
            ];

            $response = $client->request('GET', config('global.BASE_API_CLIENT_URL') . $url, [
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

    public static function AdminEmitens()
    {
        $nowPlaying = array_map(function ($value) {
            return $value["id"];
        }, self::NowPlaying());

        $active = array_map(function ($value) {
            return $value["id"];
        }, self::Active()->toArray());

        $diff = array_diff($nowPlaying, $active);

        return array_merge($active, $diff);
    }

    public static function TraderEmitens()
    {
        $userId = request()->header('userId');

        $emiten = emiten::select(
            'emitens.id',
            'emitens.company_name',
            'emitens.pictures',
            'emitens.trademark',
            'emitens.price',
            'emitens.supply',
            'emitens.is_deleted',
            'emitens.is_active',
            'emitens.begin_period')
            ->join('traders', 'traders.id', '=', 'emitens.trader_id')
            ->where('traders.user_id', $userId)
            ->where('emitens.is_active', 1)
            ->where('emitens.is_deleted', 0)
            ->get();

        return $emiten;
    }

    public static function Query()
    {
        return emitens_old::select(
            'emitens.id',
            'emitens.company_name',
            'emitens.pictures',
            'emitens.trademark',
            'emitens.price',
            'emitens.supply',
            'emitens.is_deleted',
            'emitens.is_active',
            'emitens.begin_period',
            'categories.category as ktg',
            DB::raw("SUM(Distinct(devidend.devidend)) as dvd"),
            DB::raw("COUNT(Distinct(devidend.id)) as dvc"))
            ->leftjoin('categories', 'categories.id','=','emitens.category_id')
            ->leftjoin('devidend', 'devidend.emiten_id','=','emitens.id')
            ->leftjoin('transactions','transactions.emiten_id','=','emitens.id')
            ->orderby('emitens.id','DESC')
            ->groupBy('emitens.id')
            ->havingRaw('CONVERT(ROUND(
            IF(
              (SUM(
                IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply > 1, 1,
                  (SUM(
                    IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply) * 100, 2), char) = 100.00
                    and
                    emitens.is_deleted = 0
                    and emitens.is_active = 1
                    and emitens.begin_period < now()'
            );
    }

}
