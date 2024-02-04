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
        Schema::create('tournois', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tournoi_name');
            // date start
            $table->dateTime('tournoi_start_date');
            // hour start

            // frais de pré inscription
            $table->integer('tournoi_pre_inscription_fee');
            // frais d'inscription
            $table->integer('tournoi_inscription_fee');
            
            // locaux
            $table->string('tournoi_team_local');
            // visiteurs
            $table->string('tournoi_team_visitor');

            

            

            // nombre de places maximum
            $table->integer('tournoi_max_participants');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournois');
    }
};
