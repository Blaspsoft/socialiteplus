<?php

namespace Blaspsoft\SocialitePlus;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SocialitePlusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Route::middleware(['web'])  
                ->group(function () {
                    require __DIR__.'/../routes/web.php';
                });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('socialiteplus.php'),
            ], 'socialiteplus-config');

            (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Auth'));
            (new Filesystem)->copyDirectory(__DIR__.'/../stubs/app/Http/Controllers/Auth', app_path('Http/Controllers/Auth'));

            (new Filesystem)->ensureDirectoryExists(app_path('Http/Middleware'));
            (new Filesystem)->copyDirectory(__DIR__.'/../stubs/app/Http/Middleware', app_path('Http/Middleware'));

            $this->commands([
                Console\InstallCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'socialiteplus');

        $this->app->singleton('socialiteplus', function () {
            return new SocialitePlusFactory;
        });
    }
}
