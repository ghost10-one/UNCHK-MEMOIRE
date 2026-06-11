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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
           $table->string('titre');
$table->text('description')->nullable();
$table->date('date_debut')->index();
$table->date('date_fin');
$table->foreignId('delegue_id')->constrained('users')->onDelete('cascade');
$table->foreignId('zone_id')->constrained('zones')->onDelete('cascade');

 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
