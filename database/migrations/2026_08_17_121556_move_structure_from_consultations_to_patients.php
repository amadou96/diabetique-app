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
        Schema::table('patients', function (Blueprint $table) {
            $table->string('structure')->nullable()->after('numero_dossier');
        });

        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn('structure');
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->string('structure')->nullable()->after('date_consultation');
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('structure');
        });
    }
};
