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
        Schema::table('tbl_eventos', function (Blueprint $table) {
            $table->foreign(['Codigo_ambiente'])->references(['Codigo'])->on('tbl_ambientes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_competencia'])->references(['comp_codigoCompetencia'])->on('tbl_competencias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_ficha'])->references(['Codigo'])->on('tbl_ficha_caracterizacions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_instructor'])->references(['Codigo'])->on('tbl_instructors')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_resultado_aprendizaje'])->references(['Codigo'])->on('tbl_resultado_aprendizajes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_eventos', function (Blueprint $table) {
            $table->dropForeign('tbl_eventos_codigo_ambiente_foreign');
            $table->dropForeign('tbl_eventos_codigo_competencia_foreign');
            $table->dropForeign('tbl_eventos_codigo_ficha_foreign');
            $table->dropForeign('tbl_eventos_codigo_instructor_foreign');
            $table->dropForeign('tbl_eventos_codigo_resultado_aprendizaje_foreign');
        });
    }
};
