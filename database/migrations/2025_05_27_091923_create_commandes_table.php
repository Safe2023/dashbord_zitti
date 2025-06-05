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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users');
            $table->string('adresse_depart');
            $table->string('nom_dep');
            $table->string('tel_dep');
            $table->text('description_dep')->nullable();
            $table->string('adresse_desti');
            $table->string('nom_desti');
            $table->string('tel_desti');
            $table->text('description_desti')->nullable();
            $table->string('poids')->nullable();
            $table->string('taille')->nullable();
            $table->text('message')->nullable();
            $table->string('image')->nullable();
            $table->enum('statut', ['en_attente', 'en_cours', 'terminee', 'annulee'])->default('en_attente');
            $table->decimal('prix', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
