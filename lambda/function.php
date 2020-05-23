<?php

declare(strict_types=1);

use LambdaPhpSkeleton\TronaldDump;

require_once __DIR__ . '/../config/bootstrap.php';

return static function ($data) {
    $client = new TronaldDump\Client(new \Bref\Logger\StderrLogger()); // @TODO use DI
    $quote = $client->getRandomQuote();

    return [
        'appeared_at' => $quote['appeared_at'],
        'quote'       => $quote['value'],
    ];
};
