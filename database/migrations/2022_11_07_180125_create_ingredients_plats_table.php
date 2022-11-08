<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients_plats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredients_id')->constrained()->onDelete('cascade');
            $table->foreignId('plats_id')->constrained()->onDelete('cascade');
            // Quantitat??
            $table->unique(['ingredients_id','plats_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients_plats');
    }
};
