<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('competition', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('user_name');
            $table->foreignId('quiz_id')->constrained();
            $table->tinyInteger('point');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('competition');
    }
};
