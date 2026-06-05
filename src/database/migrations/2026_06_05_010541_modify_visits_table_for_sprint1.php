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
        Schema::table('visits', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->integer('duration_minutes')->nullable();
        });
        Schema::table('visits', function (Blueprint $table) {
            $table->enum('status', ['planifiee', 'realisee', 'annulee'])->default('planifiee');
            $table->index('visit_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('duration_minutes');
        });
        Schema::table('visits', function (Blueprint $table) {
            $table->string('status')->default('planifiée');
            $table->dropIndex(['visit_date']);
        });
    }
};
