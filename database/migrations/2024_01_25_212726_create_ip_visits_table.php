<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_ip_visits_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpVisitsTable extends Migration
{
    public function up()
    {
        Schema::create('ip_visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->date('date');
            $table->timestamps();

            $table->unique(['ip', 'date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ip_visits');
    }
}
