@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">

    {{-- SUCCESS MESSAGE --}}
    @if (session('status'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{-- TOP BAR: CREATE BUTTON (RIGHT SIDE) --}}
    <div class="flex justify-end mb-6">
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('from.from') }}"
                   class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    + Create Job
                </a>
            @endif
        @endauth
    </div>
    <style>
        .bg-green-600 {
        background-color: green !important;
    }
    .bg-blue-600{
        background-color: blue !important;

    }
    </style>

    {{-- SEARCH FILTER BOX --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form action="{{ route('jobs.index') }}" method="GET"
              class="flex flex-col sm:flex-row gap-4 items-center">

            <input type="text"
                   name="search"
                   placeholder="Search by title, company, or location..."
                   value="{{ request('search') }}"
                   class="border border-gray-300 rounded-md px-4 py-2 flex-grow w-full sm:w-auto focus:ring-blue-500 focus:border-blue-500">

            <select name="per_page"
                    class="border border-gray-300 rounded-md px-4 py-2">
                @foreach([10, 25, 50] as $limit)
                    <option value="{{ $limit }}"
                        {{ (int)request('per_page', 10) === $limit ? 'selected' : '' }}>
                        Show {{ $limit }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-150 w-full sm:w-auto">
                Search
            </button>

            @if(request('search'))
                <a href="{{ route('jobs.index') }}"
                   class="text-sm text-red-500 hover:text-red-700 underline">
                    Clear Search
                </a>
            @endif
        </form>
    </div>

    {{-- JOB LIST --}}
    <div class="space-y-6">
        @forelse ($jobs as $job)
            <div class="border p-6 rounded-xl shadow-lg bg-white hover:shadow-2xl transition duration-300">

                {{-- TITLE + JOB TYPE --}}
                <div class="flex justify-between items-start">
                    <h3 class="text-2xl font-bold text-blue-700">
                        <a href="{{ route('jobs.show', $job) }}" 
                           class="hover:text-blue-900 transition duration-150">
                            {{ $job->title }}
                        </a>
                    </h3>

                    <span class="text-sm font-medium px-3 py-1 rounded-full 
                        {{ $job->job_type === 'Full-time' ? 'bg-green-100 text-green-800' : 
                           ($job->job_type === 'Part-time' ? 'bg-yellow-100 text-yellow-800' : 'bg-purple-100 text-purple-800') }}">
                        {{ $job->job_type }}
                    </span>
                </div>

                <p class="text-gray-700 mt-1 mb-2">
                    <strong>{{ $job->company }}</strong> | {{ $job->location }}
                </p>

                <p class="mt-2 text-gray-600 leading-relaxed">
                    {{ Str::limit($job->description, 120) }}
                </p>

                <div class="mt-4 text-sm text-gray-500 flex justify-between">
                    <span>
                        Salary: **{{ $job->salary ? '€' . number_format($job->salary, 0) : 'Negotiable' }}**
                    </span>

                    <span>
                        Posted: {{ $job->posted_at->diffForHumans() }}
                    </span>
                </div>

                {{-- ADMIN BUTTONS (RIGHT SIDE) --}}
                @auth
                    @if(auth()->user()->is_admin)
                        <div class="mt-5 flex justify-end gap-3">

                            <a href="{{ route('jobs.edit', $job) }}"
                               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Edit
                            </a>

                            <form action="{{ route('jobs.destroy', $job) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this job?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    Delete
                                </button>
                            </form>

                        </div>
                    @endif
                @endauth

            </div>

        @empty
            <div class="text-center p-10 bg-white rounded-lg shadow-md">
                <p class="text-xl text-gray-600">
                    No job listings found. Try adjusting your search query!
                </p>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-10">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
