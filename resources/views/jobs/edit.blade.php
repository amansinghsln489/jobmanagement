@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/job-form.css">

<div class="job-form-container">

    <div class="job-form-card">
        <h2 class="job-form-title">✏️ Edit Job</h2>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jobs.jobupdate', $job) }}" method="POST">
            @csrf
           

            <!-- Job Title -->
            <div class="form-group">
                <label>Job Title</label>
                <input type="text" name="title" value="{{ old('title', $job->title) }}" required>
            </div>

            <!-- Company -->
            <div class="form-group">
                <label>Company</label>
                <input type="text" name="company" value="{{ old('company', $job->company) }}" required>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="{{ old('location', $job->location) }}" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Job Description</label>
                <textarea name="description" rows="6" required>{{ old('description', $job->description) }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="form-buttons">
                <a href="{{ route('jobs.show', $job) }}" class="btn btn-cancel">Cancel</a>
                <button type="submit" class="btn btn-save">Update Job</button>
            </div>

        </form>
    </div>

</div>
@endsection
