<?php

use App\Models\Application;
use App\Models\Lookup\Status;

function lookup($model)
{
    if ($model === 'Application') {
        return Application::with('program', 'user')->get();
    }

    if ($model === 'Status') {
        return Status::all();
    }
}
