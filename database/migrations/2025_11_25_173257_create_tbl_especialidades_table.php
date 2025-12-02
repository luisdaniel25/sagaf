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
        Schema::create('tbl_especialidades', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->string('esp_Denominacion');
            $table->unsignedBigInteger('Codigo_red')->index('tbl_especialidades_codigo_red_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_especialidades');
    }
};
