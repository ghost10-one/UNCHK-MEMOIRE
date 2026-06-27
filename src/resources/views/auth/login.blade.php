<x-guest-layout>
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Bienvenue !</h2>
        <p class="text-gray-500 text-sm">Connectez-vous à votre compte</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input id="email" class="block w-full rounded-lg border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm" type="email" name="email" value="{{ old('email') }}" placeholder="exemple@medrep.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
            <div class="relative">
                <input id="password" class="block w-full rounded-lg border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm" type="password" name="password" placeholder="••••••••" required autocomplete="current-password" />
                <!-- Eye Icon for show/hide (dummy) -->
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Forgot Password -->
        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-blue-600 hover:text-blue-500" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent rounded-2xl shadow-md shadow-blue-500/20 text-base font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
            Se connecter <span>→</span>
        </button>
    </form>

    <!-- Demo Accounts Block -->
    <div class="mt-6 bg-slate-50/80 rounded-2xl p-4 border border-slate-100 text-left">
        <h3 class="text-xs font-semibold text-slate-700 mb-2">Comptes de démonstration :</h3>
        <ul class="text-xs text-slate-500 space-y-1 font-mono">
            <li>• delegue@medrep.com / demo1234</li>
            <li>• manager@medrep.com / demo1234</li>
            <li>• pro@medrep.com / demo1234</li>
        </ul>
    </div>

    <!-- Registration Link -->
    <p class="mt-6 text-center text-sm text-slate-500">
        Vous n'avez pas de compte ? 
        <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700">Inscription</a>
    </p>
</x-guest-layout>
