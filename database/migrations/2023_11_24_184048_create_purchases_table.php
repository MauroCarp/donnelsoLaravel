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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->datetime('date');
            $table->integer('amount');
            $table->integer('males')->default(0);
            $table->integer('females')->default(0);
            $table->string('idProvider');
            $table->string('destination');
            $table->float('cost');
            $table->float('kg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
