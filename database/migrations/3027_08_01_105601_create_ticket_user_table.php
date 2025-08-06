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
    /*    Schema::create('ticket_user', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->unsignedMediumInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Rol específico dentro del ticket (opcional)
            $table->string('role_in_ticket')->nullable();

            // Fecha de asignación (útil para historial o auditoría)
            $table->timestamp('assigned_at')->useCurrent();

            $table->timestamps();

            // Índices para mejorar rendimiento en búsquedas
            $table->index(['ticket_id', 'user_id']);
        });
        */
        Schema::create('ticket_user', function (Blueprint $table) {
    $table->id();

    // Relaciones corregidas
    $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    // Rol específico dentro del ticket (opcional)
    $table->string('role_in_ticket')->nullable();

    // Fecha de asignación (útil para historial o auditoría)
    $table->timestamp('assigned_at')->useCurrent();

    $table->timestamps();

    // Índices para mejorar rendimiento en búsquedas
    $table->index(['ticket_id', 'user_id']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_user');
    }
};
