<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationResumeController;
use App\Livewire\AppliedJobs;
use App\Livewire\ApplyJob;
use App\Livewire\JobFeed;
use App\Livewire\JobManager;

Route::get('/', JobFeed::class)->name('home');

Route::get('dashboard', function () {
    $user = auth()->user();

    return redirect()->route($user->isRecruiter() ? 'recruiter.jobs' : 'home');
})->middleware(['auth'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('applications/{application}/resume', ApplicationResumeController::class)
    ->middleware(['auth'])
    ->name('applications.resume');

Route::middleware(['auth', 'role:recruiter'])->group(function () {
    Route::get('recruiter/jobs', JobManager::class)->name('recruiter.jobs');
});

Route::middleware(['auth', 'role:seeker'])->group(function () {
    Route::get('jobs/{job}', ApplyJob::class)->name('jobs.apply');
    Route::get('applied-jobs', AppliedJobs::class)->name('jobs.applied');
});

require __DIR__.'/auth.php';
