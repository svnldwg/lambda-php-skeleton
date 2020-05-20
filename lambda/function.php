<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/bootstrap.php';

return static function ($data) {
    var_dump($data);

    return 'hello!';
};
