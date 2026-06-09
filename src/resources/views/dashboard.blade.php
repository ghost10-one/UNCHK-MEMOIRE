<x-app-layout>
    <!-- We don't need the header slot anymore as it is managed in app-layout -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <!-- Stat Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <h3 class="text-sm font-medium text-gray-500 mb-4">Visites du jour</h3>
            <div>
                <div class="text-3xl font-bold text-gray-900 mb-2">5</div>
                <div class="flex items-center text-sm text-green-600 font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +20% vs hier
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <h3 class="text-sm font-medium text-gray-500 mb-4">Visites cette semaine</h3>
            <div>
                <div class="text-3xl font-bold text-gray-900 mb-2">18</div>
                <div class="flex items-center text-sm text-green-600 font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +25% vs sem. dernière
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <h3 class="text-sm font-medium text-gray-500 mb-4">Rapports en attente</h3>
            <div>
                <div class="text-3xl font-bold text-gray-900 mb-2">3</div>
                <div class="text-sm text-gray-500">À compléter</div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <h3 class="text-sm font-medium text-gray-500 mb-4">Taux de réalisation</h3>
            <div class="flex items-end justify-between">
                <div class="text-3xl font-bold text-gray-900">75%</div>
                <!-- Mini Bar Chart Simulation -->
                <div class="flex items-end space-x-1 h-8">
                    <div class="w-2 bg-blue-500 rounded-t h-4"></div>
                    <div class="w-2 bg-blue-500 rounded-t h-5"></div>
                    <div class="w-2 bg-blue-500 rounded-t h-3"></div>
                    <div class="w-2 bg-blue-500 rounded-t h-6"></div>
                    <div class="w-2 bg-blue-500 rounded-t h-8"></div>
                    <div class="w-2 bg-blue-500 rounded-t h-7"></div>
                    <div class="w-2 bg-blue-500 rounded-t h-8"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Prochaines visites -->
        <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Prochaines visites<br>aujourd'hui</h3>
                <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500 text-right">Voir toutes les<br>visites</a>
            </div>
            
            <div class="divide-y divide-gray-100">
                <!-- Visite Item 1 -->
                <div class="p-6 flex gap-4">
                    <div class="flex flex-col items-center min-w-[60px]">
                        <div class="flex items-center text-gray-500 text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            09:00
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-1">
                            <h4 class="text-base font-bold text-gray-900">Dr. Martin Pierre</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Confirmée</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Cardiologue</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Hopital Fann
                        </div>
                    </div>
                </div>

                <!-- Visite Item 2 -->
                <div class="p-6 flex gap-4">
                    <div class="flex flex-col items-center min-w-[60px]">
                        <div class="flex items-center text-gray-500 text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            11:30
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-1">
                            <h4 class="text-base font-bold text-gray-900">Dr. Awa Ndiaye</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">En attente</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Pédiatre</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Clinique International
                        </div>
                    </div>
                </div>

                <!-- Visite Item 3 -->
                <div class="p-6 flex gap-4">
                    <div class="flex flex-col items-center min-w-[60px]">
                        <div class="flex items-center text-gray-500 text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            14:30
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-1">
                            <h4 class="text-base font-bold text-gray-900">Dr. Bernard Sophie</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Confirmée</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Généraliste</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Cabinet Médical
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
            <h3 class="text-lg font-bold text-gray-900 mb-8">Performance (Mai 2024)</h3>
            
            <div class="flex-1 flex flex-col justify-center gap-12">
                <!-- Circular Chart Simulator -->
                <div class="flex flex-col items-center justify-center">
                    <div class="relative w-48 h-48 rounded-full border-[16px] border-gray-100 flex items-center justify-center">
                        <div class="absolute inset-0 rounded-full border-[16px] border-blue-500" style="clip-path: polygon(0 0, 100% 0, 100% 100%, 0 75%); transform: rotate(-45deg);"></div>
                        <div class="text-center z-10 bg-white rounded-full w-full h-full flex flex-col items-center justify-center">
                            <div class="text-4xl font-bold text-gray-900">75%</div>
                            <div class="text-sm text-gray-500">Objectif atteint</div>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">15 / 20 visites</div>
                </div>

                <!-- Progress Bars -->
                <div class="space-y-4 max-w-md mx-auto w-full">
                    <div class="text-sm font-medium text-gray-500 mb-2">100%</div>
                    
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700">Sem 1</span>
                            <span class="font-medium text-gray-900">65%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700">Sem 2</span>
                            <span class="font-medium text-gray-900">75%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700">Sem 3</span>
                            <span class="font-medium text-gray-900">70%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700">Sem 4</span>
                            <span class="font-medium text-gray-900">85%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700">Sem 5</span>
                            <span class="font-medium text-gray-900">75%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
