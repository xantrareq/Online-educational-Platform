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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('text');
            $table->string('image')->nullable();
            $table->text('homework_condition')->nullable();
            $table->string('answer')->nullable();
            $table->integer('points')->nullable();
            $table->string('youtube_link')->nullable();
            $table->unsignedBigInteger('trys')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
