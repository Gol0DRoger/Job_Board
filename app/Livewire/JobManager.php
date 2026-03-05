<?php

namespace App\Livewire;

use App\Models\Application;
use App\Models\Job;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manage Jobs')]
class JobManager extends Component
{
    use WithPagination;

    public ?int $editingJobId = null;

    public string $title = '';
    public string $company = '';
    public string $location = '';
    public string $category = 'remote';
    public string $description = '';

    public ?int $viewApplicantsForJobId = null;

    public function edit(int $jobId): void
    {
        $job = Job::query()
            ->where('id', $jobId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $this->editingJobId = $job->id;
        $this->title = $job->title;
        $this->company = $job->company;
        $this->location = $job->location;
        $this->category = $job->category;
        $this->description = $job->description;
    }

    public function cancelEdit(): void
    {
        $this->reset(['editingJobId', 'title', 'company', 'location', 'category', 'description']);
        $this->category = 'remote';
    }

    public function save(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:remote,hybrid,wfo'],
            'description' => ['required', 'string'],
        ]);

        if ($this->editingJobId) {
            $job = Job::query()
                ->where('id', $this->editingJobId)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $job->update($validated);
        } else {
            Job::create([
                ...$validated,
                'user_id' => auth()->id(),
            ]);
        }

        $this->cancelEdit();
    }

    public function delete(int $jobId): void
    {
        Job::query()
            ->where('id', $jobId)
            ->where('user_id', auth()->id())
            ->delete();

        if ($this->viewApplicantsForJobId === $jobId) {
            $this->viewApplicantsForJobId = null;
        }
    }

    public function toggleApplicants(int $jobId): void
    {
        $this->viewApplicantsForJobId = $this->viewApplicantsForJobId === $jobId ? null : $jobId;
    }

    public function render()
    {
        $jobs = Job::query()
            ->where('user_id', auth()->id())
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        $applicants = collect();

        if ($this->viewApplicantsForJobId) {
            $applicants = Application::query()
                ->where('job_id', $this->viewApplicantsForJobId)
                ->whereHas('job', function ($q) {
                    $q->where('user_id', auth()->id());
                })
                ->with(['user:id,name,email'])
                ->latest()
                ->get();
        }

        return view('livewire.job-manager', [
            'jobs' => $jobs,
            'applicants' => $applicants,
        ]);
    }
}

