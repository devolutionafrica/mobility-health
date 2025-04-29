<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>trim($this->id),
            "name"=>$this->name,
            "nationality"=>$this->nationality,
            "prefix"=>$this->phone_prefix,
        ];
    }
}
