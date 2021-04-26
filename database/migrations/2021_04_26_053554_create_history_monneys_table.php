<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryMonneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_monneys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trading_code');
            $table->string('send_monney');
            $table->string('note');
            $table->unsignedInteger('wallet_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_monneys');
    }
}
