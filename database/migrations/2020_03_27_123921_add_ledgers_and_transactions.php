<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLedgersAndTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unsigned()->index();
            $table->string('name')->nullable();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('ledgers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ledger_from')->unsigned()->index();
            $table->bigInteger('ledger_to')->unsigned()->index();
            $table->integer('amount');
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('ledger_from')->references('id')->on('ledgers');
            $table->foreign('ledger_to')->references('id')->on('ledgers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schame::dropIfExists('transactions');
        Schema::dropIfExists('ledgers');
    }
}
