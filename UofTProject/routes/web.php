<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/download', [DashboardController::class, 'download'])->name('dashboard.download');

    Route::get('/create-application', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/save-application', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/dept-approve-application/{id}', [ApplicationController::class, 'deptApprove'])->name('application.deptApprove');
    Route::get('/pending-do-approve-application/{id}', [ApplicationController::class, 'pendingDOApprove'])->name('application.pendingDOApprove');
    Route::get('/committee-approve-application/{id}', [ApplicationController::class, 'committeeApprove'])->name('application.committeeApprove');
    Route::get('/committee-denied-application/{id}', [ApplicationController::class, 'committeeDenied'])->name('application.committeeDenied');
    Route::get('/view-application/{id}', [ApplicationController::class, 'view'])->name('application.view');

    Route::get('/get-comments', [CommentController::class, 'getComment'])->name('comment.get');
    Route::post('/save-comments', [CommentController::class, 'saveComment'])->name('comment.save');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
