<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\Housing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApplicationPolicy
{
    public function __construct(
        protected User $user,
        protected Application $application
    )
    {}

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Application $application): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param int $housingId
     * @return Response
     */
    public function create(User $user, int $housingId): Response
    {
        $housings = Housing::where('user_id', $user->id)->pluck('id')->toArray();
        $housingsAppliedTo = Application::where('user_id', $user->id)->pluck('housing_id')->toArray();

        if(in_array($housingId, $housings)){
            return Response::deny('You cannot apply to your own housing');
        }

        if(in_array($housingId, $housingsAppliedTo)){
            return Response::deny('You have already applied to this housing');
        }

        return Response::allow('Application created successfully');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Application $application): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Application $application): bool
    {
        //
    }
}
