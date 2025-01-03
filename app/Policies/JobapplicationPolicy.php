<?php

namespace App\Policies;

use App\Models\Jobapplication;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobapplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_jobapplication');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Jobapplication $jobapplication): bool
    {
        return $user->can('view_jobapplication');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_jobapplication');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Jobapplication $jobapplication): bool
    {
        return $user->can('update_jobapplication');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Jobapplication $jobapplication): bool
    {
        return $user->can('delete_jobapplication');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_jobapplication');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Jobapplication $jobapplication): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Jobapplication $jobapplication): bool
    {
        return false;
    }
}
