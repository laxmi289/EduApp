<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom', function (Blueprint $table) {
            $table->string('faculty_id');
            $table->foreign('faculty_id')->references('username')->on('users')->onDelete('cascade');
            $table->string('class_id')->primary();
            $table->string('sub_code');
            $table->foreign('sub_code')->references('sub_code')->on('subjects')->onDelete('cascade');
            $table->string('student_id')->nullable();
            $table->foreign('student_id')->references('username')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('classroom');
    }
}
