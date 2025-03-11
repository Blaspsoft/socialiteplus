<?php

namespace Blaspsoft\SocialitePlus;

use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GithubProvider;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\FacebookProvider;
use Laravel\Socialite\Two\LinkedInProvider;

class SocialitePlusFactory
{
    /**
     * Build the Socialite provider.
     *
     * @param string $provider
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    public function build(string $provider)
    {
        $providerClass = $this->getProviderClass(Str::lower($provider));

        if (!$providerClass) throw new \Exception('Invalid Socialite Plus Provider');

        $providerConfig = config('socialiteplus.providers.' . Str::lower($provider));

        return Socialite::buildProvider($providerClass, $providerConfig);
    }

    /**
     * Get the provider class.
     *
     * @param string $provider
     * @return string|null
     */
    private function getProviderClass(string $provider)
    {
        return match ($provider) {
            'google' => GoogleProvider::class,
            'facebook' => FacebookProvider::class,
            'github' => GithubProvider::class,
            'linkedin' => LinkedInProvider::class,
            default => null,
        };
    }
}
