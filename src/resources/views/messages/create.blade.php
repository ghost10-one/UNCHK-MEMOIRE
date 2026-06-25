<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4">
        
        {{-- Titre --}}
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
            ✉️ Nouveau message
        </h1>

        {{-- Formulaire --}}
        <form action="{{ route('messages.store') }}" method="POST" 
              enctype="multipart/form-data"
              class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            @csrf

            {{-- Destinataire --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 mb-2">
                    Destinataire
                </label>
                <select name="receiver_id" 
                        class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 
                               dark:text-white @error('receiver_id') border-red-500 @enderror">
                    <option value="">-- Choisir un destinataire --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('receiver_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sujet --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 mb-2">
                    Sujet
                </label>
                <input type="text" name="subject" 
                       value="{{ old('subject') }}"
                       class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 
                              dark:text-white @error('subject') border-red-500 @enderror"
                       placeholder="Sujet du message">
                @error('subject')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Corps du message --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 mb-2">
                    Message
                </label>
                <textarea name="body" rows="6"
                          class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 
                                 dark:text-white @error('body') border-red-500 @enderror"
                          placeholder="Écrivez votre message...">{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pièces jointes --}}
            <div class="mb-6">
                <label class="block text-gray-700 dark:text-gray-300 mb-2">
                    Pièces jointes (PDF, Word, Images)
                </label>
                <input type="file" name="attachments[]" multiple
                       class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 
                              dark:text-white">
            </div>

            {{-- Boutons --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg 
                               hover:bg-blue-700 transition">
                    📤 Envoyer
                </button>
                <a href="{{ route('messages.inbox') }}"
                   class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg 
                          hover:bg-gray-300 transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-app-layout>