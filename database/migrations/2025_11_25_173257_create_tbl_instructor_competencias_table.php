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
        Schema::create('tbl_instructor_competencias', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->unsignedBigInteger('Codigo_instructor');
            $table->unsignedBigInteger('Codigo_competencia')->index('tbl_instructor_competencias_codigo_competencia_foreign');
            $table->enum('hab_Estado', ['Habilitado', 'En Formación', 'No Habilitado'])->nullable()->default('Habilitado');
            $table->date('hab_FechaHabilitacion')->nullable();
            $table->timestamps();

            $table->unique(['Codigo_instructor', 'Codigo_competencia'], 'instructor_competencia_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_instructor_competencias');
    }
};
