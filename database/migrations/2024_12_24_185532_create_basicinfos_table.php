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
        Schema::create('basicinfos', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->text('dark_logo')->nullable();
            $table->text('light_logo')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('mail')->nullable();
            $table->string('address')->nullable();
            $table->text('fb_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('vimeo_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('skype_link')->nullable();
            $table->text('about_text')->nullable();
            $table->text('opening_hours_text')->nullable();
            $table->text('copyright_text')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basicinfos');
    }
};
