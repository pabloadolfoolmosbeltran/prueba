<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->decimal('temperatura', 5, 2);               // Temperatura en °C
            $table->boolean('estado_ventilador')->default(false); // Encendido/Apagado
            $table->boolean('estado_agitador')->default(false);  // Encendido/Apagado
            $table->integer('tiempo_operacion')->comment('segundos'); // Duración del ciclo
            $table->enum('fase', ['enfriamiento', 'fermentacion', 'reposo'])->default('enfriamiento');
            $table->timestamp('fecha_hora')->useCurrent();       // Momento del registro
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};