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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
           // $table->smallInteger('id')->autoIncrement()->unsigned()->primary();
            $table->string('name');

           // $table->unsignedSmallInteger('sector_id');
           //$table->foreign('sector_id')->references('id')->on('sectors');
            $table->foreignId('sector_id')->constrained('sectors');
            
            $table->string('characteristic');
            $table->string('note');
            $table->string('trademark',40);
            
            $table->foreignId('provider_id')->constrained('providers')->onDelete('cascade');
           
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
