<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'compras';

    protected $fillable = [
        'compra',
        'fornecedor_id',
        'frete',
        'ativa',
        'entrada',
        'data'
    ];
}
