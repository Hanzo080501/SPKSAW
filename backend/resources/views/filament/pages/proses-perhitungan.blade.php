<x-filament-panels::page>
    <!-- Tabel Penilaian Alternatif -->
    <h2 class="mt-6 text-xl font-semibold">Tabel Nilai Kriteria:</h2>
    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full border border-collapse border-gray-300 table-auto">
            <thead class="bg-gray-500">
                <tr>
                    <th class="px-4 py-2 text-left border border-gray-300">Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                        <th class="px-4 py-2 text-left border border-gray-300">{{ $kriteria->kode_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $index => $car)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ 'A' . ($index + 1) }}</td>
                        @foreach ($kriterias as $kriteria)
                            <td class="px-4 py-2 border border-gray-300">
                                {{ $penilaianAlternatifMatrix[$car->id][$kriteria->id] ?? 'N/A' }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabel Normalisasi Matriks R -->
    <h2 class="mt-6 text-xl font-semibold">Tabel Normalisasi Matriks R:</h2>
    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full border border-collapse border-gray-300 table-auto">
            <thead class="bg-gray-500">
                <tr>
                    <th class="px-4 py-2 text-left border border-gray-300">Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                        <th class="px-4 py-2 text-left border border-gray-300">{{ $kriteria->kode_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $index => $car)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ 'A' . ($index + 1) }}</td>
                        @foreach ($kriterias as $kriteria)
                            <td class="px-4 py-2 border border-gray-300">
                                {{ $normalisasiMatrix[$car->id][$kriteria->id] ?? 'N/A' }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabel Menghitung Nilai Preferensi (V) -->
    <h2 class="mt-6 text-xl font-semibold">Tabel Menghitung Nilai Preferensi (V):</h2>
    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full border border-collapse border-gray-300 table-auto">
            <thead class="bg-gray-500">
                <tr>
                    <th class="px-4 py-2 text-left border border-gray-300">Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                        <th class="px-4 py-2 text-left border border-gray-300">{{ $kriteria->kode_kriteria }}</th>
                    @endforeach
                    <th class="px-4 py-2 text-left border border-gray-300">Hasil</th>
                    <th class="px-4 py-2 text-left border border-gray-300">Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $index => $car)
                    @php
                        $rankData = collect($ranking)->firstWhere('car_id', $car->id);
                    @endphp
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ 'A' . ($index + 1) }}</td>
                        @foreach ($kriterias as $kriteria)
                            <td class="px-4 py-2 border border-gray-300">
                                {{ isset($normalisasiMatrix[$car->id][$kriteria->id])
                                    ? $normalisasiMatrix[$car->id][$kriteria->id] * $kriteria->bobot
                                    : 'N/A' }}
                            </td>
                        @endforeach
                        <td class="px-4 py-2 border border-gray-300">{{ $rankData['score'] ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $rankData['rank'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="bg-gray-800">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <figure class="highcharts-figure">
            <div id="ranking-chart"></div>
        </figure>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const rankingData = @json($ranking);

                Highcharts.chart('ranking-chart', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Ranking Alternatif Berdasarkan Nilai Preferensi'
                    },
                    xAxis: {
                        categories: rankingData.map(data => data.car_name),
                        title: {
                            text: 'Alternatif'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Nilai Preferensi'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">Nilai: </td>' +
                            '<td style="padding:0"><b>{point.y:.6f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Nilai Preferensi (V)',
                        data: rankingData.map(data => data.score)
                    }]
                });
            });
        </script>
    </div>
</x-filament-panels::page>
