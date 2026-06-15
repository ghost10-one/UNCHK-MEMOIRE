<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4">

        {{-- Titre --}}
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
            📨 Détail du message
        </h1>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">

            {{-- Expéditeur --}}
            <div class="mb-4 border-b pb-4">
                <p class="text-gray-500 text-sm">De :</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    {{ $message->sender->name }}
                </p>
            </div>

            {{-- Sujet --}}
            <div class="mb-4 border-b pb-4">
                <p class="text-gray-500 text-sm">Sujet :</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    {{ $message->subject }}
                </p>
            </div>

            {{-- Date --}}
            <div class="mb-4 border-b pb-4">
                <p class="text-gray-500 text-sm">Reçu :</p>
                <p class="text-gray-800 dark:text-white">
                    {{ $message->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>

            {{-- Corps du message --}}
            <div class="mb-6">
                <p class="text-gray-500 text-sm mb-2">Message :</p>
                <p class="text-gray-800 dark:text-white leading-relaxed">
                    {{ $message->body }}
                </p>
            </div>

            {{-- Pièces jointes --}}
            @if($message->attachments->count() > 0)
                <div class="mb-6 border-t pt-4">
                    <p class="text-gray-500 text-sm mb-2">📎 Pièces jointes :</p>
                    @foreach($message->attachments as $attachment)
                        <a href="{{ Storage::url($attachment->path) }}" 
                           target="_blank"
                           class="flex items-center gap-2 text-blue-600 
                                  hover:underline mb-2">
                            📄 {{ $attachment->filename }}
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Boutons --}}
            <div class="flex gap-3 border-t pt-4">
                <a href="{{ route('messages.inbox') }}"
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg 
                          hover:bg-gray-300 transition">
                    ← Retour
                </a>
                <form action="{{ route('messages.archive', $message) }}" method="POST">
                    @csrf @method('PATCH')
                    <button class="bg-red-100 text-red-600 px-4 py-2 rounded-lg 
                                   hover:bg-red-200 transition">
                        🗄️ Archiver
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>