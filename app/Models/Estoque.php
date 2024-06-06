<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'estoque';

    protected $fillable = [
        'produto_id',
        'qtde_entrada',
        'qtde_saida'
    ];
}
