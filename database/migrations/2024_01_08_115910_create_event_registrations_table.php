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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //id du tournoi
            $table->integer('event_id');
            // nom du joueur
            $table->string('user_first_name');
            // prénom du joueur
            $table->string('user_last_name');
            // email du joueur
            $table->string('user_email');
            // numéro de téléphone du joueur
            $table->string('user_phone_number');
            // is accepted
            $table->boolean('is_accepted')->default(false);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
