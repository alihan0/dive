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
        Schema::create("system", function (Blueprint $table) {
            $table->id();
            $table->string("site_name")->nullable();
            $table->string("site_lang")->nullable();
            $table->string("site_url")->nullable();
            $table->string("site_key")->nullable();
            $table->string("site_description")->nullable();
            $table->string("site_keywords")->nullable();
            $table->string("about")->nullable();
            $table->string("logo_primary")->nullable();
            $table->string("logo_secondary")->nullable();
            $table->string("logo_primary_alt")->nullable();
            $table->string("logo_secondary_alt")->nullable();
            $table->string("favicon")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("address")->nullable();
            $table->string("facebook")->nullable();
            $table->string("twitter")->nullable();
            $table->string("instagram")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("discord")->nullable();
            $table->string("twicth")->nullable();
            $table->string("youtube")->nullable();
            $table->string("skype")->nullable();
            $table->integer("site_status");
            $table->integer("userpanel_status");
            $table->integer("adminpanel_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
