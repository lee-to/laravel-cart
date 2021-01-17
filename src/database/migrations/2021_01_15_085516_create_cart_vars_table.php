<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartVarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_vars', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("cart_id");
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');

            $table->unsignedBigInteger("variant_id");
            $table->foreign('variant_id')->references('id')->on(config("cart.product_variant_table"))->onDelete('cascade');

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
        Schema::dropIfExists('cart_vars');
    }
}
