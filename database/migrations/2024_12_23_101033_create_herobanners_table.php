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
        Schema::create('herobanners', function (Blueprint $table) {
            $table->id();
            $table->string('short_title')->nullable();
            $table->string('main_title');
            $table->string('sub_title')->nullable();
            
            $table->string('btn1_text')->nullable();
            $table->string('btn1_link')->nullable();

            $table->string('btn2_text')->nullable();
            $table->string('btn2_link')->nullable();
            
            $table->text('video_thumbnail_img')->nullable();
            $table->text('video_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herobanners');
    }
};
