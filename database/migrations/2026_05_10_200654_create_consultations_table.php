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
        Schema::create('consultations', function (Blueprint $table) {

            $table->id();

            // Relation patient
            $table->foreignId('patient_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Informations consultation
            $table->date('date_consultation');

            // Constantes médicales
            $table->float('glycemie')->nullable();

            $table->string('tension')->nullable();

            $table->float('poids')->nullable();

            $table->float('taille')->nullable();

            $table->float('temperature')->nullable();
            $table->enum('type_glycemie', [

                        'A jeun',
                        'Apres repas'

            ])->nullable();

            // Calcul IMC
            $table->float('imc')->nullable();

            // Notes médicales
            $table->text('observations')->nullable();

            $table->text('traitement')->nullable();

            // Rendez-vous
            $table->date('prochain_rv')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};