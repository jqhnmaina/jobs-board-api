<?php

namespace App\Policies;

use App\Models\JobPosting;
use App\Models\User;

class JobPostingPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobPosting $jobPosting): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, int $companyId): bool
    {
        return $user->companies()->where('id', $companyId)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobPosting $jobPosting): bool
    {
        return $user->id === $jobPosting->company->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobPosting $jobPosting): bool
    {
        return $user->id === $jobPosting->company->owner_id;
    }
}
