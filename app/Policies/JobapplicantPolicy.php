<?php

namespace App\Policies;

use App\Models\Jobapplicant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobapplicantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_role');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Jobapplicant $jobapplicant): bool
    {
        return $user->can('view_role');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_role');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Jobapplicant $jobapplicant): bool
    {
        return $user->can('update_role');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Jobapplicant $jobapplicant): bool
    {
        return $user->can('delete_role');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_role');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Jobapplicant $jobapplicant): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Jobapplicant $jobapplicant): bool
    {
        return false;
    }
}
