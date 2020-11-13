<?php

declare(strict_types=1);

namespace Src;

use Exception;

class Router
{
    private array $routesList = [];

    public function add(string $pattern, string $controllerName): void
    {
        $this->routesList[] = [
            'pattern' => $pattern,
            'controllerName' => $controllerName,
        ];
    }

    public function match(string $uri): array
    {
        foreach ($this->routesList as $route) {
            if (preg_match('~^' . $route['pattern'] . '$~', $uri, $matches)) {
                return [
                    'controllerName' => $route['controllerName'],
                    'params' => array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY),
                ];
            }
        }

        throw new Exception('Page not found.', 404);
    }
}