<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\RevisionEmail;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\ApplicationInfo;
use App\Models\ApplicationBudget;
use App\Models\ApplicationSummary;
use App\Models\ApplicationActivity;
use App\Models\ApplicationItinerary;
use Illuminate\Support\Facades\Mail;
use App\Services\ApplicationBudgetService;

class ApplicationController extends Controller
{
    public function create(){

        $userId = auth()->user()->id;
        $roleId = auth()->user()->role_id;
        $pageMode = 'create';

        return view('application', compact('roleId', 'pageMode'));
    }

    public function view(int $id){

        $userId = auth()->user()->id;
        $roleId = auth()->user()->role_id;
        $pageMode = 'view';
        $application = Application::findOrFail($id);

        return view('application', compact('application', 'roleId', 'pageMode'));
    }

    public function store(Request $request, ApplicationBudgetService $applicationBudgetService){
        dump($request->all());



        if(!isset($request['id'])){
            //-- create
            $data= [
                'program_id' => 1,
                'user_id'    => auth()->user()->id,
                'academic_year' => Carbon::now()->year,
                'no_of_students' => 3,
                'status_id'  => 2,
                'created_at' => Carbon::now()
            ];

            $application = Application::create($data);
            $insertedId = $application->id;
        }else{
            //-- edit
            $insertedId = $request['id'];
            $application= Application::findOrFail($insertedId);
            //$application->applicationInfos->each->forceDelete();
            $application->applicationActivity->forceDelete();
            $application->applicationSummary->forceDelete();
            //$application->applicationItineraries->each->forceDelete();
            //$application->applicationBudgets->each->forceDelete();
        }

        //dump($insertedId);



        $infos = [];
        $i = 0;
        while (true) {
            $lastNameKey = 'last_name-'.$i;
            $firstNameKey = 'first_name-'.$i;
            $statusKey = 'status-'.$i;
            $sponsorKey = 'sponsor-'.$i;
            $emailKey = 'email-'.$i;

            if (!isset($request[$lastNameKey]) && !isset($request[$firstNameKey]) &&
                !isset($request[$statusKey]) && !isset($request[$sponsorKey]) && !isset($request[$emailKey]) ) {
                break;
            }

            $info = [];
            if (isset($request[$lastNameKey])) {
                $info['last_name'] = $request[$lastNameKey];
            }
            if (isset($request[$firstNameKey])) {
                $info['first_name'] = $request[$firstNameKey];
            }
            if (isset($request[$statusKey])) {
                $info['status'] = $request[$statusKey];
            }
            if (isset($request[$sponsorKey])) {
                $info['sponsor'] = $request[$sponsorKey];
            }
            if (isset($request[$emailKey])) {
                $info['email'] = $request[$emailKey];
            }
            $info['application_id'] = $insertedId;
            $info['created_at'] = Carbon::now();

            $infos[] = $info;
            $i++;
        }
        ApplicationInfo::insert($infos);

        $itineraries = [];
        $i = 0;
        while (true) {
            $dateKey = 'itinerary_date-'.$i;
            $locationKey = 'itinerary_location-'.$i;
            $activityKey = 'itinerary_activity-'.$i;

            if (!isset($request[$dateKey]) && !isset($request[$locationKey]) && !isset($request[$activityKey])) {
                break;
            }

            $itinerary = [];
            if (isset($request[$dateKey])) {
                $itinerary['dates'] = $request[$dateKey];
            }
            if (isset($request[$locationKey])) {
                $itinerary['location'] = $request[$locationKey];
            }
            if (isset($request[$activityKey])) {
                $itinerary['activity'] = $request[$activityKey];
            }
            $itinerary['application_id'] = $insertedId;
            $itinerary['created_at'] = Carbon::now();

            $itineraries[] = $itinerary;
            $i++;
        }
        ApplicationItinerary::insert($itineraries);


        $summaryBudget= [
            "application_id" => $insertedId,
            "course_code" => $request['course-title'],
            "students_enrolled" => $request['students-enrolled'],
            "students_participate" => $request['students-participate'],
            "location" => $request['location'],
            "travel_date" => $request['travel-date'],
            "amount_requested" => $request['amount-requested'],
            'created_at' => Carbon::now(),
        ];
        ApplicationSummary::insert($summaryBudget);

        $activityBudget= [
            "application_id" => $insertedId,
            "description" => $request['description'],
            "outcome" => $request['outcome'],
            'created_at' => Carbon::now(),
        ];
        ApplicationActivity::insert($activityBudget);

        $travelBudget = $applicationBudgetService->prepareDataByCategoryNameForDB($request, 1, $insertedId);
        ApplicationBudget::insert($travelBudget);

        $accommodationBudget = $applicationBudgetService->prepareDataByCategoryNameForDB($request, 2, $insertedId);
        ApplicationBudget::insert($accommodationBudget);

        $foodBudget = $applicationBudgetService->prepareDataByCategoryNameForDB($request, 3, $insertedId);
        ApplicationBudget::insert($foodBudget);

        $fundBudget = $applicationBudgetService->prepareDataByCategoryNameForDB($request, 4, $insertedId);
        ApplicationBudget::insert($fundBudget);

        //--check if the faculty member has applied already in this academic year
        if(Application::where('academic_year', '2023')->where('user_id', auth()->user()->id)->get()->count()>1 && !isset($request['id'])){  /////////////////////hardcoded
            $application->update(['status_id' => Lookup('Status')->where('slug', 'on_hold')->first()->id]);
            return redirect()->route('dashboard')->with('message', 'Faculty Members are only allowed one submission per academic session, pending an exception from the Department Chair.');
        }else{
            $application->update(['status_id' => Lookup('Status')->where('slug', 'pending_dept_approval')->first()->id]);
            return redirect()->route('dashboard')->with('message', 'Application has been saved Successfully.');
        }


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

        $message = "The DO Committee has approved this application.";
        $this->sendEMail($message, ['faculty@example.com', 'chair@example.com']);

        return redirect()->route('dashboard')->with('message', 'Application '.$id.' is now approved by decanal committee member.');
    }

    public function committeeDenied($id)
    {
        $application = Application::findOrFail($id);
        $application->update(['status_id' => Lookup('Status')->where('slug', 'do_denied')->first()->id]);

        $message = "The DO Committee has denied this application.";
        $this->sendEMail($message, ['faculty@example.com', 'chair@example.com']);

        return redirect()->route('dashboard')->with('message', 'Application '.$id.' has been denied.');
    }


    public function sendEmail(string $message, array $recipient): void
    {
        //-- this should be done using job queue

        $data = ['message' => $message];

       // Mail::to('faculty@example.com', 'chair@example.com')->send(new RevisionEmail($data));
        Mail::to($recipient)->send(new RevisionEmail($data));

        //return 'Email sent!';
    }


}
