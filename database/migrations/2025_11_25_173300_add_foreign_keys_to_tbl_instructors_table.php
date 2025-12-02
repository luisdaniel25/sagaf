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
        Schema::table('tbl_instructors', function (Blueprint $table) {
            $table->foreign(['Codigo_vigencia'], 'tbl_instructores_codigo_vigencia_foreign')->references(['Codigo'])->on('tbl_vigencias')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_instructors', function (Blueprint $table) {
            $table->dropForeign('tbl_instructores_codigo_vigencia_foreign');
        });
    }
};
