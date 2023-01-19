<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reddit_scrapers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('subreddit');
            $table->enum('filter_by', ['hot', 'new', 'random', 'top', 'controversial']);
            $table->enum('time_filter', ['hour', 'day', 'week', 'month', 'year', 'all']);
            $table->string('limit')->default(10);
            $table->timestamps();
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reddit_scrapers');
    }
};
