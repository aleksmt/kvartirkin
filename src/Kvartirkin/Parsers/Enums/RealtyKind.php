<?php

namespace Kvartirkin\Parsers\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static RealtyKind APARTMENT
 * @method static RealtyKind ROOM
 */
class RealtyKind extends Enum
{
    private const APARTMENT = 'apartment';
    private const ROOM = 'room';
}