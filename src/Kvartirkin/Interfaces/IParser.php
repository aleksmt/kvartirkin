<?php

namespace Kvartirkin\Interfaces;

use Kvartirkin\Exceptions\AbstractParentException;
use Kvartirkin\Exceptions\ParserTurnedOffException;
use Propel\Runtime\Exception\PropelException;

interface IParser
{

    /**
     * General method to use, when client should request and parse advertisements from the source,
     * source is abstract web remote application contains info about flats.
     *
     * Returns all newly found advertisements with the flats since last parse date,
     * according to the website get query string parameters
     *
     * @throws ParserTurnedOffException throws when parser is off (due to db settings)
     * @throws PropelException throws when database request is incorrect or db is unavailable
     *
     * @return array
     */
    public function espionage() : array;

    /**
     * Recreates parser in the db with the default settings
     *
     * @throws PropelException
     * @throws AbstractParentException
     */
    public static function reincarnate() : void;

    /**
     * Refreshes parser time with current system time
     *
     * @throws PropelException
     * @throws AbstractParentException
     */
    public static function renew() : void;

}