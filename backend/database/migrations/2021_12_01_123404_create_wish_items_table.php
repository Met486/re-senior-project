<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('price');
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('wisher_id');
            $table->integer('category')->unsigned();
            $table->string('isbn_13',13);//ハイフン抜き
            $table->integer('status')->default(1);
            $table->integer('scratches')->nullable();
            $table->string('comment',300)->default("");
            $table->string('url')->default("");
            // $table->string('cover_path');
            $table->timestamps();

            $table->foreign('wisher_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wish_evaluations');
        Schema::dropIfExists('wish_items');
    }
}
