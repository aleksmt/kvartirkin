<?php

namespace Kvartirkin\Reflections;

use Kvartirkin\Exceptions\ParserHoursOffException;
use Kvartirkin\Exceptions\ParserNotFoundException;
use Kvartirkin\Exceptions\ParserNotReadyException;
use Kvartirkin\Exceptions\ParserTurnedOffException;
use Kvartirkin\Parsers\ParserAbstract;
use Propel\Runtime\Exception\PropelException;
use ReflectionClass;
use hanneskod\classtools\Iterator\ClassIterator;
use Symfony\Component\Finder\Finder;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Exceptions\TelegramOtherException;


class ReflectionProvider
{

    /**
     * Returns parser class instances (initiated already), that is ready for a work,
     * thus, external caller would't receive any non-ready or non-working parsers
     *
     * @param string $folder
     * @return ParserAbstract[]
     * @throws PropelException
     * @throws ParserNotFoundException
     */
    public static function getParsers($folder = 'Parsers') : array
    {
        /**
         * @var ReflectionClass $parser
         * @var ParserAbstract[] $instances
         * @var ParserAbstract $instance
         */
        $reflectionParsers = self::find($folder, ParserAbstract::class);

        foreach ($reflectionParsers as $parser) {
            $instance = $parser->newInstanceWithoutConstructor();
            try {
                $instances[] = $parser->newInstance();
            } catch (ParserNotFoundException $e) {
                $instance::reincarnate();
            } catch (ParserNotReadyException $e) {
                $instance::renew();
            } catch (ParserTurnedOffException | ParserHoursOffException $e) {
                // Do nothing
            }
        }

        if (empty($reflectionParsers)) {
            throw new ParserNotFoundException("No parsers found for the bot");
        }

        return !empty($instances) ? $instances : [];
    }

    /**
     * Returns commands references for the command bus
     *
     * @param string $folder
     * @return string[]
     * @throws TelegramOtherException
     */
    public static function getCommands($folder = 'Commands') : array
    {
        /**
         * @var ReflectionClass $command
         */
        $reflectionCommands = self::find($folder, Command::class);

        foreach ($reflectionCommands as $command) {
            $references[] = $command->getName();
        }

        if (empty($references)) {
            throw new TelegramOtherException("No commands found for the bot");
        }

        return $references;
    }

    /**
     * Finds and return array of a classes derived from the subclass
     *
     * @param string $in folder where to search e.g. 'Commands'
     * @param string $subclass parent class to search e.g. Command::class
     * @return array[ReflectionClass]|null
     */
    private static function find($in, $subclass) : array
    {
        // Where we should search for a classes
        $dir = __DIR__ . '/../' . $in;
        $finder = Finder::create()->in($dir);

        // Now using class iterator in some particular folder
        foreach (new ClassIterator($finder) as $class) {
            /** @var ReflectionClass $class subclassing command */
            if ($class->isSubclassOf($subclass)) {
                $reflections[] = $class;
            }
        }
        return isset($reflections) ? $reflections : [];
    }

}