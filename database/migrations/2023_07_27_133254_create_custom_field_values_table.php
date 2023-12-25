<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_field_values', function (Blueprint $table) {
            $table->id();
            
            $table->integer('transaction_id');
            
            $table->integer('agreement_id')->unsigned()->nullable();
            $table->foreign('agreement_id')->references('id')->on('agreements')->onUpdate('cascade')->onDelete('cascade');
            
            $table->integer('custom_field_id')->unsigned()->nullable();
            $table->foreign('custom_field_id')->references('id')->on('custom_fields')->onUpdate('cascade')->onDelete('cascade');
            
            $table->text('field_value')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_field_values');
    }
}
