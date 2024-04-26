<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\Housing;
use App\Policies\ApplicationPolicy;
use App\Policies\HousingPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::policy(Application::class, ApplicationPolicy::class);
        Gate::policy(Housing::class, HousingPolicy::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
