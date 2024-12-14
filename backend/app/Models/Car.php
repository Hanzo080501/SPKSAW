<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'image',
        'brand',
        'name',
        'price',
        'range',
        'battery_type',
        'drive_type',
        'dealer_availability',
        'spare_part_availability',
        'top_speed',
        'charging_time',
        'preferensi',
        'ranking'
    ];

    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class);
    }

    public function penilaianAlternatifs()
    {
        return $this->hasMany(PenilaianAlternatif::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function (Car $car) {
            $car->penilaianAlternatifs()->delete();
        });

        static::deleted(function (Car $car) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
        });

        // static::restoring(function (Car $car) {
        //     $car->kriterias()->restore();
        //     $car->penilaianAlternatifs()->restore();
        // });

    }
}
