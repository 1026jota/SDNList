<?php

namespace Jota\SdnList\Facades;

use Illuminate\Support\Facades\Facade;

class SdnListFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SdnList';
    }
}
