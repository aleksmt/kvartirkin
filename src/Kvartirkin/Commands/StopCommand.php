<?php

namespace Kvartirkin\Commands;

use Kvartirkin\Model\Bot\Users\BotUsersQuery;
use Propel\Runtime\Exception\PropelException;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StopCommand extends Command
{
    /**
     * @var string Stops bot and prevents to sending new messages and updates
     */
    protected $name = "stop";

    /**
     * @var string Command Description
     */
    protected $description = "Остановить рассылку сообщений";

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

        // Stop subscription
        BotUsersQuery::create()
            ->findOneByTId($id)
            ->setTBotActive(false)
            ->save();

        // Say hello to the user...
        $this->replyWithMessage(['text' => "${name}, я тебя понял. Я больше не буду отправлять тебе новое квартиры"]);
    }
}