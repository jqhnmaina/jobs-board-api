<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobApplicationResource;
use App\Models\Company;
use App\Models\JobApplication;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobApplicationController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $applications = JobApplication::with('jobPosting')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return JobApplicationResource::collection($applications);
    }

    /**
     * Display a listing of the resource.
     */
    public function companyApplications(Request $request, Company $company)
    {
        $this->authorize('viewCompanyApplications', $company);

        $applications = JobApplication::with('user', 'jobPosting')
            ->whereHas('jobPosting', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })
            ->latest()
            ->paginate(10);

        return JobApplicationResource::collection($applications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
            'introduction' => 'required|string',
            'cover_letter' => 'required|file|mimes:pdf|max:2048',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $user = $request->user();

        $exists = JobApplication::where('user_id', $user->id)
            ->where('job_posting_id', $request->job_posting_id)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'job_posting_id' => ['You have already applied to this job.'],
            ]);
        }

        $coverLetterPath = $request->file('cover_letter')->store('cover_letters', 'public');
        $cvPath = $request->file('cv')->store('cvs', 'public');

        $application = JobApplication::create([
            'user_id' => $user->id,
            'job_posting_id' => $request->job_posting_id,
            'introduction' => $request->introduction,
            'cover_letter_path' => $coverLetterPath,
            'cv_path' => $cvPath,
        ]);

        return new JobApplicationResource($application);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        $this->authorize('view', $jobApplication);
        return new JobApplicationResource($jobApplication->load('jobPosting', 'user'));
    }
}
