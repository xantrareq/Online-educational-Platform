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
        Schema::create('course_tags', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('tag_id');

            $table->index('course_id','course_tag_course_idx');
            $table->index('tag_id','course_tag_tag_idx');

            $table->foreign('course_id','course_tag_course_fk')->on('courses')->references('id');
            $table->foreign('tag_id','course_tag_tag_fk')->on('tags')->references('id');;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_tags');
    }
};
