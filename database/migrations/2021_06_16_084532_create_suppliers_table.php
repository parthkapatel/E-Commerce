<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id("supplier_id");
            $table->unsignedBigInteger("customer_id");
            $table->string("company_name",40);
            $table->text("description");
            $table->string("email",75);
            $table->text("user_name");
            $table->char("password",60);
            $table->integer("status")->default(1);
            $table->timestamps();
            $table->foreign("customer_id")->references("customer_id")->on("customers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
