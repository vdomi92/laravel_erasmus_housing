<?php

namespace App\Policies;

use App\Models\Housing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HousingPolicy
{
    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Housing $housing
     * @return Response
     */
    public function update(User $user, Housing $housing): Response
    {
        if($user->id !== $housing->user_id){
            return Response::deny('You are not the owner of this housing');
        }

        return Response::allow('Housing updated successfully');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Housing $housing): bool
    {
        //pending applications?
        //is owner of house?
    }
}
