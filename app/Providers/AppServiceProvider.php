<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
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
        $this->configureModels();
        $this->configureUrl();
        $this->bladeHelpers();
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();
        Model::unguard();
    }

    private function configureUrl(): void
    {
        URL::forceScheme('https');
    }

    private function bladeHelpers()
    {
        Blade::if('canOrSuper', function ($permission) {
            return auth()->user()->can($permission) || auth()->user()->hasRole('super_admin');
        });
    }
}
