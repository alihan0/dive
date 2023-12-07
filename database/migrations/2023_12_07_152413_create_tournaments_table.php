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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->integer('type'); // 1 - single elemination | 2 - Double elemination | 3 - League
            $table->string('title');
            $table->text('description');
            $table->integer('max_participants');
            $table->integer('min_participants');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->integer('status');
            $table->integer('created_by');
            $table->integer('supervisor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
