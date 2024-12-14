<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'type',
        'bobot'
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'penilaian_alternatifs')
            ->withPivot('nilai')  // Kolom nilai di pivot table
            ->withTimestamps();   // Menyertakan timestamp otomatis
    }

    public function penilaianAlternatifs()
    {
        return $this->hasMany(PenilaianAlternatif::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function (Kriteria $kriteria) {
            $kriteria->penilaianAlternatifs()->delete();
        });
    }
}
