<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Apply</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Upload a PDF resume to apply.</p>
        </div>
        <a href="{{ route('home') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500" wire:navigate>Back to feed</a>
    </div>

    <div class="mt-6 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
        <div class="flex flex-wrap items-center gap-2">
            <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $job->title }}</div>
            <span class="inline-flex items-center rounded-full bg-gray-100 dark:bg-gray-900 px-2.5 py-0.5 text-xs font-medium text-gray-700 dark:text-gray-300">
                {{ strtoupper($job->category) }}
            </span>
        </div>
        <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            <span class="font-medium text-gray-900 dark:text-gray-100">{{ $job->company }}</span>
            <span class="mx-2 text-gray-300 dark:text-gray-600">•</span>
            <span>{{ $job->location }}</span>
        </div>

        <div class="mt-4 text-sm text-gray-700 dark:text-gray-200 whitespace-pre-line">
            {{ $job->description }}
        </div>
    </div>

    <div class="mt-6 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
        <form wire:submit="apply" class="space-y-4">
            <div>
                <x-input-label for="resume" value="Resume (PDF only)" />
                <input id="resume" type="file" wire:model="resume" accept="application/pdf" class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 dark:file:bg-gray-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700 dark:file:text-gray-200 hover:file:bg-gray-200 dark:hover:file:bg-gray-800" />
                <x-input-error :messages="$errors->get('resume')" class="mt-2" />
                <div wire:loading wire:target="resume" class="mt-2 text-xs text-gray-500 dark:text-gray-400">Uploading…</div>
            </div>

            <div class="flex items-center gap-2">
                <x-primary-button>
                    Submit application
                </x-primary-button>
                <a href="{{ route('jobs.applied') }}" class="text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white" wire:navigate>
                    View applied jobs
                </a>
            </div>
        </form>
    </div>
</div>

