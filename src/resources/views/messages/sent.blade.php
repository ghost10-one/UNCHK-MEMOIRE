<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">

        {{-- Titre --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                📤 Messages envoyés
            </h1>
            <a href="{{ route('messages.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg 
                      hover:bg-blue-700 transition">
                ✉️ Nouveau message
            </a>
        </div>

        {{-- Menu navigation messagerie --}}
        <div class="flex gap-4 mb-6 border-b pb-3">
            <a href="{{ route('messages.inbox') }}"
               class="text-gray-500 hover:text-blue-600">
                📬 Réception
            </a>
            <a href="{{ route('messages.sent') }}"
               class="text-blue-600 font-semibold border-b-2 border-blue-600 pb-1">
                📤 Envoyés
            </a>
            <a href="{{ route('messages.archived') }}"
               class="text-gray-500 hover:text-blue-600">
                🗄️ Archivés
            </a>
        </div>

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Liste des messages envoyés --}}
        @forelse($messages as $message)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-3 p-4
                        flex items-center justify-between">
                <div class="flex-1">
                    {{-- Destinataire --}}
                    <p class="font-semibold text-gray-800 dark:text-white">
                        À : {{ $message->receiver->name }}
                        @if($message->attachments->count() > 0)
                            <span class="ml-2 text-gray-400 text-xs">
                                📎 {{ $message->attachments->count() }} fichier(s)
                            </span>
                        @endif
                    </p>
                    {{-- Sujet --}}
                    <p class="text-gray-600 dark:text-gray-300 text-sm mt-1">
                        {{ $message->subject }}
                    </p>
                    {{-- Date + statut lu --}}
                    <div class="flex gap-3 mt-1">
                        <p class="text-gray-400 text-xs">
                            {{ $message->created_at->format('d/m/Y à H:i') }}
                        </p>
                        @if($message->is_read)
                            <span class="text-green-500 text-xs">
                                ✅ Lu
                            </span>
                        @else
                            <span class="text-orange-400 text-xs">
                                🔔 Non lu
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 ml-4">
                    <a href="{{ route('messages.show', $message) }}"
                       class="text-blue-600 hover:underline text-sm">
                        Voir
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center mt-10">
                <p class="text-gray-500 text-lg">📭 Aucun message envoyé.</p>
                <a href="{{ route('messages.create') }}"
                   class="text-blue-600 hover:underline text-sm mt-2 inline-block">
                    Envoyer votre premier message
                </a>
            </div>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </div>
</x-app-layout>