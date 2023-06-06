<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->unsignedBigInteger('category_id');
            $table->text('description');
            $table->integer('stock');
            $table->string('image',250)->nullable(true);
            $table->decimal('price',8,2);
            $table->smallInteger('showProduct');
            $table->timestamps();
            $table->engine = "innoDB";

            $table->foreign('category_id')
                ->on('categories')
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
        Schema::dropIfExists('products');
    }
}