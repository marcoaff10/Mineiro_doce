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
        Schema::create('clientes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('cliente');
            $table->string('email')->nullable();
            $table->string('cnpj');
            $table->string('telefone')->nullable();
            $table->string('cidade');
            $table->string('cep');
            $table->string('uf');
            $table->string('endereco');
            $table->string('bairro')->nullable();
            $table->integer('num')->nullable();
            $table->integer('ativa')->unsigned()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
