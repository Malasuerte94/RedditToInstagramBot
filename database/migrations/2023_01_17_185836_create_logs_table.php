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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->text('model')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->text('message')->nullable();
            $table->text('data')->nullable();
            $table->json('exception')->nullable();

            $table->timestamps();
            $table->index('model_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
