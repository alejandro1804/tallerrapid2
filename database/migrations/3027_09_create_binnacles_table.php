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
    /*    Schema::create('binnacles', function (Blueprint $table) {
            $table->mediumInteger('id')->autoIncrement()->unsigned()->primary();

            $table->unsignedMediumInteger('ticket_id');   
            $table->foreign('ticket_id')->references('id')->on('tickets');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('note');
            $table->timestamps();
        });  */
        Schema::create('binnacles', function (Blueprint $table) {
            $table->bigIncrements('id'); // Reemplaza mediumInteger por bigIncrements

            // Compatible con tickets.id
            $table->foreignId('user_id')->constrained('users');     // Compatible con users.id

            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');

            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binnacles');
    }
};
