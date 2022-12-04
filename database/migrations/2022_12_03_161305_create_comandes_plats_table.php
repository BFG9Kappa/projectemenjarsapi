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
        Schema::create('comandes_plats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comanda_id')->on('comandes')->onDelete('cascade');
            $table->foreignId('plat_id')->constrained()->onDelete('cascade');
            //$table->double('preu_total');
            $table->unique(['comanda_id','plat_id']);
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
        Schema::dropIfExists('comandes_plats');
    }
};
