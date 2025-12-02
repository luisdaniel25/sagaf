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
        Schema::create('tbl_centro_formacions', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->string('cent_Denominacion');
            $table->unsignedBigInteger('Codigo_regional')->index('tbl_centro_formacions_codigo_regional_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_centro_formacions');
    }
};
