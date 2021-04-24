<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('image');
            $table->float('price');
            $table->float('insurrance');
            $table->float('deposit');
            $table->integer('km');
            $table->float('additional');
            $table->enum('engine', ['Xăng', 'Dầu', 'Điện']);
            $table->string('seat');
            $table->string('capacity');
            $table->string('range');
            $table->string('gear');
            $table->string('consumption');
            $table->enum('status', ['refused','pending', 'ready', 'unavailable']);
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('partner_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
