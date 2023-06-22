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
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();
            $table->time('heure');
            $table->date('date');
            $table->string('tva');
            $table->string('text');
            $table->enum('type',['visualisation','envoie','creation','supprimer','modifier','exporter','imprimer','Payee','Brouillon','En attente','Envoyée','En retard','Annulée']);
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};
