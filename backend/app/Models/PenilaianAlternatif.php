<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PenilaianAlternatif extends Model
{
    use HasFactory;
    protected $table = 'penilaian_alternatifs';
    protected $fillable = [
        'car_id',
        'kriteria_id',
        'nilai',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
