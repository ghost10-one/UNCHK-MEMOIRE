@props(['zones', 'specialites'])

<div class="bg-white p-4 rounded-lg shadow mb-6">
    <form action="{{ route('praticiens.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
        <div class="flex-1">
            <label for="recherche" class="block text-sm font-medium text-gray-700">Recherche (Nom, Spécialité, etc.)</label>
            <input type="text" name="recherche" id="recherche" value="{{ request('recherche') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="flex-1">
            <label for="specialite" class="block text-sm font-medium text-gray-700">Spécialité</label>
            <select name="specialite" id="specialite" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Toutes les spécialités</option>
                @foreach($specialites as $spe)
                    <option value="{{ $spe }}" {{ request('specialite') == $spe ? 'selected' : '' }}>{{ $spe }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex-1">
            <label for="zone_id" class="block text-sm font-medium text-gray-700">Zone</label>
            <select name="zone_id" id="zone_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Toutes les zones</option>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}" {{ request('zone_id') == $zone->id ? 'selected' : '' }}>{{ $zone->nom }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Filtrer
            </button>
            <a href="{{ route('praticiens.index') }}" class="ml-2 inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Réinitialiser
            </a>
        </div>
    </form>
</div>
