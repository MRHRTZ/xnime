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
        Schema::create('comment_like', function (Blueprint $table) {
            $table->integerIncrements('like_id')->unsigned();
            $table->bigInteger('comment_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('is_like');
            $table->timestamps();
            $table->foreign('comment_id')->references('comment_id')->on('comment')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_like');
    }
};
