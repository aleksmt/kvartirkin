<?php

namespace Kvartirkin\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
    /**
     * @var string Subscribe to the bot, register user ID in the database
     */
    protected $name = "help";

    /**
     * @var string Command Description
     */
    protected $description = "Вывести набор команд";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        // This will show that bot is typing...
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $this->replyWithMessage(['text' => 'Вот список доступных команд:']);

        $commands = $this->getTelegram()->getCommands();

        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }

        $this->replyWithMessage(['text' => $response != '' ? $response : 'Нет доступных команд']);
    }
}