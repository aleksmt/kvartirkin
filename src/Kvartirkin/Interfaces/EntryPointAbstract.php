<?php

namespace Kvartirkin\Interfaces;

use Kvartirkin\Exceptions\NotImplementedException;

class EntryPointAbstract
{

    /**
     * Main static initializer to be called from outside
     * (by external request or by external scheduler)
     */
    public static function init()
    {
        throw new NotImplementedException(EntryPointAbstract::class, __FUNCTION__);
    }
}