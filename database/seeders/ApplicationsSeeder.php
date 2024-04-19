<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Housing;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApplicationsSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $users = User::all();
        $housings = Housing::all();

        foreach ($housings as $housing) {
            $amount = rand(1, 5);
            $applyingUsers = $users->random($amount);

            foreach ($applyingUsers as $user) {
                Application::factory()->create([
                    'user_id' => $user->id,
                    'housing_id' => $housing->id
                ]);
            }
        }
    }
}
