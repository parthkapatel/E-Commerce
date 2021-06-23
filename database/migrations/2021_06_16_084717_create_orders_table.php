<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id("orderId");
            $table->string("order_number");
            $table->unsignedBigInteger("customer_id");
            $table->unsignedBigInteger("product_id");
            $table->integer("quantity");
            $table->integer("price");
            $table->integer("total");
            $table->dateTime("bill_pay_date");
            $table->timestamps();
            $table->foreign("customer_id")->references("customer_id")->on("customers");
            $table->foreign("product_id")->references("product_id")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
