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
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->uuid('id_fornecedor')->primary()->autoIncrement();
            $table->string('fornecedor');
            $table->string('email');
            $table->string('cnpj')->unique();
            $table->string('telefone');
            $table->string('cidade');
            $table->string('uf');
            $table->string('cep');
            $table->string('endereco');
            $table->string('bairro');
            $table->integer('num');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
