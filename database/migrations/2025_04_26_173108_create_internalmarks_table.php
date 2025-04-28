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
        Schema::create('internalmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courseId');
            $table->foreignId('subjectId');
            $table->foreignId('studentId');
            $table->integer('internal');
            $table->integer('mark');
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
        Schema::dropIfExists('internalmarks');
    }
};
