<?php

namespace App\Providers;

use App\Jobs\VacancyNotify;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->bindMethod([VacancyNotification::class, 'handle'], function ($job, $app) {
        //     return $job->handle($app->make(VacancyNotification::class));
        // });
    }
}
