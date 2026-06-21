<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();                          // Numéro unique du fichier
            $table->foreignId('message_id')        // Lié à quel message
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('filename');            // Nom du fichier
            $table->string('path');               // Où il est stocké
            $table->string('mime_type');           // Type du fichier (pdf, jpg...)
            $table->unsignedBigInteger('size');    // Taille du fichier
            $table->timestamps();                  // created_at + updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};