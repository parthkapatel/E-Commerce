<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product__categories', function (Blueprint $table) {
            $table->id("product_category_id");
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("category_id");
            $table->timestamps();
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
        Schema::dropIfExists('product__categories');
    }
}
