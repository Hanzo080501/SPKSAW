<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Kriteria;
use App\Models\PenilaianAlternatif;
use Illuminate\Support\Facades\Cache;

class SAWController extends Controller
{
    public function calculateSAW()
    {
        return Cache::remember('saw_results', 60, function () {
            $kriterias = Kriteria::all();
            $penilaianAlternatifs = PenilaianAlternatif::with('car', 'kriteria')->get();

            // Lookup untuk penilaianAlternatif berdasarkan kriteria_id
            $penilaianLookup = $penilaianAlternatifs->groupBy('kriteria_id');

            // Matriks Penilaian Alternatif
            $penilaianAlternatifMatrix = [];
            foreach ($penilaianAlternatifs as $penilaian) {
                $penilaianAlternatifMatrix[$penilaian->car_id][$penilaian->kriteria_id] = $penilaian->nilai;
            }

            // Normalisasi Matriks R
            $normalisasi = [];
            foreach ($kriterias as $kriteria) {
                $penilaianKriteria = $penilaianLookup->get($kriteria->id, collect());
                $nilaiKriteria = $penilaianKriteria->pluck('nilai');
                $extremeValue = $kriteria->type === 'benefit' ? $nilaiKriteria->max() : $nilaiKriteria->min();

                if ($extremeValue == 0) {
                    $extremeValue = 1;
                }

                foreach ($penilaianKriteria as $penilaian) {
                    $normalisasi[$penilaian->car_id][$kriteria->id] = $kriteria->type === 'benefit'
                        ? round($penilaian->nilai / $extremeValue, 6)
                        : round($extremeValue / $penilaian->nilai, 6);
                }
            }

            // Matriks Preferensi (V)
            $preferensi = [];
            foreach ($normalisasi as $carId => $normalisasiKriteria) {
                $totalPreferensi = 0;

                foreach ($normalisasiKriteria as $kriteriaId => $nilaiNormalisasi) {
                    $bobot = $kriterias->where('id', $kriteriaId)->first()->bobot ?? 0;
                    $totalPreferensi += round($nilaiNormalisasi * $bobot, 6);
                }

                $preferensi[$carId] = $totalPreferensi ?: 0;
            }


            // Ranking berdasarkan preferensi
            arsort($preferensi);
            $ranking = [];
            $rank = 1;
            foreach ($preferensi as $carId => $score) {
                $car = Car::find($carId);
                $carIndex = array_search($carId, array_keys($penilaianAlternatifMatrix));
                if ($car) {
                    // Simpan preferensi dan ranking ke dalam tabel cars
                    $car->update([
                        'preference_score' => $score,
                        'ranking' => $rank,
                    ]);
                }

                $ranking[] = [
                    'car_id' => $carId,
                    // 'car_name' => $car ? $car->name : 'Unknown',
                    'car_name' => 'A' . ($carIndex + 1),
                    'score' => $score,
                    'rank' => $rank++,
                ];
            }

            return [
                'cars' => Car::all(),
                'kriterias' => $kriterias,
                'penilaianAlternatifMatrix' => $penilaianAlternatifMatrix,
                'normalisasiMatrix' => $normalisasi,
                'preferensiMatrix' => $preferensi,
                'ranking' => $ranking,
            ];
        });
    }
}
