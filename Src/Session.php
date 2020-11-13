<?php

declare(strict_types=1);

namespace Src;

class Session
{
    private static ?self $instance = null;

    public static function getInstance(): self
    {
        if (is_null(static::$instance)) {
            return static::$instance = new self;
        }

        return static::$instance;
    }

    public static function start(): void
    {
        session_start();
        static::getInstance();
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function unset(string $key): void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function setMessages(string $key, array $messages): void
    {
        $_SESSION[$key] = $messages;
    }

    public function getMessages(string $key): array
    {
        if (isset($_SESSION[$key])) {
            $messages = $_SESSION[$key];
            $this->unset($key);
        }

        return $messages ?? [];
    }
}