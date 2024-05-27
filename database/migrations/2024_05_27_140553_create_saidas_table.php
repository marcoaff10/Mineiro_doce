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
            $table->id('id_saida');
            $table->unsignedBigInteger('id_cliente');
            $table->float('total');
            $table->float('frete');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
    
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
