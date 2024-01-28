<?php

// database/migrations/xxxx_xx_xx_xxxxxx_update_daily_visits_table_add_unique_visitors.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDailyVisitsTableAddUniqueVisitors extends Migration
{
    public function up()
    {
        Schema::table('daily_visits', function (Blueprint $table) {
            $table->integer('unique_visitors')->default(0)->after('visits');
        });
    }

    public function down()
    {
        Schema::table('daily_visits', function (Blueprint $table) {
            $table->dropColumn('unique_visitors');
        });
    }
}
