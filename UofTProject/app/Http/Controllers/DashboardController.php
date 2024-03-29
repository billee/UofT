<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\Lookup\Status;
use App\Exports\DashboardExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
//use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Rap2hpoutre\FastExcel\FastExcel;

class DashboardController extends Controller
{
    public function index(){

        $userId = auth()->user()->id;
        $roleId = auth()->user()->role_id;

        $bRoleId = (1==$roleId) ? true : false;

        $applications = Application::with('program', 'user',  'status')
            ->when($bRoleId, function ($query) use($userId){
                return $query->whereHas('user', function ($query) use($userId) {
                    $query->where('role_id', 1)->where('id', $userId);
                });
            })
            ->whereHas('status', function ($query) use ($roleId) {
                $query->whereRaw('FIND_IN_SET(?, show_to_role_ids)', [$roleId]);
            })
            ->get();


        return view('dashboard', compact('applications', 'userId', 'roleId'));
    }

    public function download()
    {
        $applications = Application::all();

        return (new FastExcel($applications))->download('applications.xlsx');
    }

}
