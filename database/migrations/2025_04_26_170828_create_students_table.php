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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courseId');
            $table->string('academicYear');
            $table->string('name');
            $table->integer('regdNo')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('bloodGroup')->nullable();
            $table->string('idMark')->nullable();
            $table->date('dob')->nullable();
            $table->integer('currentSemester')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('students');
    }
};
