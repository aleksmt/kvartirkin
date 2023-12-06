<?php

namespace Kvartirkin\Parsers;

use DateTime;
use Kvartirkin\Exceptions\ParserHoursOffException;
use Kvartirkin\Exceptions\ParserNotFoundException;
use Kvartirkin\Exceptions\ParserNotReadyException;
use Kvartirkin\Exceptions\ParserTurnedOffException;
use Kvartirkin\Parsers\Enums\RealtyKind;
use Propel\Runtime\Exception\PropelException;

final class TheLocalsImpl extends ParserAbstract
{
    /**
     * Unique name of the parser
     */
    const PARSER_NAME = 'TheLocals';

    /**
     * TheLocals url website
     */
    const BASE_URL = 'https://thelocals.ru';

    /**
     * TheLocals API entry point
     */
    const API_URL = '/api/mobile/ads';

    /**
     * TheLocalsProvider constructor.
     * @throws ParserTurnedOffException
     * @throws ParserNotFoundException
     * @throws ParserNotReadyException
     * @throws ParserHoursOffException
     * @throws PropelException
     */
    public function __construct()
    {
        // Check operational state && create log
        parent::__construct();

        // Define user-agent
        $this->userAgent = 'Locals/3.1 (com.Brandymint.TheLocals; build=>41; iOS 10.3.3) Alamofire/4.5.0';

        // Client setup
        $this->client = $this->createClient(self::BASE_URL, 15.0, $this->userAgent);

        // Setup some default values
        $this->page(1)
            ->perPage(25)
            ->withKind(RealtyKind::APARTMENT())
            ->orderBy('date')
            ->onlyVerified();
    }

    public function withKind(RealtyKind $type)
    {
        $this->parameters['filter[kind]'] = $type;
        return $this;
    }

    public function orderBy(string $value)
    {
        $this->parameters['filter[order]'] = $value;
        return $this;
    }

    public function withPrice(int $min = 0, int $max = 40000)
    {
        $this->parameters['filter[price_min]'] = $min;
        $this->parameters['filter[price_max]'] = $max;
        return $this;
    }

    public function withFloor(int $min = 0, int $max = 100)
    {
        $this->parameters['filter[floor_min]'] = $min;
        $this->parameters['filter[floor_max]'] = $max;
        return $this;
    }

    public function withSpace(int $min = 0 , int $max = 200)
    {
        $this->parameters['filter[space_min]'] = $min;
        $this->parameters['filter[space_max]'] = $max;
        return $this;
    }

    public function onlyVerified(bool $value = true)
    {
        $this->parameters['filter[only_verified]'] = $value;
        return $this;
    }

    private function perPage(int $number = 25)
    {
        $this->parameters['per'] = $number;
        return $this;
    }

    private function page(int $number = 1)
    {
        $this->parameters['page'] = $number;
        return $this;
    }

    private function request() : array
    {
        $response = $this->client
            ->get(self::API_URL, ['query' => $this->parameters]);
        return json_decode(
            $response->getBody()->getContents(), true
        );
    }

    public function getRandom() : array
    {
        $ads = $this->request()['ads'];
        $this->log->info('Requesting random ad from thelocals');
        return $ads[array_rand($ads)];
    }

    public function espionage() : array
    {
        // Getting last time bot worked
        $latestRunTime = $this->stamp();

        // Requesting the flats
        $json = $this->request();

        $this->ads = array_filter($json['ads'], function ($v) use ($latestRunTime) {
            $adTimePublished = DateTime::createFromFormat('Y-m-d\TH:i:s.uT', $v['published_at']);
            return $adTimePublished > $latestRunTime;
        });

        $this->log->info('Requesting ads from thelocals', [
            'Total flats count:' => $json['total_count'],
            'Filters:' => $this->showFilters(),
        ]);

        return $this->ads;
    }

}