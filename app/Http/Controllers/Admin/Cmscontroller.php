<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Cmscontroller extends Controller
{
    public function index()
    {
    return view('admin/cms/cms_list');
    }
}
