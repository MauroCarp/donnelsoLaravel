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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('dni');
            $table->string('adress');
            $table->string('phone');
            $table->string('fatherPhone');
            $table->string('motherPhone');
            $table->string('guardianPhone');
            $table->string('email');
            $table->string('fatherEmail');
            $table->string('motherEmail');
            $table->string('guardianEmail');
            $table->string('course');
            $table->integer('idGroup');
            $table->boolean('special');
            $table->integer('discount');
            $table->date('subscriptionDate');
            $table->date('unsubscriptionDate');
            $table->boolean('active');
            $table->string('schoolSchedules');
            $table->string('modality');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
