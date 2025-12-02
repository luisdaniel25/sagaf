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
        Schema::create('tbl_material_requeridos', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->text('mat_Denominacion');
            $table->text('mat_Observacion');
            $table->unsignedBigInteger('Codigo_ra')->index('tbl_material_requeridos_codigo_ra_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_material_requeridos');
    }
};
