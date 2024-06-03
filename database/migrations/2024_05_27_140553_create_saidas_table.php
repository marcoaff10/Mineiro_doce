<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saidas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('motivo');
            $table->uuid('cliente_id')->index()->nullable();
            $table->uuid('produto_id')->index();
            $table->float('quantidade');
            $table->float('valor_unidade');
            $table->float('frete');
            $table->float('valor_total');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
    
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saidas');
    }
};
