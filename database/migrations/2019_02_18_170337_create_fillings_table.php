<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create fillings table.
        Schema::create('fillings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->text('body');
            $table->unsignedBigInteger('composition');
            $table->string('image');
            $table->enum('using', ['all', 'up', 'single'])->default('single');
            $table->boolean('mastic');
            $table->boolean('naked');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop fillings table.
        Schema::drop('fillings');
    }
}
