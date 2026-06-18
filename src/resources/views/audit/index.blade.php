<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Journal d'Audit et Suivi</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Historique des actions</h3>
                    <p class="text-sm text-gray-500">Suivi en temps réel des actions effectuées sur la plateforme.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="py-4 px-6">Date & Heure</th>
                            <th class="py-4 px-6">Utilisateur</th>
                            <th class="py-4 px-6">Action</th>
                            <th class="py-4 px-6">Description</th>
                            <th class="py-4 px-6">Navigateur / Appareil</th>
                            <th class="py-4 px-6">Adresse IP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($logs as $log)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="py-4 px-6 text-gray-600 whitespace-nowrap">
                                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">
                                            {{ substr($log->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-900 block">{{ $log->user->name ?? 'Inconnu' }}</span>
                                            <span class="text-xs text-gray-400 block">{{ $log->user->email ?? '' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-6 whitespace-nowrap">
                                    @if(str_contains($log->action, 'CREATE'))
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                            Création
                                        </span>
                                    @elseif(str_contains($log->action, 'UPDATE'))
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.212 8H17"></path></svg>
                                            Modification
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Suppression
                                        </span>
                                    @endif
                                </td>

                                <td class="py-4 px-6 text-gray-700 max-w-xs truncate" title="{{ $log->description }}">
                                    {{ $log->description }}
                                </td>

                                <td class="py-4 px-6 text-gray-500 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs bg-gray-100 text-gray-600 font-mono">
                                        {{ Str::limit($log->user_agent ?? 'Navigateur', 25) }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 text-gray-400 font-mono text-xs whitespace-nowrap">
                                    {{ $log->ip_address ?? '127.0.0.1' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 px-6 text-center text-gray-500">
                                    Aucune activité enregistrée dans le journal d'audit pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($logs->hasPages())
                <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                    {{ $logs->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>