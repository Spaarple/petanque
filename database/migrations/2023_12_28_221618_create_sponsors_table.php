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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sponsor_name');
            $table->string('sponsor_logo');
            $table->string('sponsor_website');
            $table->string('sponsor_description');
            $table->string('sponsor_contact_name')->nullable();
            $table->string('sponsor_contact_email')->nullable();
            $table->string('sponsor_contact_phone')->nullable();
            $table->string('sponsor_contact_address')->nullable();
            $table->string('sponsor_contact_city')->nullable();
            $table->string('sponsor_contact_state')->nullable();
            $table->string('sponsor_contact_zip')->nullable();
            // subscription end date
            $table->date('sponsor_subscription_end_date');
            
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
