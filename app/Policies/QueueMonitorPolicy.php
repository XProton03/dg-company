<?php

namespace App\Policies;

use Croustibat\FilamentJobsMonitor\Models\QueueMonitor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class QueueMonitorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_queuemonitor');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, QueueMonitor $queueMonitor): bool
    {
        return $user->can('view_queuemonitor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_queuemonitor');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, QueueMonitor $queueMonitor): bool
    {
        return $user->can('update_queuemonitor');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, QueueMonitor $queueMonitor): bool
    {
        return $user->can('delete_queuemonitor');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_queuemonitor');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, QueueMonitor $queueMonitor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, QueueMonitor $queueMonitor): bool
    {
        return false;
    }
}
