<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::select('id', 'name', 'cover_image')->get();
        return response()->json(['data' => $services]);
    }
}

##########Http->controllers->Api->Service->ServiceController.php###############
