<?php

namespace App\Livewire;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
#[Title('Apply')]
class ApplyJob extends Component
{
    use WithFileUploads;

    public Job $job;

    /** @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile|null */
    public $resume = null;

    public function mount(Job $job): void
    {
        $this->job = $job;
    }

    public function apply(): void
    {
        $this->validate([
            'resume' => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        if (! $this->job->is_active) {
            throw ValidationException::withMessages([
                'resume' => 'This job is not accepting applications.',
            ]);
        }

        $alreadyApplied = Application::query()
            ->where('job_id', $this->job->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($alreadyApplied) {
            $this->redirect(route('jobs.applied', absolute: false), navigate: true);
            return;
        }

        $path = $this->resume->store(
            "resumes/{$this->job->id}",
            'local'
        );

        Application::create([
            'job_id' => $this->job->id,
            'user_id' => auth()->id(),
            'resume_path' => $path,
        ]);

        $this->redirect(route('jobs.applied', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.apply-job');
    }
}

