<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('text_answer');
            $table->text('link_picture')->nullable();
            $table->boolean('isTrue')->nullable();

            $table->foreignId('question_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
