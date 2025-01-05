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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->string('type')->default('quiz')->comment('quiz,assignment');
            $table->string('title');
            $table->text('desc')->nullable();
            $table->integer('total_marks');

            $table->timestamp('start_time')->nullable(); // For quizzes
            $table->timestamp('end_time')->nullable(); // For quizzes
            $table->timestamp('due_date')->nullable(); // For assignments
            
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
