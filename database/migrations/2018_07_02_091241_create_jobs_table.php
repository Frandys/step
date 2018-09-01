<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title', 255)->nullable();
            $table->enum('type', ['0', '1'])->comment('0=fixes,1=hourly')->nullable();
            $table->integer('rate')->nullable();
            $table->enum('status', ['0', '1'])->comment('0=,1=')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
