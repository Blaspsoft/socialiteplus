<?php

namespace Blaspsoft\Socialiteplus;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Blaspsoft\SocialitePlus\SocialitePlusFactory
 */
class SocialitePlusFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'socialiteplus';
    }
}
