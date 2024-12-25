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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_class_id')->constrained('course_classes')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_desc');
            $table->longText('long_desc')->nullable();
            $table->text('details_img')->nullable();
            $table->text('thumbnail_img');
            $table->string('instructor_name');
            $table->string('duration')->nullable();
            
            $table->integer('regular_price')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('discount')->nullable();
            
            $table->tinyInteger('is_featured')->default(0)->comment('1=active,0=inactive');

            $table->tinyInteger('is_exam')->default(1)->comment('1=active,0=inactive');
            $table->tinyInteger('is_certificate')->default(1)->comment('1=active,0=inactive');
            
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
