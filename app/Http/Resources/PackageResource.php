<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "ref" => $this->id,
            "type" => $this->type,
            "price" => $this->price,
            "period_type" => $this->validity_period_type,
            "period_value" => intval($this->validity_period_value),
            "geographic_area" => GeographicAreaResource::make($this->geographicArea),
        ];
    }
}
