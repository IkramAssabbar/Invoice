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
        Schema::create('facture_rec_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idFactureRecu');
            $table->foreign('idFactureRecu')
            ->references('id')
            ->on('facture_reccurentes')
            ->onDelete('cascade');

            $table->unsignedBigInteger('idServiceRec');
            $table->foreign('idServiceRec')
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
        Schema::dropIfExists('facture_rec_services');
    }
};
