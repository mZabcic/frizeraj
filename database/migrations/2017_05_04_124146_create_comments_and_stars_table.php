<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsAndStarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('comments_and_stars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assignment_id')->foreign()->references('id')->on('assignments');
            $table->string('comment');
            $table->integer('stars');
            $table->binary('picture');
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
       Schema::dropIfExists('comments_and_stars');
    }
}
