<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('quiz_id');
            $table->string('name');
            $table->integer('point');
            $table->integer('place')->nullable();
            $table->timestamps();
        });
    }
    public function down(){

        Schema::dropIfExists('competitions');
    }
};
