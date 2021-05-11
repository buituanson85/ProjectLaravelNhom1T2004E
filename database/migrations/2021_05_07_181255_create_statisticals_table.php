<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statisticals', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('order_date')->comment('ngày giao dịch')->nullable();//đổi sang date
            $table->decimal('sales')->comment('doanh số')->nullable();
            $table->decimal('profit')->comment('lợi nhuận')->nullable();
            $table->integer('quantity')->comment('số lượng xe')->nullable();
            $table->integer('total_order')->comment('tổng đơn hàng')->nullable();
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
        Schema::dropIfExists('statisticals');
    }
}
