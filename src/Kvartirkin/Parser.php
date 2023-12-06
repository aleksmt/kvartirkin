<?php

namespace Kvartirkin;

use Kvartirkin\Helpers\GeoInfo;
use Kvartirkin\Interfaces\EntryPointAbstract;
use Kvartirkin\Helpers\LoggingFactory;
use Kvartirkin\Model\Bot\Users\BotUsers;
use Kvartirkin\Model\Bot\Users\BotUsersQuery;
use Kvartirkin\Parsers\ParserAbstract;
use Monolog\Logger;
use Propel\Runtime\Exception\PropelException;
use Telegram\Bot\Actions;
use Kvartirkin\Reflections\ReflectionProvider;
use Telegram\Bot\Exceptions\TelegramOtherException;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Exceptions\TelegramResponseException;


class Parser extends EntryPointAbstract
{
    /**
     * @var Parser $INSTANCE
     */
    private static $INSTANCE = null;

    /**
     * @var Logger $log reference to logger
     */
    private $log;

    /**
     * @var ParserAbstract[] $parsers list of parsers to be called
     */
    private $parsers;

    /**
     * @var BotUsers[] $users
     */
    private $users;

    /**
     * @var Bot $bot
     */
    private $bot;


    /**
     * Actual singleton instance entry point to the api
     *
     * @return Parser
     * @throws Exceptions\ParserNotFoundException
     * @throws PropelException
     * @throws TelegramOtherException
     */
    public static function init() : Parser
    {
        return self::$INSTANCE ?: self::$INSTANCE = new Parser();
    }

    /**
     * Parser constructor. Initializes all the required tools: bot api, db, logger, etc.
     *
     * @throws Exceptions\ParserNotFoundException
     * @throws PropelException
     * @throws TelegramOtherException
     */
    private function __construct()
    {
        // Logging handler setup
        $this->log = LoggingFactory::getLogger(__CLASS__);

        // Find parsers available
        $this->parsers = ReflectionProvider::getParsers();

        // Users
        $this->users = BotUsersQuery::create()->findByTBotActive(true)->getIterator();

        // Bot reference
        $this->bot = Bot::init(true);
    }

    /**
     * @throws TelegramSDKException
     * @throws PropelException
     */
    public function start()
    {
        $geo = new GeoInfo(55.752121, 37.617664);

        $api = $this->bot->getApi();

        // For every parser - find all realty during the last run TODO: filters
        foreach ($this->parsers as $parser) {
            $ads = $parser->orderBy('date')->espionage();
        }

        // Exiting from the method if there is no ads
        if (empty($ads) || $ads == []) {
            $this->log->info('No new ads found during this run');
            return;
        } else {
            $this->log->info('New ads found: ' . count($ads));
        }

        // For every user :: send flats by filter TODO: filters
        foreach ($this->users as $user) {

            // Skipping user if not active
            if (!$user->getTBotActive())
                continue;

            $userId = $user->getTId();

            // Catch users who has blocked the bot, unsubscribe
            try {
                $api->sendChatAction([
                    'chat_id' => $userId,
                    'action' => Actions::TYPING
                ]);
            } catch (TelegramResponseException $e) {
                $user->setTBotActive(false)->save();
                $this->log->warn('User #' . $userId . ' has blocked the bot, unsubscribed', [$e]);
                continue;
            }

            $api->sendMessage([
                'chat_id' => $userId,
                'text' => 'Найдены новые квартиры'
            ]);

            foreach ($ads as $_ => $ad) {
                $distance = $geo->distanceTo($ad['lat'], $ad['lng']);
                $this->log->info('Distance', [
                    'Distance from Moscow Kremlin' => $distance,
                ]);
                $this->bot->sendFlat($userId, $ad['slug'], $ad['title'], (int)$ad['price'], $distance);
                usleep(500);
            }
        }
    }

}