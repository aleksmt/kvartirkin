<?php

namespace Kvartirkin;

use Closure;
use Kvartirkin\Commands\StartCommand;
use Kvartirkin\Interfaces\EntryPointAbstract;
use Kvartirkin\Helpers\LoggingFactory;
use Kvartirkin\Parsers\TheLocalsImpl;
use Telegram\Bot\Api;
use Klein\Klein;
use Monolog\Logger;
use Telegram\Bot\Exceptions\TelegramOtherException;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Kvartirkin\Reflections\ReflectionProvider;

class Bot extends EntryPointAbstract
{
    /**
     * @var Bot $INSTANCE
     */
    private static $INSTANCE = null;

    /**
     * @var Logger $log reference to logger
     */
    private $log;

    /**
     * @var Api $api for the telegram
     */
    private $api;

    /**
     * @var string $token telegram api token from .env
     */
    private $token;

    /**
     * @var string $appName heroku's app name system variable
     */
    private $appName;

    /**
     * @var string $listenUrl full url for the telegram api
     */
    private $listenPath;

    /**
     * @var string $webHookUrl full path to the app's url
     */
    private $webHookUrl;

    /**
     * Actual singleton instance entry point to the api
     *
     * @param bool $clientMode
     * @return Bot
     * @throws TelegramOtherException
     */
    public static function init($clientMode = false): Bot
    {
        return self::$INSTANCE ?: self::$INSTANCE = new Bot($clientMode);
    }

    /**
     * Bot constructor. Initialize bot interface and listener.
     *
     * @param bool $clientMode
     * @throws TelegramOtherException
     */
    private function __construct($clientMode = false)
    {
        // Logging handler setup
        $this->log = LoggingFactory::getLogger(__CLASS__);

        // Set api token
        $this->token = getenv('TELEGRAM_API_TOKEN');

        // Set app name variable
        $this->appName = getenv('HEROKU_APP_NAME');

        // Partial url of the server's endpoint
        $this->listenPath = "$this->token/listen";

        // Global url which should be send to the telegram api server
        $this->webHookUrl = "https://$this->appName.herokuapp.com/$this->listenPath";

        // Telegram base client
        try {
            $this->api = new Api($this->token);
        } catch (TelegramSDKException $e) {
            $this->log->critical($e->getMessage());
            return null;
        }

        // Setting endpoints
        if (!$clientMode) {
            $this->api->addCommands(ReflectionProvider::getCommands());
            $this->routes();
        }
    }

    public function getApi(): Api
    {
        return $this->api;
    }

    public function sendFlat($chatId, string $path, string $title = 'Квартира', int $price = 0, int $distance = 0)
    {
        // Concatenate the path to the advertisement
        $url = TheLocalsImpl::BASE_URL . '/' . $path;

        // Price divided by group of three digits
        $thousands = $price / 1000;

        // Message itself
        $message = str_replace("'", '"', implode("\n", [
            "Ссылка: <a href='${url}'>${title}</a>",
            "Цена: <b>${thousands}</b> тыс. ₽/мес.",
            "Расстояние от центра Москвы (км.): <b>${distance}</b>",
            "Обработчик: " . TheLocalsImpl::PARSER_NAME,
        ]));

        // Now render final string
        $this->api->sendMessage([
            'chat_id' => (int) $chatId,
            'parse_mode' => 'html',
            'text' =>  $message,
        ]);
    }

    /**
     * Dispatch all the requests to the appropriate route(s)
     *
     * @return void
     */
    private function routes()
    {
        $router = new Klein();

        $router->post(
            "/$this->listenPath",
            $this->telegramEntryPoint()
        );

        $router->post(
            '/hook',
            $this->apiHook()
        );

        $router->get(
            '/',
            $this->mainPage()
        );

        $router->dispatch();
    }

    /**
     * Main page should be empty due to non-relevant requests (requests expected from the telegram)
     *
     * @return Closure
     */
    private function mainPage()
    {
        $obj = $this;
        return function () use ($obj) {
            $obj->log->info('Someone tried to access the main page, wtf?');
            return '<!DOCTYPE html><html lang="en"><head><title></title></head><body></body></html>';
        };
    }

    /**
     * Requested once application starts, notify telegram server where is telegram bot entry point actually listening
     * shouldn't be used anywhere else
     *
     * @return Closure
     */
    private function apiHook()
    {
        $obj = $this;
        return function () use ($obj) {
            // Setting hook
            $obj->log->info('Webhook url point were set', [
                'url:' => $this->webHookUrl,
                'response:' => json_decode($obj->api->setWebhook(['url' => $this->webHookUrl])->getBody(), true),
            ]);

            // Getting info about hook
            $obj->log->info('Requesting info about myself', [
                'response:' => json_decode($obj->api->getMe()->toJson(), true),
            ]);
        };
    }

    /**
     * Api hook endpoint, actual request handler for the telegram
     *
     * @return Closure
     */
    private function telegramEntryPoint()
    {
        $obj = $this;
        return function () use ($obj) {
            $update = $obj->api->commandsHandler(true);

            // TODO: refactor (keyboard abstraction should be implemented)
            if ($update->getMessage()->getText() == 'Случайная квартира') {
                $obj->log->info('Message from the keyboard', [
                    'text:' => $update->getMessage()->getText(),
                    'handled:' => 'Случайная квартира'
                ]);
                StartCommand::handleRandom($update);
            }

            $obj->log->info('Telegram incoming update', [json_decode($update->toJson())]);
        };
    }

}