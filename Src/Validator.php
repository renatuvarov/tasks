<?php

declare(strict_types=1);

namespace Src;

class Validator
{
    private array $data;
    private array $rules;
    private array $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate(): void
    {
        foreach ($this->data as $key => $value) {
            foreach ($this->rules[$key] as $rule) {
                $this->$rule($key, $value);
            }
        }
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function required(string $key, $value): void
    {
        if (empty(trim($value))) {
            $this->errors[$key][] = 'обязательный параметр.';
        }
    }

    private function email(string $key, $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$key][] = 'некорректный e-mail.';
        }
    }

    private function login(string $key, $value): void
    {
        if ($value !== 'admin') {
            $this->errors[$key][] = 'неверный логин или пароль.';
        }
    }

    private function password(string $key, $value): void
    {
        if ($value !== '123') {
            $this->errors[$key][] = 'неверный логин или пароль.';
        }
    }
}