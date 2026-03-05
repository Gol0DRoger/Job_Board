<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Jobs')]
class JobFeed extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $search = '';

    #[Url(history: true)]
    public string $category = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $jobsQuery = Job::query()
            ->with(['recruiter:id,name,email'])
            ->latest();

        if ($this->search !== '') {
            $search = trim($this->search);
            $jobsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($this->category !== '') {
            $jobsQuery->where('category', $this->category);
        }

        if (auth()->check() && auth()->user()->isSeeker()) {
            $userId = auth()->id();
            $jobsQuery->whereDoesntHave('applications', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        }

        return view('livewire.job-feed', [
            'jobs' => $jobsQuery->paginate(10),
        ]);
    }
}

