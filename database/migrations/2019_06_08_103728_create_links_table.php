<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('link');
            $table->bigInteger('musics_id')->unsigned()->default(1);
            $table->foreign('musics_id')->references('id')->on('musics');
            $table->bigInteger('res_names_id')->unsigned()->default(1);
            $table->foreign('res_names_id')->references('id')->on('res_names');
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
        Schema::dropIfExists('links');
    }
}
