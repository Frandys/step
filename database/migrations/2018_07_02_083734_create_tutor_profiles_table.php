<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->nullable()->on('countries');
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->nullable()->on('languages');
            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->nullable()->on('skills');
            $table->integer('specialization_id')->unsigned();
            $table->foreign('specialization_id')->references('id')->nullable()->on('specializations');
            $table->integer('discipline_id')->unsigned();
            $table->foreign('discipline_id')->references('id')->nullable()->on('disciplines');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->nullable()->on('courses');
            $table->string('certification_id', 255)->nullable();
            $table->text('about')->nullable();
            $table->string('resume', 255)->nullable();
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
        Schema::dropIfExists('tutor_profiles');
    }
}
