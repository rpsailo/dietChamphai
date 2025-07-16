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
        Schema::create('facultysubjects', function (Blueprint $table) {
            $table->id();
            $table->integer('facultyId');
            $table->string('facultyName');
            $table->integer('subjectId');
            $table->string('subjectName');
            $table->integer('courseId');
            $table->integer('semesterId');
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
        Schema::dropIfExists('facultysubjects');
    }
};
