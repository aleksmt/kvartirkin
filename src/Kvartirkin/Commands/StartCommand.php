<?php

namespace Kvartirkin\Commands;

use Kvartirkin\Bot;
use Kvartirkin\Exceptions\ParserHoursOffException;
use Kvartirkin\Exceptions\ParserNotFoundException;
use Kvartirkin\Exceptions\ParserNotReadyException;
use Kvartirkin\Exceptions\ParserTurnedOffException;
use Kvartirkin\Model\Bot\Users\BotUsers;
use Kvartirkin\Model\Bot\Users\BotUsersQuery;
use Kvartirkin\Parser;
use Kvartirkin\Parsers\TheLocalsImpl;
use Propel\Runtime\Exception\PropelException;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Exceptions\TelegramOtherException;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\Update;

class StartCommand extends Command
{
    /**
     * @var string Start bot by sending it your id, name and etc.
     */
    protected $name = "start";

    /**
     * @var string Command Description
     */
    protected $description = "Начало работы с ботом";

    /**
     * @inheritdoc
     * @throws PropelException
     */
    public function handle($arguments)
    {
        // This will show that bot is typing...
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        // Here we getting basic info about the user...
        $message = $this->getUpdate()->getMessage();

        // Separating one from another
        $name = $message->getFrom()->getFirstName();
        $id = $message->getFrom()->getId();

        // Checking either user exists or not
        /** @var $data BotUsers[] */
        $data = BotUsersQuery::create()
            ->findByTId((int) $id)
            ->getData();

        if ($data == []) {
            // Setting credentials, if user is here for the first time
            (new BotUsers())
                ->setTName($name)
                ->setTId($id)
                ->setTLastMessage($message->getText())
                ->save();
            $reply = "Добро пожаловать на борт, ${name}! Теперь ты подписан(а) на обновления квартир.";
        } else {
            // Activate subscription
            BotUsersQuery::create()
                ->findOneByTId($id)
                ->setTBotActive(true)
                ->save();
            $reply = "Хорошо, теперь снова буду тебе спамить квартирами, ${name}.";
        }

        $reply_markup = $this->getTelegram()->replyKeyboardMarkup([
            'keyboard' => [["Случайная квартира", "Состояние"]],
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);

        // Say hello to the user...
        $this->replyWithMessage(['text' => $reply, 'reply_markup' => $reply_markup]);
    }

    /**
     * @param Update $update
     * @throws PropelException
     * @throws ParserNotFoundException
     * @throws ParserNotReadyException
     * @throws ParserTurnedOffException
     * @throws TelegramOtherException
     * @throws TelegramSDKException
     */
    public static function handleRandom(Update $update)
    {
        // Get telegram client & id of a sender
        $bot = Bot::init(true);
        $id = $update->getMessage()->getFrom()->getId();

        // This will show that bot is typing...
        $bot->getApi()->sendChatAction([
            'chat_id' => $id,
            'action' => Actions::TYPING
        ]);

        // Now getting flat and send if possible
        try {
            $ad = (new TheLocalsImpl())->getRandom();
            $bot->sendFlat($id, $ad['slug'], $ad['title'], $ad['price']);
        } catch (ParserHoursOffException $e) {
            $bot->getApi()->sendMessage([
                'chat_id' => $id,
                'text' => 'Извини, но я уже не работаю :('
            ]);
        }

    }
}