<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('p_transaction_id')->nullable();
            $table->integer('p_user_id')->nullable();
            $table->decimal('p_money')->nullable()->comment('Số tiền thanh toán');
            $table->string('p_note')->nullable()->comment('Ghi chú giao dịch');
            $table->string('p_vnp_response_code')->nullable()->comment('Mã phản hồi');
            $table->string('p_code_vnpay')->nullable()->comment("ma giao dich");
            $table->string('p_code_bank')->nullable()->comment("mã ngân hàng");
            $table->dateTime('p_time')->nullable()->comment("Thời gian chuyển khoản");
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
        Schema::dropIfExists('payment');
    }
}
