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
        Schema::table('tbl_aprendiz', function (Blueprint $table) {
            $table->foreign(['Codigo_centro'])->references(['Codigo'])->on('tbl_centro_formacions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_ficha'])->references(['Codigo'])->on('tbl_ficha_caracterizacions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_programa'])->references(['prog_codigoPrograma'])->on('tbl_programas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_regional'])->references(['Codigo'])->on('tbl_regionales')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_aprendiz', function (Blueprint $table) {
            $table->dropForeign('tbl_aprendiz_codigo_centro_foreign');
            $table->dropForeign('tbl_aprendiz_codigo_ficha_foreign');
            $table->dropForeign('tbl_aprendiz_codigo_programa_foreign');
            $table->dropForeign('tbl_aprendiz_codigo_regional_foreign');
        });
    }
};
