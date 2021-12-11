<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WishEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish_evaluations', function (Blueprint $table) {
            $table->increments('id')->unsigned()->nullable(false);
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('wisher_id');
            $table->integer('item_id')->unsigned();
            $table->string('comment',400)->default("");

            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('wish_items')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users');
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
        //
    }
}
