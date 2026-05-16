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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Le délégué
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->date('visit_date');
            $table->time('visit_time');
            $table->string('status')->default('planifiée'); // planifiée, confirmée, réalisée, annulée
            $table->text('purpose')->nullable();
            $table->text('report')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
