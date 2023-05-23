<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdustosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produstos', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->unsignedBigInteger('category_id');
            $table->text('description');
            $table->integer('stock');
            $table->string('image',250);
            $table->decimal('price', 8, 2);
            $table->smallInteger('showProduct');
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
        Schema::dropIfExists('Product');
    }
}
