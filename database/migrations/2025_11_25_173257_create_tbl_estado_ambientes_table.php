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
        Schema::create('tbl_estado_ambientes', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->string('est_Denominacion');
            $table->string('est_FichaTecnica');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_estado_ambientes');
    }
};
