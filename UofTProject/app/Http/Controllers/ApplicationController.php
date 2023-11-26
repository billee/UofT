<?php

namespace App\Http\Controllers;

use App\Mail\RevisionEmail;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function create(){

        $userId = auth()->user()->id;
        $roleId = auth()->user()->role_id;

        return view('application', compact('roleId'));
    }

    public function store(Request $request){
        dd($request->all());

        // Application::create([
        //     'program_id' => '1',
        //     'user_id' => auth()->user()->id,
        //     'academic_year' => 2022,
        //     'no_of_students' => 2,
        //     'status_id' => 1
        // ]);


        //return redirect()->route('dashboard')->with('message', 'Application has been saved Successfully.');
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

    public function committeeApprove($id)
    {
        $application = Application::findOrFail($id);
        $application->update(['status_id' => Lookup('Status')->where('slug', 'do_approved')->first()->id]);

        return redirect()->route('dashboard')->with('message', 'Application '.$id.' is now approved by decanal committee member.');
    }

    public function committeeDenied($id)
    {
        $application = Application::findOrFail($id);
        $application->update(['status_id' => Lookup('Status')->where('slug', 'do_denied')->first()->id]);

        return redirect()->route('dashboard')->with('message', 'Application '.$id.' has been denied.');
    }

    // public function sendEmail()
    // {
    //     $data = ['message' => 'This is the message coming from the controller.'];

    //     Mail::to('faculty@example.com', 'dept_chair@example.com')->send(new RevisionEmail($data));

    //     return 'Email sent!';
    // }
}
