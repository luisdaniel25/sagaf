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
        Schema::table('tbl_resultado_aprendizajes', function (Blueprint $table) {
            $table->foreign(['Codigo_competencias'])->references(['comp_codigoCompetencia'])->on('tbl_competencias')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_resultado_aprendizajes', function (Blueprint $table) {
            $table->dropForeign('tbl_resultado_aprendizajes_codigo_competencias_foreign');
        });
    }
};
