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
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('status',['Brouillon','En attente','Envoyée','Annulée']);
            $table->float('montantTotal');
            $table->float('montantHtva');
            $table->string('tva');
            $table->string('remise');
            $table->unsignedBigInteger('IdHistorique');
            $table->foreign('IdHistorique')
            ->references('id')
            ->on('historiques')
            ->onDelete('cascade');

            $table->unsignedBigInteger('IdService');
            $table->foreign('IdService')
            ->references('id')
            ->on('services')
            ->onDelete('cascade');
            

            $table->unsignedBigInteger('IdClient');
            $table->foreign('IdClient')
            ->references('id')
            ->on('clients')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};
