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
        Schema::create('course_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');

            $table->index('course_id','course_user_course_idx');
            $table->index('user_id','course_user_user_idx');

            $table->foreign('course_id','course_user_course_fk')->on('courses')->references('id');
            $table->foreign('user_id','course_user_user_fk')->on('users')->references('id');;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_users');
    }
};
