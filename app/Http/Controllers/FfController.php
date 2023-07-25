<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FfController extends Controller
{
    public function index()
    {
        return view('ff/ff_list');
    }

}
