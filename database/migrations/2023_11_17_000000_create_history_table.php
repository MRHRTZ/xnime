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
        Schema::create('history', function (Blueprint $table) {
            $table->integerIncrements('history_id')->unsigned();
            $table->integer("user_id")->unsigned();
            $table->integer("anime_id")->unsigned();
            $table->integer("episode_id");
            $table->integer("server_id");
            $table->float("play_time", 10, 6);
            $table->float("max_time", 10, 6);
            $table->string("episode", 6);
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('anime_id')->references('anime_id')->on('anime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
