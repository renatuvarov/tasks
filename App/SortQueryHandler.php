<?php

declare(strict_types=1);

namespace App;

class SortQueryHandler
{
    private array $resultQueries = [];
    private array $sortVariants;
    private array $queryParams;

    public function __construct(array $sortVariants, array $queryParams)
    {
        $this->sortVariants = $sortVariants;
        $this->queryParams = $queryParams;
    }

    public function getQueryParams(): array
    {
        if (empty($this->resultQueries)) {
            $this->makeSortQuery();
        }

        return $this->resultQueries;
    }

    private function makeSortQuery(): void
    {
        foreach ($this->sortVariants as $sortVariant) {
            if (in_array($sortVariant, $this->queryParams, true)) {
                $queryArray = array_merge(
                    $this->queryParams,
                    [
                        'sort' => $this->queryParams['sort'] === 'asc' ? 'desc' : 'asc',
                    ]
                );
            } else {
                $queryArray = ['sort' => 'asc', 'order_by' => $sortVariant];
            }

            $this->resultQueries[$sortVariant] = http_build_query($queryArray);
        }
    }
}