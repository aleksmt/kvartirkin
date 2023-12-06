<?php

namespace Kvartirkin\Exceptions;

use Exception;
use Throwable;

/**
 * Class ParserTurnedOffException
 * Throws when parser doesn't exist in the database
 *
 * @package Kvartirkin\Exceptions
 */
class ParserNotFoundException extends Exception
{
    public function __construct(string $parserName, int $code = 0, Throwable $previous = null)
    {
        $msg = "Parser: ${parserName} not found in the database, considering reincarnate";
        parent::__construct($msg, $code, $previous);
    }
};

