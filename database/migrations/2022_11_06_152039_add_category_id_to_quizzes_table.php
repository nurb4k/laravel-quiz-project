<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->default(1)
                ->constrained()
                ->restrictOnDelete();

        });
    }

    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign('quizzes_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
};
