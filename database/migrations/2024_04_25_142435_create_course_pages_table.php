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
        Schema::create('course_pages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('page_id');

            $table->index('course_id','course_page_course_idx');
            $table->index('page_id','course_page_page_idx');

            $table->foreign('course_id','course_page_course_fk')->on('courses')->references('id');
            $table->foreign('page_id','course_page_page_fk')->on('pages')->references('id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_pages');
    }
};
