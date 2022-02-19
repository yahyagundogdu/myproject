<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('settings_description');
            $table->string('settings_key');
            $table->text('settings_value');
            $table->string('settings_type');
            $table->integer('settings_order');
            $table->enum('settings_delete',[0,1]);
            $table->enum('settings_status',[0,1]);
            $table->enum('soft_delete',[0,1]);
            $table->text('group');
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
        Schema::dropIfExists('settings');
    }
}
