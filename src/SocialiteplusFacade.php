<?php

namespace Blaspsoft\Socialiteplus;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Blaspsoft\Socialiteplus\Skeleton\SkeletonClass
 */
class SocialiteplusFacade extends Facade
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
