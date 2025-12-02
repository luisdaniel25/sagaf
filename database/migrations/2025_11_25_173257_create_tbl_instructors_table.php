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
        Schema::create('tbl_instructors', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->integer('inst_Identificacion')->nullable()->unique('tbl_instructores_inst_identificacion_unique');
            $table->string('inst_TipoID', 40);
            $table->string('inst_Nombres', 45);
            $table->string('inst_Apellido', 45);
            $table->string('inst_Direccion');
            $table->string('inst_Correo', 45)->unique('tbl_instructores_inst_correo_unique');
            $table->string('inst_Telefono', 45);
            $table->unsignedBigInteger('Codigo_vigencia')->index('tbl_instructores_codigo_vigencia_foreign');
            $table->unsignedBigInteger('Codigo_usuario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_instructors');
    }
};
