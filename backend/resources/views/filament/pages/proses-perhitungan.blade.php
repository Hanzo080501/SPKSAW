<x-filament-panels::page>

    <!-- Tabel Penilaian Alternatif -->
    <h2 class="mt-6 text-xl font-semibold">Tabel Penilaian Alternatif:</h2>
    <table class="w-full mt-4 border border-collapse border-gray-300 table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 border border-gray-300">Nama Mobil</th>
                @foreach ($kriterias as $kriteria)
                    <th class="px-4 py-2 border border-gray-300">{{ $kriteria->nama_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td class="px-4 py-2 border border-gray-300">{{ $car->name }}</td>
                    @foreach ($kriterias as $kriteria)
                        <td class="px-4 py-2 border border-gray-300">
                            {{-- Tampilkan nilai penilaian alternatif --}}
                            {{ $penilaianAlternatifMatrix[$car->id][$kriteria->id] ?? 'N/A' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Normalisasi Matriks R -->
    <h2 class="mt-6 text-xl font-semibold">Tabel Normalisasi Matriks R:</h2>
    <table class="w-full mt-4 border border-collapse border-gray-300 table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 border border-gray-300">Nama Mobil</th>
                @foreach ($kriterias as $kriteria)
                    <th class="px-4 py-2 border border-gray-300">{{ $kriteria->nama_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td class="px-4 py-2 border border-gray-300">{{ $car->name }}</td>
                    @foreach ($kriterias as $kriteria)
                        <td class="px-4 py-2 border border-gray-300">
                            {{-- Tampilkan nilai normalisasi matriks R --}}
                            {{ $normalisasiMatrix[$car->id][$kriteria->id] ?? 'N/A' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Preferensi dengan Rangking -->
    <h2 class="mt-6 text-xl font-semibold">Tabel Preferensi:</h2>
    <table class="w-full mt-4 border border-collapse border-gray-300 table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 border border-gray-300">Rangking</th>
                <th class="px-4 py-2 border border-gray-300">Nama Mobil</th>
                <th class="px-4 py-2 border border-gray-300">Preferensi (V)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ranking as $rank)
                <tr>
                    <td class="px-4 py-2 border border-gray-300">{{ $rank['rank'] }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $rank['car_name'] }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $rank['score'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-filament-panels::page>
