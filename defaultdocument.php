<?php

require ("./vendor/autoload.php");

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Read the log level from a configuration file
$logLevel = Level::Warning;


// create a log channel
$logger = new Logger('logger');
$logger->pushHandler(new StreamHandler('logs.log', $logLevel));

// add records to the log
$logger->info('This is an info message.');
$logger->warning('This is a warning message.');
$logger->error('This is an error message.');
$logger->alert('This is an error message.');

echo "This is default document";
echo "<br>";
echo "We logged some messages to the log file.";