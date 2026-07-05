<?php

namespace App\Providers;

use App\Http\Livewire\AdminDashboard;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Visit;
use App\Policies\CampaignPolicy;
use App\Policies\UserPolicy;
use App\Policies\VisitPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Policies\MessagePolicy;
use Livewire\Livewire;
use Illuminate\Support\Facades\URL;

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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Campaign::class, CampaignPolicy::class);
        Gate::policy(Visit::class, VisitPolicy::class);
        Gate::policy(Message::class, MessagePolicy::class);

        // Register Livewire components explicitly
        Livewire::component('admin-dashboard', AdminDashboard::class);
        \App\Models\Visite::observe(\App\Observers\VisiteObserver::class);
        
    }
}
