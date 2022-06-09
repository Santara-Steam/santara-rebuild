<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SsoController extends Controller
{
    public function sso(Request $request): RedirectResponse
    {
        $chatUrl = env("SANTARA_CHAT_BASE_URL");

        $query = http_build_query([
            "session" => $request->session()->all(),
            "userId" => Auth::user()->getAuthIdentifier(),
            "email" => Auth::user()->email,
            "name" => Auth::user()->trader->name,
            "auth" => $request->session()->get('pwd'),
        ]);

        return redirect($chatUrl . "/authorize?" . $query);
    }
}
