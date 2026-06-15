<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">

        {{-- Titre --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                🗄️ Messages archivés
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
               class="text-gray-500 hover:text-blue-600">
                📤 Envoyés
            </a>
            <a href="{{ route('messages.archived') }}"
               class="text-blue-600 font-semibold border-b-2 border-blue-600 pb-1">
                🗄️ Archivés
            </a>
        </div>

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Liste des messages archivés --}}
        @forelse($messages as $message)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-3 p-4
                        flex items-center justify-between opacity-80">
                <div class="flex-1">
                    {{-- Expéditeur --}}
                    <p class="font-semibold text-gray-800 dark:text-white">
                        {{ $message->sender->name }}
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
                    {{-- Date --}}
                    <p class="text-gray-400 text-xs mt-1">
                        {{ $message->created_at->format('d/m/Y à H:i') }}
                    </p>
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 ml-4">
                    <a href="{{ route('messages.show', $message) }}"
                       class="text-blue-600 hover:underline text-sm">
                        Lire
                    </a>
                    <form action="{{ route('messages.unarchive', $message) }}"
                          method="POST">
                        @csrf @method('PATCH')
                        <button class="text-green-600 hover:text-green-800 text-sm">
                            📬 Désarchiver
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center mt-10">
                <p class="text-gray-500 text-lg">📭 Aucun message archivé.</p>
                <a href="{{ route('messages.inbox') }}"
                   class="text-blue-600 hover:underline text-sm mt-2 inline-block">
                    Retour à la boîte de réception
                </a>
            </div>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </div>
</x-app-layout>