<?php

declare(strict_types=1);

namespace Src;

use PDO;

class Db
{
    private static ?self $instance = null;

    private PDO $pdo;

    private function __construct()
    {
        $config = require_once __DIR__ . '/../config/db.php';

        $this->pdo = new PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
            $config['user'],
            $config['password'],
        );

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public static function getInstance(): self
    {
        if (is_null(static::$instance)) {
            return static::$instance = new self;
        }

        return static::$instance;
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }
}