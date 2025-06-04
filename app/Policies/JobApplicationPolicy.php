<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function viewCompanyApplications(User $user, Company $company): bool
    {
        return $company->owner_id === $user->id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobApplication $jobApplication): bool
    {
        if ($jobApplication->user_id === $user->id) {
            return true;
        }

        // Company owner can view applications for their job postings
        return $user->id === optional($jobApplication->jobPosting->company)->owner_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }
}
