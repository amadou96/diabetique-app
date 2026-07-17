<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bilans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('patient_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->date('date_bilan');

            $table->string('nom_bilan');

            $table->string('resultat');

            $table->string('unite')->nullable();

            $table->text('observations')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bilans');
    }
};
