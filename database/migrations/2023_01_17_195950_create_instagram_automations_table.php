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
        Schema::create('instagram_automations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ig_account_id');
            $table->unsignedBigInteger('reddit_scraper_id');
            $table->boolean('active')->default(false);
            $table->timestamps();

            $table->index('user_id');
            $table->index('ig_account_id');
            $table->index('reddit_scraper_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram_automations');
    }
};
