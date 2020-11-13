<?php

declare(strict_types=1);

namespace Src;

class Paginator
{
    private int $itemCount;
    private array $queryParams;
    private int $perPage;
    private string $uri;

    public function __construct(int $itemCount, int $perPage, string $uri, array $queryParams)
    {
        $this->itemCount = $itemCount;
        $this->queryParams = $queryParams;
        $this->perPage = $perPage;
        $this->uri = $uri;
    }

    public function links(): array
    {
        $links = [];

        $pageCount = ceil($this->itemCount / $this->perPage);

        foreach (range(1, $pageCount) as $pageNumber) {
            $links[] = $this->uri . '?' . http_build_query(array_merge($this->queryParams, ['page' => $pageNumber]));
        }

        return $links;
    }
}