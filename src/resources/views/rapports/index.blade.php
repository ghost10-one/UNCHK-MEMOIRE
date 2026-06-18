<x-app-layout>
    <div class="min-h-screen bg-[#F8FAFC] py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-4xl mx-auto space-y-6">
            
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Centre de Téléchargement des Rapports</h1>
                <p class="text-sm text-gray-500 mt-1">Générez et exportez les données d'activité de la plateforme Sante+</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-48">
                    <div>
                        <div class="text-xl font-bold text-gray-900 mb-2">Rapport d'Activité PDF</div>
                        <p class="text-sm text-gray-500">Génère un document officiel au format PDF contenant les indicateurs clés de performance et les prochaines visites programmées.</p>
                    </div>
                    <a href="{{ route('pdf.download') }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Visualiser / Imprimer le PDF
                   </a>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-48">
                    <div>
                        <div class="text-xl font-bold text-gray-900 mb-2">Export des Données Excel (CSV)</div>
                        <p class="text-sm text-gray-500">Télécharge l'intégralité du registre des visites médicales au format tableur Microsoft Excel pour des analyses approfondies.</p>
                    </div>
                    <a href="{{ route('visites.export') }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Télécharger l'export Excel (.xlsx)
                   </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>