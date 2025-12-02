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
        Schema::table('tbl_disponibilidad_instructores', function (Blueprint $table) {
            $table->foreign(['Codigo_instructor'], 'tbl_disponibilidad_instructores_ibfk_1')->references(['Codigo'])->on('tbl_instructors')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_disponibilidad_instructores', function (Blueprint $table) {
            $table->dropForeign('tbl_disponibilidad_instructores_ibfk_1');
        });
    }
};
