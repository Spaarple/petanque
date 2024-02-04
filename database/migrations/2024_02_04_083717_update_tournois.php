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
        Schema::table('tournois', function (Blueprint $table) {
            $table->text('tournoi_description')->after('tournoi_name'); // Description du tournois
            $table->string('tournoi_location')->after('tournoi_description'); // Lieu du tournois
            $table->dateTime('tournoi_registration_deadline')->default('2024-01-01 00:00:00')->after('tournoi_location'); // Date limite d'inscription  
        });
        //    $table->integer('unique_visitors')->default(0)->after('visits');
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
