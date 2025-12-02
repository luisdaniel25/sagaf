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
        Schema::create('tbl_ambientes', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->string('amb_Denominacion', 45);
            $table->integer('amb_Cupo');
            $table->unsignedBigInteger('Codigo_tipo')->index('tbl_ambientes_codigo_tipo_foreign');
            $table->unsignedBigInteger('Codigo_estado')->index('tbl_ambientes_codigo_estado_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ambientes');
    }
};
