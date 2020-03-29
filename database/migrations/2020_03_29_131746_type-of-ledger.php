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
        Schema::create('ledgertypes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        Schema::table('ledgers', function (Blueprint $table) {
            $table->bigInteger('ledgerType_id')->unsigned()->index();
        });

        Schema::table('ledgers', function (Blueprint $table) {
            $table->foreign('ledgerType_id')->references('id')->on('ledgertypes');
        });

        DB::table('ledgertypes')->insert(['type' => 'Assets']);
        DB::table('ledgertypes')->insert(['type' => 'Liabilities']);
        DB::table('ledgertypes')->insert(['type' => 'Revenue']);
        DB::table('ledgertypes')->insert(['type' => 'Costs']);

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

        Schema::dropIfExists('ledgertypes');
    }
}
