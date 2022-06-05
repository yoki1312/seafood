<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        
        $data = DB::table('users')->count();
        return view('admin.dashboard', compact('data'));
    }
    
}
