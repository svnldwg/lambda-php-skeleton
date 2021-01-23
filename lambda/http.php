<?php

declare(strict_types=1);

use LambdaPhpSkeleton\TronaldDump;

require_once __DIR__ . '/../config/bootstrap.php';

echo '<h1>Hello world! Here is your Tronald Dump quote:</h1>';

$client = new TronaldDump\Client(new \Bref\Logger\StderrLogger()); // @TODO use DI
$quote = $client->getRandomQuote();

echo '<cite>' . $quote['value'] . '</cite>';
