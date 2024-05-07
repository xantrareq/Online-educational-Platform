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
        Schema::create('liked_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('visible')->default(1);

            $table->index('course_id','course_user_course_idx');
            $table->index('user_id','course_user_user_idx');

            $table->foreign('course_id','liked_courses_course_fk')->on('courses')->references('id');
            $table->foreign('user_id','liked_courses_user_fk')->on('users')->references('id');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liked_courses');
    }
};
