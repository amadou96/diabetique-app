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
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn('tension');
            $table->integer('tension_systolique')->nullable()->after('type_glycemie');
            $table->integer('tension_diastolique')->nullable()->after('tension_systolique');
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn(['tension_systolique', 'tension_diastolique']);
            $table->string('tension')->nullable()->after('type_glycemie');
        });
    }
};
