<?php

namespace Kvartirkin\Exceptions;

use Exception;
use Throwable;

/**
 * Class ParserNotReadyException
 * Throws when parser is not ready (has no last working timestamp)
 *
 * @package Kvartirkin\Exceptions
 */
class ParserNotReadyException extends Exception
{
    public function __construct(string $parserName, int $code = 0, Throwable $previous = null)
    {
        parent::__construct("Parser: ${parserName} is not ready for work", $code, $previous);
    }
};

