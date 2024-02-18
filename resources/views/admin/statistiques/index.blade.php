{{-- resources/views/admin/statistiques/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-700">Statistiques</h2>

                <div class="flex flex-wrap -mx-4">
                    {{-- Daily Visits Chart --}}
                    <div class="w-full md:w-1/3 px-4 mb-6">
                        <h3 class="text-md font-semibold text-gray-600">Visites Journalières</h3>
                        <div class="bg-white p-4 rounded-lg shadow">
                            {!! $uniqueVisitorsChart->renderHtml() !!}
                        </div>
                    </div>

                    {{-- Register user per day --}}
                    <div class="w-full md:w-1/3 px-4 mb-6">
                        <h3 class="text-md font-semibold text-gray-600">Inscriptions Journalières</h3>
                        <div class="bg-white p-4 rounded-lg shadow">
                            {!! $userRegistrationChart->renderHtml() !!}
                        </div>
                    </div>

                    {{-- Another Chart or Table --}}
                    <div class="w-full md:w-1/3 px-4 mb-6">
                        <h3 class="text-md font-semibold text-gray-600">Nombre d'inscription total aux tournois</h3>
                        <div class="bg-white p-4 rounded-lg shadow">
                            {{-- Inscription au tournois via le site --}}
                            {!! $inscriptionsTournoisChart->renderHtml() !!}
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-4">
                    {{-- IP Views --}}
                    <div class="w-full lg:w-1/2 px-4 mb-6">
                        <h3 class="text-md font-semibold text-gray-600">Top IP Views</h3>
                        <div class="bg-white p-4 rounded-lg shadow">
                            {{-- IP Views --}}
                            <table class="min-w-full mt-2">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            IP</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Views</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($ipViews as $view)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $view->ip }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $view->views }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Page Views --}}
                    <div class="w-full lg:w-1/2 px-4 mb-6">
                        <h3 class="text-md font-semibold text-gray-600">Top Page Views</h3>
                        <div class="bg-white p-4 rounded-lg shadow">
                            {{-- Table for Page Views --}}
                            <table class="min-w-full mt-2">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Page</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Views</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($pageViews as $view)
                                        <tr>
                                            {{-- if str > 40 char cut  --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Illuminate\Support\Str::limit($view->page, 40) }}

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $view->views }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-4">
                    {{-- Traffic Sources --}}
                    <div class="w-full px-4">
                        <h3 class="text-md font-semibold text-gray-600">Top Traffic Sources</h3>
                        <div class="bg-white p-4 rounded-lg shadow">
                            {{-- Table for Traffic Sources --}}
                            <table class="min-w-full mt-2">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Source</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hits</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($trafficSources as $source)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $source->referer }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $source->hits }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @section('javascript')
        {!! $uniqueVisitorsChart->renderChartJsLibrary() !!}
        {!! $uniqueVisitorsChart->renderJs() !!}
        {!! $userRegistrationChart->renderJs() !!}
        {!! $inscriptionsTournoisChart->renderJs() !!}
    @endsection
</x-app-layout>
