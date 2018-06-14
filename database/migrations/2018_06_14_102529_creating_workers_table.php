<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatingWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperators', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('last name');
            $table->string('name');
            $table->string('patronymic');
            $table->string('birthday');
            $table->string('position');
            $table->string('salary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
