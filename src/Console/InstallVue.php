<?php

namespace Blaspsoft\SocialitePlus\Console;

use Illuminate\Filesystem\Filesystem;

trait InstallVue
{
    public function installVue()
    {
        if (! $this->requireComposerPackages(['inertiajs/inertia-laravel:^2.0', 'laravel/socialite:^5.0'])) {
            return 1;
        }

        (new Filesystem)->ensureDirectoryExists(resource_path('js/pages/auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/vue/pages/auth', resource_path('js/pages/auth'));

        (new Filesystem)->ensureDirectoryExists(resource_path('js/components'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/vue/components', resource_path('js/components'));

        (new Filesystem)->ensureDirectoryExists(resource_path('js/components/icons'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/vue/components/icons', resource_path('js/components/icons'));
    }
}