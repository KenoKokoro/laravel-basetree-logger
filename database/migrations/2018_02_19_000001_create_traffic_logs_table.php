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
            $table->string('url');
            $table->string('method');
            $table->text('requestHeaders');
            $table->text('requestBody')->nullable();
            $table->text('responseHeaders');
            $table->text('responseBody')->nullable();
            $table->integer('code');
            $table->enum('going', (new BaseTree\Models\TrafficLog())->going()->toArray());

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
