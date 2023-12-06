<?php

namespace Kvartirkin\Parsers;

use DateTime;
use DateTimeZone;
use GuzzleHttp\Client;
use Kvartirkin\Exceptions\AbstractParentException;
use Kvartirkin\Exceptions\NotImplementedException;
use Kvartirkin\Exceptions\ParserHoursOffException;
use Kvartirkin\Exceptions\ParserNotFoundException;
use Kvartirkin\Exceptions\ParserNotReadyException;
use Kvartirkin\Exceptions\ParserTurnedOffException;
use Kvartirkin\Interfaces\IParser;
use Kvartirkin\Helpers\LoggingFactory;
use Kvartirkin\Model\Bot\ActiveParsers\BotActiveParsers;
use Kvartirkin\Model\Bot\ActiveParsers\BotActiveParsersQuery;
use Monolog\Logger;
use Propel\Runtime\Exception\PropelException;

/**
 * Abstract provider to implement ProviderInterface
 * Describes methods which should be created by derived class
 *
 * @package Kvartirkin\Parsers
 */
abstract class ParserAbstract implements IParser
{
    /**
     * @var BotActiveParsers $parserRecord data about the child
     */
    protected $parserRecord;

    /**
     * @var Logger $log reference to logger
     */
    protected $log;

    /**
     * @var string $userAgent should be used to hide activity as parser app
     */
    protected $userAgent;

    /**
     * @var Client $client object for requesting ads
     */
    protected $client;

    /**
     * @var array $ads of advertisements parsed from different sources non-normalized (as is)
     */
    protected $ads = [];

    /**
     * @var array $parameters that should be requested from the provider
     */
    protected $parameters = [];

    /**
     * ProviderAbstract constructor. Child constructor MUST call parent's with the link
     * to the child object passed. Allows to automatically create logger and find state of the
     * child in the database.
     *
     * @throws ParserTurnedOffException throws when parser is off (in the db)
     * @throws ParserNotFoundException
     * @throws ParserNotReadyException
     * @throws ParserHoursOffException
     * @throws PropelException
     */
    protected function __construct()
    {
        // Getting clazz from the child in the ancestor
        $parserName = get_called_class();

        // Setup logging
        $this->log = LoggingFactory::getLogger($parserName);

        // Check parser's settings
        if (!self::isParserExists())        throw new ParserNotFoundException($parserName);
        if (!self::isParserReady())         throw new ParserNotReadyException($parserName);
        if (!self::isParserActive())        throw new ParserTurnedOffException($parserName);
        if (!self::isParserWorkingHours())  throw new ParserHoursOffException($parserName);

        $this->parserRecord = $this->getParserInfo();
    }

    /**
     * @inheritDoc
     */
    public function espionage() : array
    {
        throw new NotImplementedException($this->parserRecord->getClass(), __FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public static function reincarnate() : void
    {
        $clazz = self::validateCaller();
        (new BotActiveParsers())
            ->setClass($clazz)
            ->save();
    }

    /**
     * @inheritDoc
     */
    public static function renew(): void
    {
        $clazz = self::validateCaller();
        BotActiveParsersQuery::create()
            ->findOneByClass($clazz)
            ->setlastRunTs(time())
            ->save();
    }

    /**
     * Set the time since last query to the parser performed.
     * This means setup unix time when parser worked.
     *
     * @return DateTime seconds of the last working time
     * @throws PropelException
     * @throws \Exception
     */
    protected function stamp(): DateTime
    {
        $recentOn = $this->getParserInfo()->getlastRunTs();
        BotActiveParsersQuery::create()
            ->findOneByClass($this->parserRecord->getClass())
            ->setlastRunTs(new DateTime())
            ->save();
        return $recentOn;
    }

    /**
     * Simply returns filters from parameters in the string representation
     * @return string
     */
    protected function showFilters() : string
    {
        $params = $this->parameters;
        $callback = function ($v, $k) {
            return sprintf("%s='%s'", $k, $v);
        };
        return implode(', ', array_map($callback, $params, array_keys($params)));
    }

    private function getParserInfo() : BotActiveParsers
    {
        $info = BotActiveParsersQuery::create()
            ->findOneByClass(get_called_class());
        return $info;
    }

    /**
     * Checks record about the parser (exists/not exists) in db
     *
     * @return bool
     */
    private static function isParserExists() : bool
    {
        $exists = BotActiveParsersQuery::create()
            ->findByClass(get_called_class())
            ->count();
        return $exists > 0;
    }

    /**
     * If time of the last parse is more than $h hours since now,
     * throw an exception
     * Checks in db
     *
     * @param int $h
     * @return bool
     * @throws PropelException
     */
    private static function isParserReady(int $h = 3) : bool
    {
        $previous = BotActiveParsersQuery::create()
            ->findOneByClass(get_called_class())
            ->getlastRunTs();

        try {
            $till = (clone $previous)->modify("+${h} hours");
            $current = new DateTime();
        } catch (\Exception $e) {
            $till = $previous->getTimestamp() + ($h * 60 * 60);
            $current = time();
        }

        return $till > $current;
    }

    /**
     * Getting state of the child parser (active/not active) in db
     *
     * @return bool
     */
    private static function isParserActive() : bool
    {
        // First, check activity of a parser
        $active = BotActiveParsersQuery::create()
            ->findOneByClass(get_called_class())
            ->isActive();

        // Then, check activity hours
        return $active;
    }

    /**
     * Getting working hours for the parser (active/not active) in db
     *
     * @return bool
     * @throws PropelException
     * @throws \Exception
     */
    private static function isParserWorkingHours() : bool
    {
        $parser = BotActiveParsersQuery::create()->findOneByClass(get_called_class());

        $time = [
            'to' => $parser->gettoTime(),
            'from' => $parser->getfromTime(),
            'current' => new DateTime()
        ];

        return $time['current'] > $time['from'] && $time['current'] < $time['to'];
    }

    /**
     * Performs check of the inheritance and throws an exception when caller is wrong
     *
     * @return string
     */
    private static function validateCaller() : string
    {
        $clazz = get_called_class();
        if ($clazz == self::class)
            throw new AbstractParentException(self::class);
        return $clazz;
    }

    /**
     * Creates ready-to-use REST/SOAP/etc. client to be able to work with remote source
     *
     * @param string $url
     * @param int $timeout
     * @param string $useragent
     * @return Client
     */
    protected function createClient(string $url, int $timeout, string $useragent) : Client
    {
        $client = new Client(
            [
                'allow_redirects' => true,
                'base_uri' => $url,
                'timeout'  => $timeout,
                'cookies'  => true,
                'headers'  =>
                    [
                        'Accept' => '*/*',
                        'User-Agent' => $useragent,
                        'Accept-Language' => 'lang',
                        'Accept-Encoding' => 'gzip;q=1.0, compress;q=0.5',
                        'Connection' => 'keep-alive'
                    ]
            ]);
        return $client;
    }
}