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
        Schema::create('tbl_nivel_formacions', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->enum('niv_Denominacion', ['Tecnico', 'Tecnologo'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_nivel_formacions');
    }
};
