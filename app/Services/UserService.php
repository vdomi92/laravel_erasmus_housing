<?php

namespace App\Services;

use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param RegisterUserRequest $request
     * @return void
     */
    public function create(RegisterUserRequest $request): void
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'age' => $request['age'],
        ]);

        event(new Registered($user));

        Auth::login($user);
    }

    // Could add update, delete, etc. methods here, will keep the original scaffolded files for now
}
