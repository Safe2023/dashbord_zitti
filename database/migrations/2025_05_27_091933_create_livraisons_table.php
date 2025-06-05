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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->onDelete('cascade');
            $table->foreignId('livreur_id')->constrained('users')->onDelete('cascade');
            $table->enum('statut', ['En attente', 'En cours', 'Livrée', 'Échouée'])->default('En attente');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin')->nullable();
            $table->double('distance_parcourue')->default(0);
            $table->string('position_actuelle')->nullable();
            $table->boolean('gps_actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
