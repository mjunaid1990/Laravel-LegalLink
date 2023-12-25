<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementsPurchasedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements_purchaseds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('added_from')->unsigned();
            $table->foreign('added_from')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('agreement_id')->null();
            $table->integer('transaction_id')->null();
            $table->string('tnx_id')->null();
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
        Schema::dropIfExists('agreements_purchaseds');
    }
}
