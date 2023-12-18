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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('caravan');
            $table->string('age');
            $table->float('weight');
            $table->string('sex');
            $table->string('destination');
            $table->integer('idBirth');
            $table->integer('idPurchase');
            $table->integer('idSale');
            $table->integer('idHealth');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
