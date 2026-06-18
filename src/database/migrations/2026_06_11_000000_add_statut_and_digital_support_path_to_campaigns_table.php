<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            if (! Schema::hasColumn('campaigns', 'statut')) {
                $table->string('statut')->default('planifiee')->after('date_fin');
            }

            if (! Schema::hasColumn('campaigns', 'digital_support_path')) {
                $table->string('digital_support_path')->nullable()->after('zone_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['statut', 'digital_support_path']);
        });
    }
};
