<x-app-layout>
    <div class="min-h-screen bg-[#F8FAFC] py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto space-y-8">
            
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Rapports</h1>
                <p class="text-slate-500 text-sm mt-1">Consultez et téléchargez vos rapports d'activité</p>
            </div>

            <!-- 3 Top Cards matching Maquette Page 8 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Rapport 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-72">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <span class="text-xs font-bold px-3 py-1 bg-slate-100 text-slate-600 rounded-full">Visites</span>
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900 mb-1">Rapport mensuel de visites</h3>
                        <p class="text-xs font-medium text-slate-400 mb-6">📅 1-31 Mai 2026</p>
                        
                        <div class="grid grid-cols-3 gap-2 text-center mb-6">
                            <div>
                                <div class="text-lg font-black text-blue-600">124</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Visites</div>
                            </div>
                            <div>
                                <div class="text-lg font-black text-blue-600">45</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Médecins</div>
                            </div>
                            <div>
                                <div class="text-lg font-black text-blue-600">320</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Échantillons</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('pdf.download') }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md shadow-blue-500/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Télécharger PDF
                    </a>
                </div>

                <!-- Rapport 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-72">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </div>
                            <span class="text-xs font-bold px-3 py-1 bg-slate-100 text-slate-600 rounded-full">Performance</span>
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900 mb-1">Performance commerciale</h3>
                        <p class="text-xs font-medium text-slate-400 mb-6">📅 1-31 Mai 2026</p>
                        
                        <div class="grid grid-cols-3 gap-2 text-center mb-6">
                            <div>
                                <div class="text-lg font-black text-slate-900">45k€</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Ventes</div>
                            </div>
                            <div>
                                <div class="text-lg font-black text-emerald-600">+12%</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Croissance</div>
                            </div>
                            <div>
                                <div class="text-lg font-black text-blue-600">85%</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Objectif</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('pdf.download') }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md shadow-blue-500/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Télécharger PDF
                    </a>
                </div>

                <!-- Rapport 3 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-72">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <span class="text-xs font-bold px-3 py-1 bg-slate-100 text-slate-600 rounded-full">Territoire</span>
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900 mb-1">Couverture territoriale</h3>
                        <p class="text-xs font-medium text-slate-400 mb-6">📅 1-31 Mai 2026</p>
                        
                        <div class="grid grid-cols-3 gap-2 text-center mb-6">
                            <div>
                                <div class="text-lg font-black text-blue-600">92%</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Couverture</div>
                            </div>
                            <div>
                                <div class="text-lg font-black text-blue-600">12</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Nouv. Med.</div>
                            </div>
                            <div>
                                <div class="text-lg font-black text-blue-600">8</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Zones</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('pdf.download') }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md shadow-blue-500/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Télécharger PDF
                    </a>
                </div>
            </div>

            <!-- Bottom Custom Report Banner matching Maquette Page 8 -->
            <div class="bg-blue-50/70 border border-blue-100 rounded-3xl p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/30 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 01-2-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900 mb-1">Rapport personnalisé</h3>
                        <p class="text-sm text-slate-600">Générez un rapport sur mesure avec les métriques et la période de votre choix (export Excel ou PDF).</p>
                    </div>
                </div>
                <a href="{{ route('visites.export') }}" class="inline-flex items-center justify-center px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md shadow-blue-500/20 transition-all whitespace-nowrap">
                    Créer un rapport
                </a>
            </div>

        </div>
    </div>
</x-app-layout>