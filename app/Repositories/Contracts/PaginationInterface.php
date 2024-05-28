<?php

namespace App\Repositories\Contracts;

interface PaginationInterface
{
    /** 
     * @return stdClass[]
     */
    public function items(): array;
    public function total(): int;
    public function firstPage(): bool;
    public function lastPage(): bool;
    public function currentPage(): int;
    public function getNumberNextPage(): int;
    public function getNumberPreviousPage(): int;
}
