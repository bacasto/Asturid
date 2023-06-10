<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id')->nullable(true);
            $table->unsignedInteger('menu_id')->nullable(true);
            $table->timestamps();
            $table->engine = "innoDB";
            $table->foreign('order_id')
                ->on('orders')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('menu_id')
                ->on('menus')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
