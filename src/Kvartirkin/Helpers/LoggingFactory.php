<?php

namespace Kvartirkin\Helpers;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;

class LoggingFactory
{
    public static function getLogger($clazz) : Logger
    {
        $logger = new Logger($clazz);
        $handler = new ErrorLogHandler();
        $formatter = new LineFormatter("%channel%.%level_name%: %message% %context%", null, false, true);

        return $logger->pushHandler($handler->setFormatter($formatter));
    }
}