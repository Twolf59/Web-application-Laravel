<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CapteurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capteurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero');
            $table->string('gateway');
            $table->date('installation_date');
            $table->string('status');
            $table->string('batterie')->nullable();
            $table->float('latitude');
            $table->float('longitude');
            $table->float('rssi')->nullable();
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
        Schema::dropIfExists('capteurs');
    }
}
