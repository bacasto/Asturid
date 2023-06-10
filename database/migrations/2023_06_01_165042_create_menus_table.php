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
            $table->string('name',250);
            $table->unsignedBigInteger('entrante_id');
            $table->string('image',250);
            $table->unsignedBigInteger('primerplato_id');
            $table->unsignedBigInteger('segundoplato_id');
            $table->unsignedBigInteger('postre_id');
            $table->unsignedBigInteger('bebida_id');
            $table->decimal('price',10,2);
            $table->timestamps();
            $table->engine = "innoDB";
            $table->foreign('entrante_id')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('primerplato_id')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('segundoplato_id')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('postre_id')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
            $table->foreign('bebida_id')
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
