<?php

namespace TestPhp\Common;

use \PDO;
use Dotenv\Dotenv;

if (!($_ENV["DB_HOST"] ?? false)) {
    $dotenv = Dotenv::createImmutable('./');
    $dotenv->load();
}

class Connector extends PDO
{
    public function __construct($dsn = null, $username = NULL, $password = NULL, $options = [])
    {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        $options = array_replace($default_options, $options);

        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV["DB_NAME"]};charset=utf8";
        $username = $_ENV["DB_USER"];
        $password = $_ENV["DB_PASS"];

        parent::__construct($dsn, $username, $password, $options);
    }

    public function run($sql, $args = NULL)
    {
        if (!$args) {
            return $this->query($sql);
        }
        $stmt = $this->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
