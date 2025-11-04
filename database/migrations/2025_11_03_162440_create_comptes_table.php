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
        Schema::create('comptes', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('client_id'); // clé étrangère vers clients
            $table->string('numero_compte')->unique();
            $table->enum('type_compte', ['epargne', 'cheque']);
            $table->dateTime('date_debut_blocage')->nullable();
            $table->dateTime('date_fin_blocage')->nullable();
            $table->enum('statut_compte', ['Actif', 'Bloque', 'Ferme'])->default('Actif');
            $table->timestamps();

            // index
            $table->index(['client_id', 'numero_compte']);

            // clé étrangère
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};