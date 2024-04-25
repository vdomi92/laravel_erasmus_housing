<?php

namespace App\Policies;

use App\Models\Housing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HousingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Housing $housing): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Housing $housing
     * @return Response
     */
    public function update(User $user, Housing $housing): Response
    {
        if($user->id === $housing->user_id){
            return Response::allow('Housing updated successfully');
        }

        return Response::deny('You are not the owner of this housing');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Housing $housing): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Housing $housing): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Housing $housing): bool
    {
        //
    }
}
