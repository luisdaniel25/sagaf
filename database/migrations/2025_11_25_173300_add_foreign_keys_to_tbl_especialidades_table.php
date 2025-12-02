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
        Schema::table('tbl_especialidades', function (Blueprint $table) {
            $table->foreign(['Codigo_red'])->references(['Codigo'])->on('tbl_redes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_especialidades', function (Blueprint $table) {
            $table->dropForeign('tbl_especialidades_codigo_red_foreign');
        });
    }
};
