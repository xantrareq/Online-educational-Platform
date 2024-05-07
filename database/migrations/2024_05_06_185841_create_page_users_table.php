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
        Schema::create('page_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('points')->nullable();
            $table->unsignedBigInteger('trys')->nullable();
            $table->text('answer')->nullable();


            $table->index('page_id','page_user_page_idx');
            $table->index('user_id','page_user_user_idx');

            $table->foreign('page_id','page_user_page_fk')->on('pages')->references('id');
            $table->foreign('user_id','page_user_user_fk')->on('users')->references('id');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_users');
    }
};
