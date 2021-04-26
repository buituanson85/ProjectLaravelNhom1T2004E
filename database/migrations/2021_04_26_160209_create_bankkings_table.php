<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankkings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account');
            $table->decimal('monney');
            $table->string('note')->nullable();
            $table->string('bank');
            $table->enum('status',['pending','accept','refuse'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bankkings');
    }
}
