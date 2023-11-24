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

        Application::create([
            'program_id' => '1',
            'user_id' => auth()->user()->id,
            'academic_year' => 2022,
            'no_of_students' => 2,
            'status_id' => 1
        ]);


        return redirect()->route('dashboard')->with('message', 'Application has been saved Successfully.');
    }

    public function deptApprove($id)
    {
        $application = Application::findOrFail($id);
        $application->update(['status_id' => Lookup('Status')->where('slug', 'dept_approved')->first()->id]);

        return redirect()->route('dashboard')->with('message', 'Application '.$id.' has been approved by the Dept Chair.');
    }

    public function pendingDOApprove($id)
    {
        $application = Application::findOrFail($id);
        $application->update(['status_id' => Lookup('Status')->where('slug', 'pending_do_approval')->first()->id]);

        return redirect()->route('dashboard')->with('message', 'Application '.$id.' is now in pending approval by the Dean\' administrator.');
    }
}
