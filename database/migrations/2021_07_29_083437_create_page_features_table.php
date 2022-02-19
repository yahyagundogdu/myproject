<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->unsigned()->constrained('pages');
            $table->string('feature_description');
            $table->string('feature_key');
            $table->text('feature_value')->nullable();
            $table->string('feature_type');
            $table->tinyInteger('sortable')->nullable();
            $table->enum('feature_delete',[0,1])->nullable();
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
        Schema::create('page_features',function(Blueprint $table){
            $table->dropForeign('page_features_page_id_foreign');
        });
    }
}
