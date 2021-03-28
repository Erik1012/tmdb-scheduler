<?php

/**
 * Local configuration.
 *
 * Copy this file to `local.php` and change its settings as required.
 * `local.php` is ignored by git and safe to use for local and sensitive data like usernames and passwords.
 */

declare(strict_types=1);

return [
    'TMDBApiKey' => '7601a613fec7b8634b91ac9d7f0d2733',
    'database' => [
        'driver' => 'Pdo',
        'user' => 'root',
        'dsn' => 'mysql:host=127.0.0.1;dbname=movie_database',
        'password' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ]
    ],
];
