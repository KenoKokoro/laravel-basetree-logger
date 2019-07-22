<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTrafficLogsTableIncreaseUrlColumnSize extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::table('traffic_logs', function (Blueprint $table) {
            DB::statement('ALTER TABLE traffic_logs MODIFY url TEXT');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('traffic_logs', function (Blueprint $table) {
            DB::statement('ALTER TABLE traffic_logs MODIFY url VARCHAR(255)');
        });
    }
}
