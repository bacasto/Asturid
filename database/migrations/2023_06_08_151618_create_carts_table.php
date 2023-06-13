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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id')->nullable(true);
            $table->unsignedBigInteger('menu_id')->nullable(true);
            $table->text('extras')->nullable(true);
            $table->timestamps();
            $table->engine = "innoDB";
            $table->foreign('user_id')
                ->on('users')
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
        Schema::dropIfExists('carts');
    }
}