<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Auth\Access\Response;

class UserActivityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-activities');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserActivity $userActivity): bool
    {
        return $user->hasPermission('view-activities');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false; // Activities are created automatically
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserActivity $userActivity): bool
    {
        return false; // Activities should not be editable
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserActivity $userActivity): bool
    {
        return $user->hasRole('super-admin'); // Only super admin can delete activities
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, UserActivity $userActivity): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, UserActivity $userActivity): bool
    {
        return $user->hasRole('super-admin');
    }
}
