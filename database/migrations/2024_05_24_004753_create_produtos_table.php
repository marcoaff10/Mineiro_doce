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
        Schema::create('produtos', function (Blueprint $table) {
            $table->uuid('id_produto')->primary();
            $table->uuid('id_categoria');
            $table->uuid('id_fornecedor');
            $table->string('produto');
            $table->float('peso');
            $table->boolean('controlado');
            $table->integer('minimo');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_fornecedor')->references('id_fornecedor')->on('fornecedores')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
