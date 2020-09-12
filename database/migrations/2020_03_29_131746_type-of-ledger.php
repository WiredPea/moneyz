<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TypeOfLedger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        Schema::table('ledgers', function (Blueprint $table) {
            $table->bigInteger('ledgerType_id')->after('user_id')->unsigned()->index()->nullable();
        });

        Schema::table('ledgers', function (Blueprint $table) {
            $table->foreign('ledgerType_id')->references('id')->on('ledger_types');
        });

        DB::table('ledger_types')->insert(['type' => 'Assets']);
        DB::table('ledger_types')->insert(['type' => 'Liabilities']);
        DB::table('ledger_types')->insert(['type' => 'Revenue']);
        DB::table('ledger_types')->insert(['type' => 'Costs']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ledgers', function (Blueprint $table) {
            $table->dropColumn('ledgerType');
        });

        Schema::dropIfExists('ledger_types');
    }
}
