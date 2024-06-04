<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_produto extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'entradas_produtos';

    protected $fillable = [
        'entrada_id',
        'produto_id',
        'fornecedor_id',
        'quantidade',
        'valor_unidade',
        'frete',
        'valor_total'
    ];
}
