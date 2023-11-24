<?php

use App\Models\User;
use App\Models\Application;
use App\Models\Lookup\Role;
use App\Models\Lookup\Status;

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
