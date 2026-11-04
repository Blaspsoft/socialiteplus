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

            $this->copyDirectories();

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

    /**
     * Copy controller and middleware directories into app
     *
     * @return void
     */
    private function copyDirectories()
    {
        $fs = new Filesystem;
        
        $fs->ensureDirectoryExists(app_path('Http/Controllers/Auth'));
        $targetController = app_path('Http/Controllers/Auth/SocialitePlusController.php');
        if (! $fs->exists($targetController)) {
            $fs->copyDirectory(__DIR__.'/../stubs/app/Http/Controllers/Auth', app_path('Http/Controllers/Auth'));
        }
        
        $fs->ensureDirectoryExists(app_path('Http/Middleware'));
        $targetMiddleware = app_path('Http/Middleware/HandleSocialitePlusProviders.php');
        if (! $fs->exists($targetMiddleware)) {
            $fs->copyDirectory(__DIR__.'/../stubs/app/Http/Middleware', app_path('Http/Middleware'));
        }
    }
}
