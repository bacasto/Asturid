<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entrante');
            $table->unsignedBigInteger('primerplato');
            $table->unsignedBigInteger('segundoplato');
            $table->unsignedBigInteger('postre');
            $table->unsignedBigInteger('bebida');
            $table->timestamps();
            $table->engine = "innoDB";
            $table->foreign('entrante')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('primerplato')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('segundoplato')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('postre')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('bebida')
                ->on('products')
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
        Schema::dropIfExists('menus');
    }
}