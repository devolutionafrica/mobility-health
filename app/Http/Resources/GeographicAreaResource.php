<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeographicAreaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ref'=>$this->id,
            'name'=>$this->name,
            'countries'=>CountryResource::collection($this->whenLoaded('countries')),
        ];
    }
}
