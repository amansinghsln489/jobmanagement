<?php
namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class JobController extends Controller
{
    public function __construct()
    {
      
        $this->middleware('auth')->except(['index', 'show']);
    }

   
    public function index(Request $request)
    {
      
        $perPage = min($request->get('per_page', 10), 50);

        $jobs = Job::latest()
            ->search($request->search) // Eloquent Scope for searching
            ->paginate($perPage)
            ->withQueryString();

          

        return view('jobs.index', compact('jobs'));
    }

  
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    // --- Post a Job (CREATE/STORE) ---
    public function from()
    {
        
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'company' => 'required|string|max:150',
            'location' => 'required|string|max:150',
            'description' => 'required|string',
            'salary' => 'nullable|numeric',
            'job_type' => 'required|in:Full-time,Part-time,Contract',
        ]);
    
        Job::create($validated + [
            'user_id' => Auth::id(),
            'posted_at' => now(),
        ]);
    
        return redirect()->route('jobs.index')->with('status', 'Job created successfully!');
    }
    

    
    public function edit(Job $job)
    {
        $this->authorize('update', $job); 
        return view('jobs.edit', compact('job'));
    }

    public function jobUpdate(Request $request, Job $job)
    {
        $this->authorize('update', $job); // Policy check

        
        $job->update([
            'title'       => $request->title,
            'company'     => $request->company,
            'location'    => $request->location,
            'description' => $request->description,
            'salary'      => $request->salary,
            'job_type'    => $request->job_type ?? $job->job_type, // keep old
        ]);

        return redirect()->route('jobs.index')->with('status', 'Job updated successfully!');
    }


    // --- Delete a Job (DESTROY) ---
    public function destroy(Job $job)
    {
        $this->authorize('delete', $job); 

        
        $job->delete();

        return redirect()->route('jobs.index')->with('status', 'Job deleted successfully.');
    }

   
    public function trashed()
    {
    
        $trashedJobs = Job::onlyTrashed()->latest()->paginate(10);

        return view('jobs.trashed', compact('trashedJobs'));
    }
}