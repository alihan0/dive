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
        Schema::create('verification_meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->string('username');
            $table->date('date1');
            $table->time('time1');
            $table->date('date2')->nullable();
            $table->time('time2')->nullable();
            $table->date('date3')->nullable();
            $table->time('time3')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_meetings');
    }
};
