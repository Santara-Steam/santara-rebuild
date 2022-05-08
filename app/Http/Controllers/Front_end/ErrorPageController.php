<?php

namespace App\Http\Controllers\Front_end;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErrorPageController extends Controller
{
    public function index()
    {
        return view('error/404');
    }
}
