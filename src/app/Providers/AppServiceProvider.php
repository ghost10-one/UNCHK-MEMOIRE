<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Models\User;
use App\Models\Visit;
use App\Policies\CampaignPolicy;
use App\Policies\UserPolicy;
use App\Policies\VisitPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Campaign::class, CampaignPolicy::class);
        Gate::policy(Visit::class, VisitPolicy::class);

        \App\Models\Visite::observe(\App\Observers\VisiteObserver::class);
    }
}
