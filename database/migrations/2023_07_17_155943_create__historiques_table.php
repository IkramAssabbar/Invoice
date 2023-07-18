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
        Schema::create('historiques_Factures', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->string('type');
            $table->unsignedBigInteger('idfacture');
        

            $table->foreign('idfacture')
            ->references('id')
            ->on('factures')
            ->onDelete('cascade');
           
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_historiques');
    }
};
