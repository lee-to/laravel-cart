<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->string("session_id");

            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id')->references('id')->on(config("cart.product_table"))->onDelete('cascade');

            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')->references('id')->on(config("cart.user_table"))->onDelete('cascade');

            $table->double("price", 12, 2)->default(0);
            $table->integer("quantity")->default(1);

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
        Schema::dropIfExists('carts');
    }
}
