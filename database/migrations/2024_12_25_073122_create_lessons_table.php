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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->onDelete('cascade');
            
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('slug')->unique();
            $table->text('desc')->nullable();
            $table->integer('position')->default(1);
            $table->string('lesson_type')->nullable();
            $table->string('Content_url')->nullable();
            $table->string('duration')->nullable();
            $table->string('video_url')->nullable();
            
            
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
