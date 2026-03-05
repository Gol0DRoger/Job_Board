<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Job Feed</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Search by title or location, then filter by category.</p>
        </div>

        @auth
            <div class="text-right">
                <div class="text-xs text-gray-500 dark:text-gray-400">Signed in as</div>
                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ auth()->user()->name }}
                    <span class="text-gray-500 dark:text-gray-400">({{ auth()->user()->role }})</span>
                </div>
            </div>
        @endauth
    </div>

    <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
        <div class="sm:col-span-2">
            <x-input-label for="search" value="Search" />
            <x-text-input id="search" wire:model.live="search" class="mt-1 block w-full" type="text" placeholder="e.g. Backend, Lagos, Remote" />
        </div>

        <div>
            <x-input-label for="category" value="Category" />
            <select id="category" wire:model.live="category" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">All</option>
                <option value="remote">Remote</option>
                <option value="hybrid">Hybrid</option>
                <option value="wfo">WFO</option>
            </select>
        </div>
    </div>

    <div class="mt-6 space-y-4">
        @forelse ($jobs as $job)
            <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 truncate">
                                {{ $job->title }}
                            </h2>
                            <span class="inline-flex items-center rounded-full bg-gray-100 dark:bg-gray-900 px-2.5 py-0.5 text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ strtoupper($job->category) }}
                            </span>
                        </div>

                        <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ $job->company }}</span>
                            <span class="mx-2 text-gray-300 dark:text-gray-600">•</span>
                            <span>{{ $job->location }}</span>
                        </div>

                        <div class="mt-3 text-sm text-gray-700 dark:text-gray-200 whitespace-pre-line">
                            {{ \Illuminate\Support\Str::limit($job->description, 220) }}
                        </div>
                    </div>

                    <div class="shrink-0">
                        @guest
                            <a href="{{ route('login') }}" class="inline-flex items-center rounded-md bg-lime-400 px-3 py-2 text-sm font-medium text-gray-900 hover:bg-lime-300" wire:navigate>
                                Log in to apply
                            </a>
                        @else
                            @if (auth()->user()->isSeeker())
                                <a href="{{ route('jobs.apply', $job) }}" class="inline-flex items-center rounded-md bg-lime-400 px-3 py-2 text-sm font-medium text-gray-900 hover:bg-lime-300" wire:navigate>
                                    Apply
                                </a>
                            @elseif (auth()->id() === $job->user_id)
                                <a href="{{ route('recruiter.jobs') }}" class="inline-flex items-center rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-gray-100 hover:bg-gray-800" wire:navigate>
                                    Manage job
                                </a>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-lg border border-dashed border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-8 text-center">
                <div class="text-sm text-gray-600 dark:text-gray-400">No jobs found.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
</div>

