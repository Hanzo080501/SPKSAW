<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'brand' => $this->brand,
            'price' => $this->price,
            'range' => $this->range,
            'battery_type' => $this->battery_type,
            'drive_type' => $this->drive_type,
            'dealer_availability' => $this->dealer_availability,
            'spare_part_availability' => $this->spare_part_availability,
            'top_speed' => $this->top_speed,
            'charging_time' => $this->charging_time,
            'ranking' => $this->ranking
        ];
    }
}
