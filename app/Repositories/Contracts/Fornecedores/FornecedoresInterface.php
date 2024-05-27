<?php

namespace App\Repositories\Contracts\Fornecedores;

use App\DTO\Fornecedores\CreateFornecedores;
use App\DTO\Fornecedores\UpdateFornecedores;
use stdClass;

interface FornecedoresInterface
{
    public function getAll(): array;
    public function findOne(string $id): stdClass|null;
    public function store(CreateFornecedores $dto): void;
    public function update(UpdateFornecedores $dto): stdClass|null;
    public function delete(string $id): void;
}