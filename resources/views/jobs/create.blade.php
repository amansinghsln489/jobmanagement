@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/job-form.css">

<div class="job-container">

    <div class="job-card">
        <h2 class="job-title">➕ Create New Job</h2>

        <form action="{{ route('jobs.save') }}" method="POST">
           @csrf
            {{-- Job Title --}}
            <div class="form-group">
                <label>Job Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required>
            </div>

            {{-- Company --}}
            <div class="form-group">
                <label>Company</label>
                <input type="text" name="company" value="{{ old('company') }}" required>
            </div>

            {{-- Location --}}
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="{{ old('location') }}" required>
            </div>

            {{-- Salary --}}
            <div class="form-group">
                <label>Salary (optional)</label>
                <input type="number" name="salary" value="{{ old('salary') }}">
            </div>

            {{-- Job Type --}}
            <div class="form-group">
                <label>Job Type</label>
                <select name="job_type" required>
                    <option value="">Select Type</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                </select>
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label>Job Description</label>
                <textarea name="description" rows="6" required>{{ old('description') }}</textarea>
            </div>

            {{-- Buttons --}}
            <div class="form-buttons">
                <a href="{{ route('jobs.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">Create Job</button>
            </div>

        </form>
    </div>

</div>
@endsection
