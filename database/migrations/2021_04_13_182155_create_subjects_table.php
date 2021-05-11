<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->string('dept_id')->nullable();
            $table->foreign('dept_id')->references('dept_id')->on('departments')->onDelete('cascade');
            $table->string('sub_code')->primary();
            $table->string('sub_name');
            $table->bigInteger('scheme');
            $table->integer('sem');
            $table->bigInteger('year');
            $table->integer('credits');
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
        Schema::dropIfExists('subjects');
    }
}
