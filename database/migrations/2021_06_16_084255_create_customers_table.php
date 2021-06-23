<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id("customer_id");
            $table->string("first_name",50);
            $table->string("last_name",50);
            $table->string("phone",10);
            $table->string("email",75);
            $table->text("user_name");
            $table->char("password",60);
            $table->text("status")->default(1);
            $table->text("role")->default('U');
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
        Schema::dropIfExists('customers');
    }
}
