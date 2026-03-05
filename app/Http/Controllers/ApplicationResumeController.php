<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationResumeController extends Controller
{
    public function __invoke(Request $request, Application $application)
    {
        $user = $request->user();

        $canDownload =
            ($user->isSeeker() && $application->user_id === $user->id) ||
            ($user->isRecruiter() && $application->job->user_id === $user->id);

        abort_unless($canDownload, 403);

        return Storage::disk('local')->download($application->resume_path);
    }
}

