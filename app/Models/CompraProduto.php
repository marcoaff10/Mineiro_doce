<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraProduto extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'compra_produto';

    protected $fillable = [
        'compra_id',
        'produto_id',
        'preco_compra',
        'quantidade'
    ];
}
