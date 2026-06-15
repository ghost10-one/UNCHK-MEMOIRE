<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();                          // Numéro unique du message
            $table->foreignId('sender_id')         // Qui envoie
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('receiver_id')       // Qui reçoit
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->string('subject');             // Sujet du message
            $table->text('body');                  // Contenu du message
            $table->boolean('is_read')             // Lu ou non lu
                  ->default(false);
            $table->boolean('is_archived')         // Archivé ou non
                  ->default(false);
            $table->timestamp('read_at')           // Quand il a été lu
                  ->nullable();
            $table->index(['sender_id',            // Index pour performances
                          'receiver_id']);
            $table->timestamps();                  // created_at + updated_at
            $table->softDeletes();                 // Pour supprimer sans effacer
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};