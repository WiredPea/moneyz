<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionProcessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_processors', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('bank');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('transaction_processors', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_processors');
    }
}
