<?php

namespace Kvartirkin\Exceptions;

use Exception;
use Throwable;

/**
 * Class ParserTurnedOffException
 * Throws when parser turned off in the database
 *
 * @package Kvartirkin\Exceptions
 */
class ParserTurnedOffException extends Exception
{
    public function __construct(string $parserName, int $code = 0, Throwable $previous = null)
    {
        parent::__construct("Parser with the name: ${parserName} is currently off", $code, $previous);
    }
};

