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
        Schema::create('tbl_perfil_instructors', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->string('per_RequisitosAcademicos', 45);
            $table->string('per_Experiencia', 45);
            $table->string('per_CompetenciasMinimas', 45);
            $table->unsignedBigInteger('Codigo_programa')->index('tbl_perfil_instructors_codigo_programa_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_perfil_instructors');
    }
};
