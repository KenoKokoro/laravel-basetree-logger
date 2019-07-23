<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('client');
            $table->text('url');
            $table->string('method');
            $table->text('requestHeaders');
            $table->text('requestBody')->nullable();
            $table->text('responseHeaders');
            $table->text('responseBody')->nullable();
            $table->integer('code');
            $table->string('going');

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
        Schema::dropIfExists('traffic_logs');
    }
}
