<?php

namespace Kvartirkin\Exceptions;

use Exception;
use Throwable;

/**
 * Class ParserHoursOffException
 * Throws when parser is invoked during non-working hours
 *
 * @package Kvartirkin\Exceptions
 */
class ParserHoursOffException extends Exception
{
    public function __construct(string $parserName, int $code = 0, Throwable $previous = null)
    {
        parent::__construct("Parser ${parserName} non-working hours, so it's off", $code, $previous);
    }
};

