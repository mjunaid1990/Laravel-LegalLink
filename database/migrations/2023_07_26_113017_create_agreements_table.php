<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->integer('added_from')->nullable();
            $table->string('name', 300)->nullable();
            $table->integer('category_id')->nullable();
            $table->string('language', 80)->nullable();
            $table->integer('page_count')->nullable();
            $table->enum('status', array('draft','hidden','published'))->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->float('regular_price')->nullable();
            $table->float('sale_price')->nullable();
            $table->integer('promotion_id')->nullable();
            $table->tinyInteger('is_featured')->nullable();
            $table->tinyInteger('is_recomended')->nullable();
            $table->text('tags')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->longText('agreement_text')->nullable();
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
        Schema::dropIfExists('agreements');
    }
}
