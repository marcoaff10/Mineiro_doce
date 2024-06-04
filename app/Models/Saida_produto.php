<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saida_produto extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'saidas_produtos';

    protected $fillable = [
        'saida_id',
        'produto_id',
        'cliente_id',
        'quantidade',
        'valor_unidade',
        'frete',
        'valor_total'
    ];
}
