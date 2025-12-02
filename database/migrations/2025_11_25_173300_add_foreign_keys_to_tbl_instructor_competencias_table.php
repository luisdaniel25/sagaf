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
        Schema::table('tbl_instructor_competencias', function (Blueprint $table) {
            $table->foreign(['Codigo_competencia'])->references(['comp_codigoCompetencia'])->on('tbl_competencias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_instructor'])->references(['Codigo'])->on('tbl_instructors')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_instructor_competencias', function (Blueprint $table) {
            $table->dropForeign('tbl_instructor_competencias_codigo_competencia_foreign');
            $table->dropForeign('tbl_instructor_competencias_codigo_instructor_foreign');
        });
    }
};
