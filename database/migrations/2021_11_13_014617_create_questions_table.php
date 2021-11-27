<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('value');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            // $table->bigInteger('column_id')->unsigned()->nullable();

            $table->bigInteger('collection_id')->unsigned();
            $table->foreign('collection_id')->references('id')->on('collections');

            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');

            $table->boolean('status');
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
        Schema::dropIfExists('questions');
    }
}
