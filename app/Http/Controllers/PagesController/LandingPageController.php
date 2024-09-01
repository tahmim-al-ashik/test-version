<?php

namespace App\Http\Controllers\PagesController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    public function test()
    {
        return view('admin.auth.serviceslist');
    }
    public function testone()
    {
        return view('admin.auth.createservice');
    }
}
