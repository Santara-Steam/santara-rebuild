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
        $userId = request()->get('userId');
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "User not found"
            ], 404);
        }
        $query = emiten::join('transactions as tr', 'tr.emiten_id', '=', 'emitens.id')
            ->join('traders as t', 't.id', '=', 'tr.trader_id')
            ->where('t.user_id', $user->id)
            ->where('tr.is_deleted', 0)
            ->where('tr.is_verified', 1)
            ->select('emitens.*')
            ->groupBy('emitens.id')
            ->get();

        if ($query) {
            return response()->json([
                "data" => $query
            ]);
        }
    }
}
