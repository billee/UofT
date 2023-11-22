<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $user_id = Auth::user()->id;

        $applications = Application::where('program_id', 1)->get();



        return view('dashboard', compact('applications'));
    }
}
