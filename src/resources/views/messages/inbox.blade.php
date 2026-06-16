<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        
        {{-- Titre + bouton nouveau message --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                📬 Boîte de réception
            </h1>
            <a href="{{ route('messages.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                ✉️ Nouveau message
            </a>
        </div>
        

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Liste des messages --}}
        @forelse($messages as $message)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-3 p-4 
                        flex items-center justify-between
                        {{ $message->is_read ? 'opacity-70' : 'border-l-4 border-blue-500' }}">
                <div>
                    <p class="font-semibold text-gray-800 dark:text-white">
                        {{ $message->sender->name }}
                        @if(!$message->is_read)
                            <span class="ml-2 bg-blue-100 text-blue-700 
                                         text-xs px-2 py-0.5 rounded-full">
                                Nouveau
                            </span>
                        @endif
                    </p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        {{ $message->subject }}
                    </p>
                    <p class="text-gray-400 text-xs">
                        {{ $message->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('messages.show', $message) }}"
                       class="text-blue-600 hover:underline text-sm">
                        Lire
                    </a>
                    <form action="{{ route('messages.archive', $message) }}" method="POST">
                        @csrf @method('PATCH')
                        <button class="text-gray-400 hover:text-red-500 text-sm">
                            Archiver
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center mt-10">
                📭 Aucun message reçu.
            </p>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</x-app-layout>