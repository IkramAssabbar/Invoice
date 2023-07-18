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
        Schema::table('charges', function (Blueprint $table) {
            $table->string('libelle');
            $table->float('prix');
            $table->integer('tva');
            $table->string('description');
            $table->unsignedBigInteger('categorieid');
            $table->foreign('categorieid')
            ->references('id')
            ->on('CategorieCh')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('charges', function (Blueprint $table) {
            //
        });
    }
};
