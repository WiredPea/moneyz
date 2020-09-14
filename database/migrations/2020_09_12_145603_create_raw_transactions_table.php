<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ledgers', function (Blueprint $table) {
            $table->unique('number');
        });
        Schema::create('raw_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id')->unsigned();
            $table->date('date');
            $table->char('debitCredit');
            $table->integer('amount')->unsigned();
            $table->string('contraAccount');
            $table->string('contraAccountHolder');
            $table->string('method');
            $table->string('description');
            $table->string('authorizationNumber');
            $table->string('creditor');
            $table->string('reference')->nullable();
            $table->timestamps();
        });
        Schema::table('raw_transactions', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('ledgers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_transactions');
    }
}
