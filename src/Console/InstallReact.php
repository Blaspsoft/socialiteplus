<?php

namespace Blaspsoft\SocialitePlus\Console;

use Illuminate\Filesystem\Filesystem;

trait InstallReact
{
    public function installReact()
    {
        if (! $this->requireComposerPackages(['inertiajs/inertia-laravel:^2.0', 'laravel/socialite:^5.0'])) {
            return 1;
        }

        (new Filesystem)->ensureDirectoryExists(resource_path('js/pages/auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/react/pages/auth', resource_path('js/pages/auth'));

        (new Filesystem)->ensureDirectoryExists(resource_path('js/components'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/react/components', resource_path('js/components'));

        (new Filesystem)->ensureDirectoryExists(resource_path('js/components/icons'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/react/components/icons', resource_path('js/components/icons'));

        (new Filesystem)->ensureDirectoryExists(base_path('tests/Feature/SocialitePlus'));
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs/tests/Feature/SocialitePlus', base_path('tests/Feature/SocialitePlus'));
    }
}