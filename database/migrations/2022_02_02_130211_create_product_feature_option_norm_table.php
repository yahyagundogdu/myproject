<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFeatureOptionNormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_feature_option_norm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('products_id')->references('id')->on('products');
            $table->foreignId('feature_title_id')->references('id')->on('product_feature_title');
            $table->foreignId('feature_option_id')->references('id')->on('product_feature_option');
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
        Schema::dropIfExists('product_feature_option_norm');
    }
}
