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
        Schema::create('bon_commande_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idBonCommd');
            $table->foreign('idBonCommd')
            ->references('id')
            ->on('bon_commandes')
            ->onDelete('cascade');

            $table->unsignedBigInteger('idService');
            $table->foreign('idService')
            ->references('id')
            ->on('services')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_commande_services');
    }
};
