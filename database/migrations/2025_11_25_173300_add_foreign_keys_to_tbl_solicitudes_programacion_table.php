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
        Schema::table('tbl_solicitudes_programacion', function (Blueprint $table) {
            $table->foreign(['Codigo_competencia'], 'tbl_solicitudes_competencia_foreign')->references(['comp_codigoCompetencia'])->on('tbl_competencias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_ficha'], 'tbl_solicitudes_ficha_foreign')->references(['Codigo'])->on('tbl_ficha_caracterizacions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_instructor'], 'tbl_solicitudes_instructor_foreign')->references(['Codigo'])->on('tbl_instructors')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_solicitudes_programacion', function (Blueprint $table) {
            $table->dropForeign('tbl_solicitudes_competencia_foreign');
            $table->dropForeign('tbl_solicitudes_ficha_foreign');
            $table->dropForeign('tbl_solicitudes_instructor_foreign');
        });
    }
};
