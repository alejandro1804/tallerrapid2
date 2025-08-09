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
          
       Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Usa unsignedBigInteger por defecto
            $table->foreignId('state_id')->constrained('states'); // Clave foránea optimizada
            $table->timestamp('admission');
            $table->foreignId('item_id')->constrained('items'); // Clave foránea optimizada
            $table->string('flaw');
            $table->integer('priority');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
