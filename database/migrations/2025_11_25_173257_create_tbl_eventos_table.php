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
        Schema::create('tbl_eventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('descripcion');
            $table->enum('color', ['red', 'blue', 'green'])->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('horaInicio');
            $table->string('horaFinal');
            $table->unsignedBigInteger('Codigo_resultado_aprendizaje')->nullable()->index('tbl_eventos_codigo_resultado_aprendizaje_foreign');
            $table->unsignedBigInteger('Codigo_instructor')->nullable()->index('tbl_eventos_codigo_instructor_foreign');
            $table->unsignedBigInteger('Codigo_ficha')->nullable()->index('tbl_eventos_codigo_ficha_foreign');
            $table->unsignedBigInteger('Codigo_ambiente')->nullable()->index('tbl_eventos_codigo_ambiente_foreign');
            $table->unsignedBigInteger('Codigo_competencia')->nullable()->index('tbl_eventos_codigo_competencia_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_eventos');
    }
};
