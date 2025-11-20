<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Job;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Runs before any other checks (for Admins).
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->is_admin) { // Assumes 'is_admin' field on User model
            return true;
        }
        return null;
    }

    /**
     * Determine if the user can update the job.
     */
    public function update(User $user, Job $job): bool
    {
        return $user->id === $job->user_id;
    }

    /**
     * Determine if the user can delete the job.
     */
    public function delete(User $user, Job $job): bool
    {
        return $user->id === $job->user_id;
    }
}