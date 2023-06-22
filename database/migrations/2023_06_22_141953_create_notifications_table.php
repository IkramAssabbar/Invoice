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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('message');
            $table->boolean('vu');
           
            $table->unsignedBigInteger('IdEntreprise');
            $table->foreign('IdEntreprise')
            ->references('id')
            ->on('entreprises')
            ->onDelete('cascade');
            $table->timestamps();

            $table->unsignedBigInteger('IdClient');
            $table->foreign('IdClient')
            ->references('id')
            ->on('clients')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
