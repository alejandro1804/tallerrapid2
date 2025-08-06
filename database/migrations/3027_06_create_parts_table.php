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
        Schema::create('parts', function (Blueprint $table) {
                $table->id(); // Esto crea unsignedBigInteger auto-incremental

                $table->foreignId('item_id')->constrained('items')->onDelete('cascade');

                $table->string('name', 150);
                $table->string('note');

                $table->foreignId('provider_id')->constrained('providers')->onDelete('cascade');

                $table->timestamps();
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
