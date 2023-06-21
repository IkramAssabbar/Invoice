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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('Libelle');
            $table->decimal('Prix', 8, 2);
            $table->decimal('Tva', 8, 2);
            $table->string('Reference')->nullable();
            $table->text('Description')->nullable();
            $table->unsignedBigInteger('IdCategorie');
            $table->unsignedBigInteger('IdEntreprise');

            $table->foreign('Idcategorie')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->foreign('IdEntreprise')
                ->references('id')
                ->on('entreprises')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
