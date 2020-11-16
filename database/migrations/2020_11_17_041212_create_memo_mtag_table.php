<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoMtagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memo_mtag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('memo_id')->unsigned()->nullable();
            $table->foreign('memo_id')->references('id')->on('memos')->onDelete('cascade');
            $table->bigInteger('mtag_id')->unsigned()->nullable();
            $table->foreign('mtag_id')->references('id')->on('mtags')->onDelete('cascade');
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
        Schema::dropIfExists('memo_mtag');
    }
}
