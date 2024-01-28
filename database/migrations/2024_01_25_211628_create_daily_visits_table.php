<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_daily_visits_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyVisitsTable extends Migration
{
    public function up()
    {
        Schema::create('daily_visits', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('visits')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_visits');
    }
}

