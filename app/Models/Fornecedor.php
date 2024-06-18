<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'fornecedores';
    protected $fillable = [
        'fornecedor',
        'email',
        'cnpj',
        'telefone',
        'cidade',
        'uf',
        'cep',
        'endereco',
        'bairro',
        'num',
        'ativa'
    ];
}
