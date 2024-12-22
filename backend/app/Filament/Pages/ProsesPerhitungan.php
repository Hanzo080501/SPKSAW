<?php

namespace App\Filament\Pages;

use App\Http\Controllers\SAWController;
use Filament\Pages\Page;

class ProsesPerhitungan extends Page
{
    protected static ?string $title = 'Perhitungan SAW';
    protected static ?string $navigationLabel = 'Perhitungan SAW';
    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationGroup = 'Admin Management';
    protected static string $view = 'filament.pages.proses-perhitungan';

    public $cars;
    public $kriterias;
    public $penilaianAlternatifMatrix;
    public $normalisasiMatrix;
    public $preferensiMatrix;
    public $ranking;

    public function mount()
    {
        // Mengambil data dari controller
        $sawController = new SAWController();
        $data = $sawController->calculateSAW();

        // Assign data ke properti
        $this->cars = $data['cars'];
        $this->kriterias = $data['kriterias'];
        $this->penilaianAlternatifMatrix = $data['penilaianAlternatifMatrix'];
        $this->normalisasiMatrix = $data['normalisasiMatrix'];
        $this->preferensiMatrix = $data['preferensiMatrix'];
        $this->ranking = $data['ranking'];
    }

    public function getResults()
    {
        return [
            'cars' => $this->cars,
            'normalisasiMatrix' => $this->normalisasiMatrix,
            'preferensiMatrix' => $this->preferensiMatrix,
            'ranking' => $this->ranking,
        ];
    }
}
