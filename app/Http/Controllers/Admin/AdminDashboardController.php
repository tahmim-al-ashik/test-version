<?php
##########Http->controllers->Admin->AdminDashboardcontroller.php###############
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('AdminDashboard');
    }
}

