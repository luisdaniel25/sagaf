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
        Schema::table('tbl_perfil_tecnico_del_instructors', function (Blueprint $table) {
            $table->foreign(['Codigo_ra'])->references(['Codigo'])->on('tbl_resultado_aprendizajes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_perfil_tecnico_del_instructors', function (Blueprint $table) {
            $table->dropForeign('tbl_perfil_tecnico_del_instructors_codigo_ra_foreign');
        });
    }
};
