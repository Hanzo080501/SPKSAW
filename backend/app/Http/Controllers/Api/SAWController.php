<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Kriteria;
use App\Models\PenilaianAlternatif;
use Illuminate\Http\Request;

class SAWController extends Controller
{
    public function calculateSAWWithFilter(Request $request)
    {
        // Validasi filter input
        $validated = $request->validate([
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0',
            'jarak_tempuh' => 'nullable|numeric',
            'top_speed' => 'nullable|numeric',
            'charging_time' => 'nullable|numeric',
            'jenis_battery' => 'nullable|string',
            'jenis_penggerak' => 'nullable|string',
            'spare_part_availability' => 'nullable|boolean',
            'dealer_availability' => 'nullable|boolean',
        ]);

        // Query mobil dengan filter
        $filteredCars = Car::query()
            ->when($request->filled('price_min'), fn($query) => $query->where('price', '>=', $validated['price_min']))
            ->when($request->filled('price_max'), fn($query) => $query->where('price', '<=', $validated['price_max']))
            ->when($request->filled('jarak_tempuh'), fn($query) => $query->where('range', $validated['jarak_tempuh']))
            ->when($request->filled('top_speed'), fn($query) => $query->where('top_speed', $validated['top_speed']))
            ->when($request->filled('charging_time'), fn($query) => $query->where('charging_time', $validated['charging_time']))
            ->when($request->filled('jenis_battery'), fn($query) => $query->where('battery_type', $validated['jenis_battery']))
            ->when($request->filled('jenis_penggerak'), fn($query) => $query->where('drive_type', $validated['jenis_penggerak']))
            ->when($request->filled('spare_part_availability'), fn($query) => $query->where('spare_part_availability', $validated['spare_part_availability']))
            ->when($request->filled('dealer_availability'), fn($query) => $query->where('dealer_availability', $validated['dealer_availability']))
            ->get();

        if ($filteredCars->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada mobil yang sesuai dengan filter.',
                'ranking' => [],
            ]);
        }

        // Ambil data kriteria
        $kriterias = Kriteria::all();

        // Ambil penilaian alternatif berdasarkan mobil yang difilter
        $penilaianAlternatifs = PenilaianAlternatif::with('car', 'kriteria')
            ->whereIn('car_id', $filteredCars->pluck('id'))
            ->get();

        // Matriks Penilaian Alternatif
        $penilaianMatrix = [];
        foreach ($penilaianAlternatifs as $penilaian) {
            $penilaianMatrix[$penilaian->car_id][$penilaian->kriteria_id] = $penilaian->nilai;
        }

        // Normalisasi Matriks R
        $normalisasi = [];
        foreach ($kriterias as $kriteria) {
            $nilai = collect($penilaianMatrix)->pluck($kriteria->id)->filter();
            $extremeValue = $kriteria->type === 'benefit' ? $nilai->max() : $nilai->min();

            if (!$extremeValue) continue;

            foreach ($penilaianMatrix as $carId => $row) {
                if (isset($row[$kriteria->id])) {
                    $normalisasi[$carId][$kriteria->id] = $kriteria->type === 'benefit'
                        ? round($row[$kriteria->id] / $extremeValue, 6)
                        : round($extremeValue / $row[$kriteria->id], 6);
                }
            }
        }

        // Hitung Preferensi
        $preferensi = [];
        foreach ($normalisasi as $carId => $normalisasiKriteria) {
            $preferensi[$carId] = array_reduce(array_keys($normalisasiKriteria), function ($carry, $kriteriaId) use ($normalisasiKriteria, $kriterias) {
                $kriteria = $kriterias->firstWhere('id', $kriteriaId);
                $bobot = $kriteria->bobot ?? 0;
                return $carry + ($normalisasiKriteria[$kriteriaId] * $bobot);
            }, 0);
        }

        // Ranking
        arsort($preferensi);
        $ranking = [];
        $rank = 1;
        foreach ($preferensi as $carId => $score) {
            $car = $filteredCars->find($carId);
            $ranking[] = [
                'id' => $carId,
                'brand' => $car->brand,
                'name' => $car->name,
                'image' => $car->image ?? 'default_image.jpg', // Tambahkan gambar jika ada
                'price' => $car->price,
                'range' => $car->range,
                'top_speed' => $car->top_speed,
                'charging_time' => $car->charging_time,
                'jenis_battery' => $car->battery_type,
                'jenis_penggerak' => $car->drive_type,
                'spare_part_availability' => $car->spare_part_availability,
                'dealer_availability' => $car->dealer_availability,
                'score' => round($score, 6),
                'ranking' => $rank++,
            ];
        }

        return response()->json([
            'ranking' => $ranking,
        ]);
    }
}
