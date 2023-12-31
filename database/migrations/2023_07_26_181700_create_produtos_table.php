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
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('categoria_id');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2);
            $table->integer('Qtd_Produtos');
            $table->string('foto')->nullable();
            $table->date('data_vencimento')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('categoria_id')
                  ->references('id')->on('categorias')
                  ->onDelete('cascade');
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
