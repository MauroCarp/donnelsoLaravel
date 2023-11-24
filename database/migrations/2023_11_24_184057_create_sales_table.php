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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->string('type');
            $table->integer('amountEntire');
            $table->float('kgEntire');
            $table->integer('amountHalf');
            $table->float('kgHalf');
            $table->integer('amountRibs');
            $table->float('kgRibs');
            $table->integer('amountShoulder');
            $table->float('kgShoulder');
            $table->integer('amountRearQuarter');
            $table->float('kgRearQuarter');
            $table->integer('amountHead');
            $table->float('kgHead');
            $table->datetime('deliveryDate');
            $table->boolean('preSale');
            $table->string('caravans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
