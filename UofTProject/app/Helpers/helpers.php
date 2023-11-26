<?php

use App\Models\User;
use App\Models\Application;
use App\Models\Lookup\Role;
use App\Models\Lookup\Status;
use App\Models\Lookup\ApplicantStatus;
use Illuminate\Database\Eloquent\Model;

function lookup($model)
{
    if ($model === 'Application') {
        return Application::with('program', 'user')->get();
    }

    if ($model === 'Status') {
        return Status::all();
    }

    if ($model === 'User') {
        return User::all(); //refactor this line
    }

    if ($model === 'Role') {
        return Role::all();
    }
}

function LookupApplicantStatus($type){
    if(is_numeric($type)) {
        return ApplicantStatus::findOrFail($type)->name;
    }elseif(is_string($type)) {
        return ApplicantStatus::where('slug', $type)->id;
    }else{
        dump('none');
    }
}

// function Lookups(Model $model, string|int $type){
//     if(is_numeric($type)) {
//         return $model->findOrFail($type)->name;
//     }elseif(is_string($type)) {
//         return $model->where('slug', $type)->id;
//     }else{
//         dump('none');
//     }
// }
