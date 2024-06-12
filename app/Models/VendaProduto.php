<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'venda_produto';

    protected $fillable = [
        'venda_id',
        'produto_id',
        'preco_venda',
        'quantidade'
    ];
}
