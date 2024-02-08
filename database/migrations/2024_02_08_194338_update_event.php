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
        Schema::table('events', function (Blueprint $table) {
            // createur de l'event
            $table->foreignId('user_id')->constrained();
            // date de fin d'inscription
            $table->date('registration_deadline')->nullable();
            // frais de pré inscription integer
            $table->integer('pre_registration_fee')->nullable();
            // frais d'inscription integer
            $table->integer('registration_fee')->nullable();
            // adresse de l'event
            $table->string('location')->nullable();

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
