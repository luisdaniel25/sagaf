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
        Schema::create('tbl_concepto_principios', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->text('con_Denominacion');
            $table->text('con_Observacion');
            $table->unsignedBigInteger('Codigo_resultado_aprendizaje')->index('tbl_concepto_principios_codigo_resultado_aprendizaje_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_concepto_principios');
    }
};
