<?php

namespace Blaspsoft\SocialitePlus\Console;

use Illuminate\Filesystem\Filesystem;

trait InstallReact
{
    public function installReact()
    {
        // Composer packages
        if (! $this->requireComposerPackages(['inertiajs/inertia-laravel:^2.0', 'laravel/socialite:^5.0'])) {
            return 1;
        }

        // Views
        (new Filesystem)->ensureDirectoryExists(resource_path('js/pages/auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/react/pages/auth', resource_path('js/pages/auth'));

        // Components
        (new Filesystem)->ensureDirectoryExists(resource_path('js/components'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/react/components', resource_path('js/components'));

        // Icons
        (new Filesystem)->ensureDirectoryExists(resource_path('js/components/icons'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/react/components/icons', resource_path('js/components/icons'));

        // Tests
       //(new Filesystem)->ensureDirectoryExists(base_path('tests/Feature/ApiToken'));
       // (new Filesystem)->copy(__DIR__.'/../../stubs/tests/Feature/ApiToken/PageTokenTest.php', base_path('tests/Feature/ApiToken/PageTokenTest.php'));
    }
}