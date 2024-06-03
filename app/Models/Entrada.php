<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entrada extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'entradas';

    protected $fillable = [
        'motivo',
        'fornecedor_id',
        'produto_id',
        'quantidade',
        'valor_unidade',
        'frete',
        'valor_total'
    ];

    public function fornecedor():BelongsTo
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
