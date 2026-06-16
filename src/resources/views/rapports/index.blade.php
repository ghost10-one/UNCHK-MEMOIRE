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
                    <a href="{{ route('pdf.download') }}" target="_blank" class="w-full text-center py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
                        📄 Visualiser / Imprimer le PDF
                    </a>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-48">
                    <div>
                        <div class="text-xl font-bold text-gray-900 mb-2">Export des Données Excel (CSV)</div>
                        <p class="text-sm text-gray-500">Télécharge l'intégralité du registre des visites médicales au format tableur Microsoft Excel pour des analyses approfondies.</p>
                    </div>
                    <a href="#" class="w-full text-center py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
                        📊 Télécharger l'export Excel (.xlsx)
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>