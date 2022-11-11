<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('quiz_score')->nullable();

            $table->foreignId('user_id')
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
