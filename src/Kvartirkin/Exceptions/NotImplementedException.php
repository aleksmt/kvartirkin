<?php

namespace Kvartirkin\Exceptions;

use BadMethodCallException;
use Throwable;

/**
 * Class NotImplementedException
 * Should be called when no method implementation exists
 *
 * @package Kvartirkin\Exceptions
 */
class NotImplementedException extends BadMethodCallException
{
    public function __construct(string $parserName, string $method, int $code = 0, Throwable $previous = null)
    {
        parent::__construct("Method: ${method} is not implemented in class: ${parserName}", $code, $previous);
    }
}