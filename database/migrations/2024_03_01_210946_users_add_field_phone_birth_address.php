<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // add fields to users table phone, birthday, address + make email not mandatory
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            // birthday is a date format jj/mm/aaaa
            $table->date('birthday')->nullable()->after('phone');
            $table->string('address')->nullable()->after('birthday');
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
