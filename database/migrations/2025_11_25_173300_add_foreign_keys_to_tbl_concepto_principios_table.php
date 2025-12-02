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
        Schema::table('tbl_concepto_principios', function (Blueprint $table) {
            $table->foreign(['Codigo_resultado_aprendizaje'])->references(['Codigo'])->on('tbl_resultado_aprendizajes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_concepto_principios', function (Blueprint $table) {
            $table->dropForeign('tbl_concepto_principios_codigo_resultado_aprendizaje_foreign');
        });
    }
};
