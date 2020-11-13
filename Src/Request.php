<?php

declare(strict_types=1);

namespace Src;

class Request
{
    private static ?self $instance = null;

    private string $uri;

    private array $get;

    private array $body;

    private string $method;

    private Session $session;

    private function __construct(
        array $get,
        array $body,
        string $uri,
        string $method
    )
    {
        $this->get = $get;
        $this->body = $body;
        $this->uri = $uri;
        $this->method = $method;
        $this->session = Session::getInstance();
    }

    public static function getInstance(): ?self
    {
        if (is_null(static::$instance)) {
            return static::$instance = new self(
                self::trimValues($_GET),
                self::trimValues($_POST),
                strtok($_SERVER['REQUEST_URI'], '?'),
                $_SERVER['REQUEST_METHOD'],
            );
        }

        return static::$instance;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function query(): array
    {
        return $this->get;
    }

    public function addQueryParams(array $params): void
    {
        $this->get = array_merge_recursive($this->get, $params);
    }

    public function body(): array
    {
        return $this->body;
    }

    public function isPost(): bool
    {
        return $this->method === 'POST';
    }

    public function session(): Session
    {
        return $this->session;
    }

    private static function trimValues(array $values): array
    {
        $trimmed = [];

        foreach ($values as $key => $value) {
            $trimmed[$key] = trim($value);
        }

        return $trimmed;
    }
}