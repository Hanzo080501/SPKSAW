<x-filament-panels::page>
    <!-- Tabel Penilaian Alternatif -->
    <h2 class="mt-6 text-xl font-semibold">Tabel Penilaian Alternatif:</h2>
    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full border border-collapse border-gray-300 table-auto">
            <thead class="bg-gray-500">
                <tr>
                    <th class="px-4 py-2 text-left border border-gray-300">Nama Mobil</th>
                    @foreach ($kriterias as $kriteria)
                        <th class="px-4 py-2 text-left border border-gray-300">{{ $kriteria->nama_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $car->name }}</td>
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
                    <th class="px-4 py-2 text-left border border-gray-300">Nama Mobil</th>
                    @foreach ($kriterias as $kriteria)
                        <th class="px-4 py-2 text-left border border-gray-300">{{ $kriteria->nama_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $car->name }}</td>
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

    <!-- Tabel Preferensi dengan Bobot yang Diterapkan pada Matriks R -->
    <h2 class="mt-6 text-xl font-semibold">Tabel Preferensi:</h2>
    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full border border-collapse border-gray-300 table-auto">
            <thead class="bg-gray-500">
                <tr>
                    <th class="px-4 py-2 text-left border border-gray-300">Nama Mobil</th>
                    @foreach ($kriterias as $kriteria)
                        <th class="px-4 py-2 text-left border border-gray-300">{{ $kriteria->nama_kriteria }}</th>
                    @endforeach
                    <th class="px-4 py-2 text-left border border-gray-300">Hasil</th>
                    <th class="px-4 py-2 text-left border border-gray-300">Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ranking as $rank)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $rank['car_name'] }}</td>
                        @foreach ($kriterias as $kriteria)
                            <td class="px-4 py-2 border border-gray-300">
                                {{ $normalisasiMatrix[$rank['car_id']][$kriteria->id] * $kriteria->bobot ?? 'N/A' }}
                            </td>
                        @endforeach
                        <td class="px-4 py-2 border border-gray-300">{{ $rank['score'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $rank['rank'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
