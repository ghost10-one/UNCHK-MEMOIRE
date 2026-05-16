<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planifier une nouvelle visite') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50">
                    <h3 class="text-lg font-bold text-slate-900">Détails de la visite</h3>
                    <p class="text-sm text-slate-500 italic">Remplissez les informations pour planifier votre rencontre.</p>
                </div>

                <form action="{{ route('visits.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="doctor_id" class="text-xs font-bold uppercase text-slate-400 tracking-wider">Médecin</label>
                            <select name="doctor_id" id="doctor_id" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Sélectionnez un médecin</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->full_name }} ({{ $doctor->specialty }})</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase text-slate-400 tracking-wider">Établissement</label>
                            <div class="w-full bg-slate-100 border border-slate-200 rounded-xl text-sm p-2.5 text-slate-500 italic">
                                Sélectionné automatiquement via le médecin
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="visit_date" class="text-xs font-bold uppercase text-slate-400 tracking-wider">Date</label>
                            <input type="date" name="visit_date" id="visit_date" value="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm focus:ring-blue-500 focus:border-blue-500">
                            <x-input-error :messages="$errors->get('visit_date')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <label for="visit_time" class="text-xs font-bold uppercase text-slate-400 tracking-wider">Heure</label>
                            <input type="time" name="visit_time" id="visit_time" class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm focus:ring-blue-500 focus:border-blue-500">
                            <x-input-error :messages="$errors->get('visit_time')" class="mt-2" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="purpose" class="text-xs font-bold uppercase text-slate-400 tracking-wider">Motif de la visite</label>
                        <textarea name="purpose" id="purpose" rows="3" placeholder="Présentation produit, suivi, etc." class="w-full bg-slate-50 border-slate-100 rounded-xl text-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                        <x-input-error :messages="$errors->get('purpose')" class="mt-2" />
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-4">
                        <a href="{{ route('visits.index') }}" class="px-6 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition">Annuler</a>
                        <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                            Enregistrer la visite
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
