<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saida_produto extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'saida_produto';

    protected $fillable = [
        'motivo',
        'produto_id',
        'cliente_id',
        'quantidade',
    ];
}
