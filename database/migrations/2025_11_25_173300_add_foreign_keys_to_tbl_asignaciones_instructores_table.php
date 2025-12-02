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
        Schema::table('tbl_asignaciones_instructores', function (Blueprint $table) {
            $table->foreign(['Codigo_instructor'], 'tbl_asignaciones_instructores_ibfk_1')->references(['Codigo'])->on('tbl_instructors')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_ficha'], 'tbl_asignaciones_instructores_ibfk_2')->references(['Codigo'])->on('tbl_ficha_caracterizacions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_competencia'], 'tbl_asignaciones_instructores_ibfk_3')->references(['comp_codigoCompetencia'])->on('tbl_competencias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_ambiente'], 'tbl_asignaciones_instructores_ibfk_4')->references(['Codigo'])->on('tbl_ambientes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_asignaciones_instructores', function (Blueprint $table) {
            $table->dropForeign('tbl_asignaciones_instructores_ibfk_1');
            $table->dropForeign('tbl_asignaciones_instructores_ibfk_2');
            $table->dropForeign('tbl_asignaciones_instructores_ibfk_3');
            $table->dropForeign('tbl_asignaciones_instructores_ibfk_4');
        });
    }
};
