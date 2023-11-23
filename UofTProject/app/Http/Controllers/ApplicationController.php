<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function create(){

        $userId = auth()->user()->id;
        $roleId = auth()->user()->role_id;

        return view('application', compact('roleId'));
    }

    public function store(Request $request){
        dump('oooooo');

        $user = Application::create([
            'program_id' => '1',
            'user_id' => auth()->user()->id,
            'academic_year' => 2022,
            'no_of_students' => 2,
            'status_id' => 1
        ]);


        return redirect()->route('dashboard')->with('message', 'Application has been saved Successfully.');
    }
}
