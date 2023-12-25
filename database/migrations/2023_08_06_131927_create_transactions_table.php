<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('added_from')->unsigned();
            $table->foreign('added_from')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tnx_id')->null();
            $table->float('amount')->null();
            $table->string('currency')->null();
            $table->string('status')->null();
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
        Schema::dropIfExists('transactions');
    }
}
