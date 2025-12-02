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
        Schema::create('tbl_perfil_tecnico_del_instructors', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->string('per_RequisitosAcademicos');
            $table->string('per_Experiencia');
            $table->string('per_CompetenciasMinimas');
            $table->text('per_Observacion');
            $table->unsignedBigInteger('Codigo_ra')->index('tbl_perfil_tecnico_del_instructors_codigo_ra_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_perfil_tecnico_del_instructors');
    }
};
