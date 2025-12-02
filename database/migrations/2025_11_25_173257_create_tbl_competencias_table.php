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
        Schema::create('tbl_competencias', function (Blueprint $table) {
            $table->bigIncrements('comp_codigoCompetencia');
            $table->text('comp_Denominacion')->nullable();
            $table->string('comp_VersionNCl');
            $table->string('comp_DuracionEstimada');
            $table->integer('comp_Creditos');
            $table->integer('comp_Horas_FI');
            $table->enum('comp_Tipo', ['Transversal', 'Especifica'])->default('Especifica');
            $table->unsignedBigInteger('Codigo_programa')->nullable()->index('tbl_competencias_codigo_programa_foreign');
            $table->timestamps();
            $table->unsignedBigInteger('Codigo_tipo')->nullable()->index('codigo_tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_competencias');
    }
};
