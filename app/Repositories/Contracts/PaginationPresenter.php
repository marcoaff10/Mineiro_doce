<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class PaginationPresenter implements PaginationInterface

{
    /** 
     * @var stdClass[]
     */
    private $items;

    public function __construct(protected LengthAwarePaginator $paginator)
    {
        $this->items = $this->resolveItems($this->paginator->items());
    }
    //=====================================================================

    /** 
     * @return stdClass[]
     */
    public function items(): array
    {
        return $this->items;
    }

    //=====================================================================
    public function total(): int
    {
        return $this->paginator->total() ?? 0;
    }

    //=====================================================================
    public function firstPage(): bool
    {
        return $this->paginator->onFirstPage();
    }

    //=====================================================================
    public function lastPage(): bool
    {
        return $this->paginator->currentPage() === $this->paginator->lastPage();
    }

    //=====================================================================
    public function currentPage(): int
    {
        return $this->paginator->currentPage() ?? 1;
    }

    //=====================================================================
    public function perPage(): int
    {
        return $this->paginator->perPage();
    }

    //=====================================================================
    public function getNumberNextPage(): int
    {
        return $this->paginator->currentPage() + 1;
    }

    //=====================================================================
    public function getNumberPreviousPage(): int
    {
        return $this->paginator->currentPage() - 1;
    }

    //=====================================================================
    private function resolveItems(array $items): array
    {
        $response = [];
        foreach ($items as $item) {
            $std = new stdClass;
            foreach ($item->toArray() as $key => $value) {
                $std->{$key} = $value;
            }

            array_push($response, $std);
        }

        return $response;
    }
}
