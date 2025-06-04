<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobPostingResource;
use App\Models\JobPosting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobPosting::query();

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($jobType = $request->query('job_type')) {
            $query->where('job_type', $jobType);
        }

        if ($request->boolean('active_only', false)) {
            $query->where('expires_at', '>', now());
        }

        $query->orderByDesc('created_at');

        $perPage = $request->query('per_page', 10);
        $paginated = $query->latest()->paginate($perPage);

        return JobPostingResource::collection($paginated);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'cv_required' => 'required|boolean',
            'cover_letter_required' => 'required|boolean',
            'location' => 'required|string',
            'min_salary' => 'required|integer|min:0',
            'max_salary' => 'required|integer|min:0',
            'job_type' => 'required|string',
            'expires_at' => 'required|date',
            'company_id' => 'required|exists:companies,id',
        ]);

        $this->authorize('create', [JobPosting::class, $data['company_id']]);

        $jobPosting = JobPosting::create($data);

        return new JobPostingResource($jobPosting);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosting $jobPosting)
    {
        $this->authorize('view', $jobPosting);

        return new JobPostingResource($jobPosting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPosting $jobPosting)
    {
        $this->authorize('update', $jobPosting);

        $data = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'cv_required' => 'sometimes|boolean',
            'cover_letter_required' => 'sometimes|boolean',
            'location' => 'sometimes|string',
            'min_salary' => 'sometimes|integer|min:0',
            'max_salary' => 'sometimes|integer|min:0',
            'job_type' => 'sometimes|string',
            'expires_at' => 'sometimes|date',
        ]);

        $jobPosting->update($data);

        return new JobPostingResource($jobPosting);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPosting $jobPosting)
    {
        $this->authorize('delete', $jobPosting);

        $jobPosting->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
