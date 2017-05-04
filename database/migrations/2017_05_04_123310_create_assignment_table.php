<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workin_day_id')->foreign()->references('id')->on('working_day');
            $table->integer('customer_id')->foreign()->references('id')->on('users');
            $table->dateTime('start_at');
            $table->integer('job_id')->foreign()->references('id')->on('jobs');
            $table->integer('wanted_hairstyle_id')->foreign()->references('id')->on('wanted_hairstyles');
            $table->boolean('confirmed');
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
        Schema::dropIfExists('assignments');
    }
}
