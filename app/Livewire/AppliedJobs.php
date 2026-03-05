<?php

namespace App\Livewire;

use App\Models\Application;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Applied Jobs')]
class AppliedJobs extends Component
{
    use WithPagination;

    public function render()
    {
        $applications = Application::query()
            ->where('user_id', auth()->id())
            ->with(['job'])
            ->latest()
            ->paginate(10);

        return view('livewire.applied-jobs', [
            'applications' => $applications,
        ]);
    }
}

