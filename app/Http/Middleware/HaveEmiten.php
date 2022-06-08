<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\emiten;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class HaveEmiten
 * @package App\Http\Middleware
 * @author pimenvibritania <pimenvibritania@gmail>
 */
class HaveEmiten
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return RedirectResponse|JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->get('id'), $this->getOwnEmitens())) {
            return $next($request);
        }

        if ($request->isJson()) {
            return \response()->json(
                [
                    "success" => false,
                    "message" => "Unauthorized"
                ], 403
            );
        }
        return redirect()->route('user.portofolio');
    }

    /**
     * @return array
     */
    private function getOwnEmitens(): array
    {
        $userId = auth()->id();

        $query = emiten::join('transactions as tr', 'tr.emiten_id', '=', 'emitens.id')
            ->join('traders as t', 't.id', '=', 'tr.trader_id')
            ->where('t.user_id', $userId)
            ->where('tr.is_deleted', 0)
            ->where('tr.is_verified', 1)
            ->select('emitens.id')
            ->groupBy('emitens.id')
            ->get()->toArray();

        return array_map(function ($value){
            return $value['id'];
        }, $query);
    }
}
