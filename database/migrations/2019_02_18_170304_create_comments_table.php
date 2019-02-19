<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create comments table.
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('on_recipe')->unsigned()->default(0);
            $table->foreign('on_recipe')
                ->references('id')->on('recipes')
                ->onDelete('cascade');
            $table->integer('from_user')->unsigned()->default(0);
            $table->foreign('from_user')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->text('body');
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
        // Drop comments table.
        Schema::drop('comments');
    }
}
