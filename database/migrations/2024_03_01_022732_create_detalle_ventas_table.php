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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ventas_id');
            $table->unsignedBigInteger('detalle_ingresos_id');
            $table->string('cantidad');
            $table->string('descuento', 10, 2);
            $table->timestamps();

            $table->foreign('ventas_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('detalle_ingresos_id')->references('id')->on('detalle_ingresos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
