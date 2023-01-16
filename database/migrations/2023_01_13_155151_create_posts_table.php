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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ig_account_id');
            $table->unsignedBigInteger('reddit_scraper_id');
            $table->unsignedBigInteger('hashtag_id');
            
            $table->text('image_url');
            $table->text('author');
            $table->text('content')->nullable();
            $table->boolean('posted')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->text('ig_upload_id')->nullable();
            $table->timestamps();

            $table->index('ig_account_id');
            $table->index('reddit_scraper_id');
            $table->index('hashtag_id');
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
        Schema::dropIfExists('posts');
    }
};
