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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('country')->nullable();
            $table->string('lang')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('type_engin')->nullable();
            $table->string('immatriculation')->nullable();
            $table->string('photo_profil')->nullable();
            $table->string('numéro_cip')->nullable();
            $table->string('photo_cip')->nullable();
            $table->string('numMatricule')->nullable();
            $table->enum('account_type', ['customer', 'admin', 'livreur_intern', 'livreur_extern'])->default('customer');
            $table->enum('status', ['inactive', 'active', 'attente', 'confirmer', 'rejette', 'desactive'])->default('inactive');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
