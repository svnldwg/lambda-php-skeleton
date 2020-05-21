<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/bootstrap.php';

return static function ($data) {
    $logger = new \Bref\Logger\StderrLogger(\Psr\Log\LogLevel::DEBUG);
    $logger->error('Execution of function started');

    $logger->debug('Received input data: {data}', [
        'data' => $data
    ]);

    return 'hello!';
};
