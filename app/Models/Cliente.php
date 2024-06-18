<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'clientes';

    protected $fillable = [
        'cliente',
        'email',
        'cnpj',
        'telefone',
        'cidade',
        'cep',
        'endereco',
        'uf',
        'bairro',
        'num',
        'ativa'
    ];
}
