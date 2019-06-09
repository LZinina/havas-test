<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en');
            $table->string('title_uz');
            $table->string('title_ru');
            $table->string('alias');
            $table->string('data');
            $table->string('time');
            $table->string('price_en');
            $table->string('price_uz');
            $table->string('price_ru');
            $table->string('address_en');
            $table->string('address_uz');
            $table->string('address_ru');
            $table->text('text_en');
            $table->text('text_uz');
            $table->text('text_ru');
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
        Schema::dropIfExists('shedules');
    }
}
