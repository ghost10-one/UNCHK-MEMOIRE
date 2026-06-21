<?php

use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

// 👇 IMPORTANT : utiliser RefreshDatabase
uses(RefreshDatabase::class);

// ================================
// Test 1 : Envoyer un message
// ================================
test('un utilisateur peut envoyer un message', function () {
    Notification::fake();

    $sender   = User::factory()->create();
    $receiver = User::factory()->create();

    $response = $this->actingAs($sender)
        ->post(route('messages.store'), [
            'receiver_id' => $receiver->id,
            'subject'     => 'Test sujet',
            'body'        => 'Contenu du message test',
        ]);

    $response->assertRedirect(route('messages.inbox'));

    expect(Message::where('sender_id', $sender->id)
        ->where('receiver_id', $receiver->id)
        ->exists()
    )->toBeTrue();

    Notification::assertSentTo($receiver, NewMessageNotification::class);
});

// ================================
// Test 2 : Voir la boîte de réception
// ================================
test('un utilisateur peut voir sa boite de reception', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('messages.inbox'))
        ->assertOk()
        ->assertViewIs('messages.inbox');
});

// ================================
// Test 3 : Message marqué lu à l'ouverture
// ================================
test('un message est marqué lu quand on l ouvre', function () {
    $message = Message::factory()->create(['is_read' => false]);

    $this->actingAs($message->receiver)
        ->get(route('messages.show', $message));

    expect($message->fresh()->is_read)->toBeTrue();
    expect($message->fresh()->read_at)->not->toBeNull();
});

// ================================
// Test 4 : Sécurité
// ================================
test('un utilisateur ne peut pas lire le message d un autre', function () {
    $message  = Message::factory()->create();
    $intruder = User::factory()->create();

    $this->actingAs($intruder)
        ->get(route('messages.show', $message))
        ->assertForbidden();
});

// ================================
// Test 5 : Archiver un message
// ================================
test('un utilisateur peut archiver un message', function () {
    $message = Message::factory()->create(['is_archived' => false]);

    $this->actingAs($message->receiver)
        ->patch(route('messages.archive', $message));

    expect($message->fresh()->is_archived)->toBeTrue();
});

// ================================
// Test 6 : Désarchiver un message
// ================================
test('un utilisateur peut desarchiver un message', function () {
    $message = Message::factory()->create(['is_archived' => true]);

    $this->actingAs($message->receiver)
        ->patch(route('messages.unarchive', $message));

    expect($message->fresh()->is_archived)->toBeFalse();
});

// ================================
// Test 7 : Validation formulaire
// ================================
test('on ne peut pas envoyer un message sans sujet', function () {
    $sender   = User::factory()->create();
    $receiver = User::factory()->create();

    $this->actingAs($sender)
        ->post(route('messages.store'), [
            'receiver_id' => $receiver->id,
            'subject'     => '',
            'body'        => 'Contenu du message',
        ])
        ->assertSessionHasErrors('subject');
});