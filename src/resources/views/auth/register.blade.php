<x-guest-layout>
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour
        </a>
    </div>

    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Créer un compte</h2>
        <p class="text-gray-500 text-sm">Étape 1 sur 2 — Vos informations</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
            <input id="name" class="block w-full rounded-lg border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm" type="text" name="name" value="{{ old('name') }}" placeholder="Amadou Diallo" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input id="email" class="block w-full rounded-lg border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm" type="email" name="email" value="{{ old('email') }}" placeholder="exemple@medrep.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Telephone (Adding a dummy one as it's in the design, even if not in default breeze) -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
            <input id="phone" class="block w-full rounded-lg border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm" type="tel" name="phone" value="{{ old('phone') }}" placeholder="+221 77 123 45 67" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
            <div class="relative">
                <input id="password" class="block w-full rounded-lg border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm" type="password" name="password" placeholder="8 caractères minimum" required autocomplete="new-password" />
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
            <input id="password_confirmation" class="block w-full rounded-lg border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Continuer <span class="ml-2">→</span>
            </button>
        </div>
    </form>

    <!-- Login Link -->
    <p class="mt-8 text-center text-sm text-gray-500">
        Déjà un compte ? 
        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">Se connecter</a>
    </p>
</x-guest-layout>
