<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentlyVisitedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recently_visited_products', function (Blueprint $table) {
            $table->id("visitedId");
            $table->unsignedBigInteger("customer_id");
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("category_id");
            $table->dateTime("visitedDate");
            $table->timestamps();
            $table->foreign("customer_id")->references("customer_id")->on("customers");
            $table->foreign("product_id")->references("product_id")->on("products");
            $table->foreign("category_id")->references("category_id")->on("categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recently_visited_products');
    }
}
