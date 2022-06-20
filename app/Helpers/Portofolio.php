<?php

namespace App\Helpers;

use App\Models\emiten;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;

class Portofolio
{
    /**
     * @throws GuzzleException
     */
    public static function OwnPortofolio()
    {
        $user = self::checkUser();

        $query = self::getQuery($user)->get();

        if ($query) {
            return response()->json([
                "emitenIds" => $query->map(function ($value){
                    return $value->id;
                }) ,
                "data" => $query,

            ]);
        }
    }

    public static function getFundedPortofolio()
    {
        $user = self::checkUser();

        $query = self::getQuery($user);

        return $query->andWhere('emitens.last_emiten_journey', '=', 'PENDANAAN TERPENUHI');
    }

    private static function getQuery($user)
    {
        return emiten::join('transactions as tr', 'tr.emiten_id', '=', 'emitens.id')
            ->join('traders as t', 't.id', '=', 'tr.trader_id')
            ->where('t.user_id', $user->id)
            ->where('tr.is_deleted', 0)
            ->where('tr.is_verified', 1)
            ->where('emitens.is_active', 1)
            ->select('emitens.*')
            ->groupBy('emitens.id');
    }

    private static function checkUser()
    {
        $userId = request()->get('userId');
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "User not found"
            ], 404);
        }

        return $user;
    }
}
