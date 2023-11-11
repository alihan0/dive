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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('page')->nullable();
            $table->string('section')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('detail')->nullable();
            $table->string('cover')->nullable();
            $table->text('content')->nullable();
            $table->string('button1_text')->nullable();
            $table->string('button1_src')->nullable();
            $table->string('button2_text')->nullable();
            $table->string('button2_src')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
