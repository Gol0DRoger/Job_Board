<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Applied Jobs</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Your application history.</p>
        </div>
        <a href="{{ route('home') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500" wire:navigate>Back to feed</a>
    </div>

    <div class="mt-6 space-y-3">
        @forelse ($applications as $application)
            <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <div class="text-lg font-semibold text-gray-900 dark:text-gray-100 truncate">
                            {{ $application->job->title }}
                        </div>
                        <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ $application->job->company }}</span>
                            <span class="mx-2 text-gray-300 dark:text-gray-600">•</span>
                            <span>{{ $application->job->location }}</span>
                            <span class="mx-2 text-gray-300 dark:text-gray-600">•</span>
                            <span>{{ strtoupper($application->job->category) }}</span>
                        </div>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            Applied {{ $application->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="shrink-0">
                        <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500" href="{{ route('applications.resume', $application) }}">
                            Download resume
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-lg border border-dashed border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-8 text-center">
                <div class="text-sm text-gray-600 dark:text-gray-400">You haven’t applied to any jobs yet.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $applications->links() }}
    </div>
</div>

