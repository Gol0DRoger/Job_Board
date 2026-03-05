<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Job Manager</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Create and manage your job postings. Only you can see and edit your jobs.</p>
        </div>
        <a href="{{ route('home') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500" wire:navigate>Back to feed</a>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                {{ $editingJobId ? 'Edit Job' : 'Create Job' }}
            </h2>

            <form class="mt-4 space-y-4" wire:submit="save">
                <div>
                    <x-input-label for="title" value="Title" />
                    <x-text-input id="title" wire:model="title" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="company" value="Company" />
                    <x-text-input id="company" wire:model="company" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('company')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <x-input-label for="location" value="Location" />
                        <x-text-input id="location" wire:model="location" class="mt-1 block w-full" type="text" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category" value="Category" />
                        <select id="category" wire:model="category" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="remote">Remote</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="wfo">WFO</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" wire:model="description" rows="6" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center gap-2">
                    <x-primary-button>
                        {{ $editingJobId ? 'Update' : 'Publish' }}
                    </x-primary-button>

                    @if ($editingJobId)
                        <button type="button" wire:click="cancelEdit" class="inline-flex items-center rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800">
                            Cancel
                        </button>
                    @endif
                </div>
            </form>
        </div>

        <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Your Jobs</h2>

            <div class="mt-4 space-y-3">
                @forelse ($jobs as $job)
                    <div class="rounded-md border border-gray-200 dark:border-gray-700 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <div class="font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $job->title }}</div>
                                    <span class="inline-flex items-center rounded-full bg-gray-100 dark:bg-gray-900 px-2 py-0.5 text-xs font-medium text-gray-700 dark:text-gray-300">
                                        {{ strtoupper($job->category) }}
                                    </span>
                                </div>
                                <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $job->company }} • {{ $job->location }}
                                </div>
                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Applicants: {{ $job->applications_count }}
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <button wire:click="toggleApplicants({{ $job->id }})" type="button" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                    {{ $viewApplicantsForJobId === $job->id ? 'Hide' : 'Applicants' }}
                                </button>
                                <button wire:click="edit({{ $job->id }})" type="button" class="text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $job->id }})" type="button" class="text-sm font-medium text-red-600 hover:text-red-500">
                                    Delete
                                </button>
                            </div>
                        </div>

                        @if ($viewApplicantsForJobId === $job->id)
                            <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-3">
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Applicants</div>
                                <div class="mt-2 space-y-2">
                                    @forelse ($applicants as $application)
                                        <div class="flex items-center justify-between gap-3 rounded-md bg-gray-50 dark:bg-gray-900 p-3">
                                            <div class="min-w-0">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $application->user->name }}</div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ $application->user->email }}</div>
                                            </div>
                                            <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500 shrink-0" href="{{ route('applications.resume', $application) }}">
                                                Download resume
                                            </a>
                                        </div>
                                    @empty
                                        <div class="text-sm text-gray-600 dark:text-gray-400">No applications yet.</div>
                                    @endforelse
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="rounded-md border border-dashed border-gray-300 dark:border-gray-700 p-6 text-center text-sm text-gray-600 dark:text-gray-400">
                        You haven’t posted any jobs yet.
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</div>

