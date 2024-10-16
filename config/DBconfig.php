<?php

namespace config;

use Dotenv\Dotenv;

class DBConfig
{
    public static function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }

    public static function get(string $key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}
