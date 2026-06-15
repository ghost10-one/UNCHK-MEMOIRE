<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MessageController extends Controller
{
    use AuthorizesRequests;

    // Boîte de réception
    public function inbox()
    {
        $messages = Message::where('receiver_id', auth()->id())
            ->where('is_archived', false)
            ->with('sender')
            ->latest()
            ->paginate(15);

        return view('messages.inbox', compact('messages'));
    }

    // Afficher un message
    public function show(Message $message)
    {
        $this->authorize('view', $message);
        $message->markAsRead();

        return view('messages.show', compact('message'));
    }

    // Formulaire nouveau message
    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('messages.create', compact('users'));
    }

    // Envoyer un message
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id'   => 'required|exists:users,id',
            'subject'       => 'required|string|max:255',
            'body'          => 'required|string',
            'attachments'   => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        $message = Message::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $validated['receiver_id'],
            'subject'     => $validated['subject'],
            'body'        => $validated['body'],
        ]);

        // Pièces jointes
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $message->attachments()->create([
                    'filename'  => $file->getClientOriginalName(),
                    'path'      => $path,
                    'mime_type' => $file->getMimeType(),
                    'size'      => $file->getSize(),
                ]);
            }
        }

        // Notification au destinataire
        $message->receiver->notify(new NewMessageNotification($message));

        return redirect()->route('messages.inbox')
            ->with('success', 'Message envoyé avec succès !');
    }

    // Archiver un message
    public function archive(Message $message)
    {
        $this->authorize('update', $message);
        $message->update(['is_archived' => true]);

        return back()->with('success', 'Message archivé.');
    }

    // Messages archivés
    public function archived()
    {
        $messages = Message::where('receiver_id', auth()->id())
            ->where('is_archived', true)
            ->with('sender')
            ->latest()
            ->paginate(15);

        return view('messages.archived', compact('messages'));
    }
    // Désarchiver un message
    public function unarchive(Message $message)
    {
        $this->authorize('update', $message);
        
        Message::where('id', $message->id)
               ->update(['is_archived' => false]);

        return back()->with('success', 'Message restauré.');
    }

    // Messages envoyés
    public function sent()
    {
        $messages = Message::where('sender_id', auth()->id())
            ->with('receiver')
            ->with('attachments')
            ->latest()
            ->paginate(15);

        return view('messages.sent', compact('messages'));
    }

    // Télécharger une pièce jointe
    public function downloadAttachment($id)
    {
        $attachment = \App\Models\Attachment::findOrFail($id);
        $this->authorize('view', $attachment->message);
        
        return Storage::disk('public')->download(
            $attachment->path,
            $attachment->filename
        );
    }
}