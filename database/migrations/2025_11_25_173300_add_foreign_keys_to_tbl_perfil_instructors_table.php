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
        Schema::table('tbl_perfil_instructors', function (Blueprint $table) {
            $table->foreign(['Codigo_programa'])->references(['prog_codigoPrograma'])->on('tbl_programas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_perfil_instructors', function (Blueprint $table) {
            $table->dropForeign('tbl_perfil_instructors_codigo_programa_foreign');
        });
    }
};
