<?php

namespace Database\Seeders;

use App\Models\Housing;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserHousesSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        User::factory(20)->create();
        User::factory(5)->has(
            Housing::factory()->count(1)
        )->create();
        User::factory(5)->has(
            Housing::factory()->count(2)
        )->create();
    }
}
