<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('teacher_id')->nullable();
            $table->string('preview') -> nullable();
            $table->integer('min_points') ->nullable();
            $table->integer('points_four') ->nullable();
            $table->integer('points_five') ->nullable();
            $table->unsignedBigInteger('likes') -> nullable();


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
