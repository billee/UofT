<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Mail\RevisionEmail;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function getComment(Request $request){
        $postId = $request->query('postId');
        $comments = Comment::where('application_id', $postId)->get();

        return response()->json($comments);
    }

    public function saveComment(Request $request){
        $application = Application::findOrFail($request->id);
        $user_role_id = auth()->user()->role_id;

        $department_chair_role_id = Lookup('Role')->where('slug', 'department_chair')->first()->id;
        $faculty_member_role_id = Lookup('Role')->where('slug', 'faculty_member')->first()->id;
        $dean_office_administrator_role_id = Lookup('Role')->where('slug', 'dean_office_administrator')->first()->id;
        $decanal_committee_member_role_id = Lookup('Role')->where('slug', 'decanal_committee_member')->first()->id;


        if($department_chair_role_id == $user_role_id) {
            $role_slug = 'pending_revisions';
        }elseif($decanal_committee_member_role_id  == $user_role_id) {
            $role_slug = 'do_conditionally_approved';
        }elseif($dean_office_administrator_role_id == $user_role_id) {
            $role_slug = 'pending_do_revisions';
        }elseif($faculty_member_role_id == $user_role_id){
            $role_slug = 'pending_dept_approval';
        }

        $application->update(['status_id' => Lookup('Status')->where('slug', $role_slug)->first()->id]);

        $application->comments()->insert([
            'application_id' => $request->id,
            'comment' => $request->comment,
            'comment_by' => auth()->user()->id,
            'created_at' => now()
        ]);

        $this->sendEMail();

        return response()->json(['success' => true, 'message' => 'Comment has been added to application '.$request->id.'.']);

        //return redirect()->route('dashboard')->with('message', 'Comment has been added to application '.$request->id.'.');
    }

    public function sendEmail()
    {
        $data = ['message' => 'This is the message coming from the controller.'];

        Mail::to('faculty@example.com', 'dept_chair@example.com')->send(new RevisionEmail($data));

        return 'Email sent!';
    }
}
