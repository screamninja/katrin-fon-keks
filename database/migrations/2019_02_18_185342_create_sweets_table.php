<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create sweets table.
        Schema::create('sweets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->default(0);
            $table->foreign('author_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('title')->unique();
            $table->text('body');
            $table->enum('type', ['cake', 'cupcake', 'cookie', 'dessert'])->default('dessert');
            $table->unsignedBigInteger('themes');
            $table->float('price');
            $table->float('weight');
            $table->integer('filling_id')->unsigned()->default(0);
            $table->foreign('filling_id')
                ->references('id')->on('fillings')
                ->onDelete('cascade');
            $table->string('image');
            $table->string('slug')->unique();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop sweets table.
        Schema::drop('sweets');
    }
}
