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
        Schema::create('blogs', function (Blueprint $table) 
        {
            $table->id();
            $table->string('title');
            $table->text('thumbnail_img');
            $table->text('main_img');
            $table->longText('desc');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_img')->nullable();
            
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            $table->timestamps();
            
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
