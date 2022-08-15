<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultWorksheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_worksheets', function (Blueprint $table) {
            $table->id();
            $table->integer('skor');
            $table->string('question_type');
            $table->integer('correct');
            $table->integer('wrong');

            $table->bigInteger('worksheet_id')->unsigned();
            $table->foreign('worksheet_id')->references('id')->on('worksheets');

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
        Schema::dropIfExists('result_worksheets');
    }
}
