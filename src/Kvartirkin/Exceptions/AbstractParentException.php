<?php

namespace Kvartirkin\Exceptions;

use BadMethodCallException;
use Throwable;

/**
 * Class AbstractParentException
 * Appears when someone's trying to call parent reincarnation instead of child
 *
 * @package Kvartirkin\Exceptions
 */
class AbstractParentException extends BadMethodCallException
{
    public function __construct($parent, int $code = 0, Throwable $previous = null)
    {
        parent::__construct("Abstract parent: ${parent} call detected", $code, $previous);
    }
}