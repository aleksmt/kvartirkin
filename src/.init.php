<?php

/**
 * Loading environment variable only if it's exists, ignoring otherwise
 */
Dotenv\Dotenv::create(__DIR__ . '/..')
    ->safeLoad();

/**
 * Setting default timezone globally
 */
date_default_timezone_set(getenv('TZ'));

/**
 * PSR-4 autoload shortcuts here
 * Define this directory as root to discover all other modules
 */
(require __DIR__ . '/../vendor/autoload.php')
    ->addPsr4('Kvartirkin\\', __DIR__ . '/Kvartirkin');

/**
 * Propel config setup
 */
require_once __DIR__ . '/config.php';
