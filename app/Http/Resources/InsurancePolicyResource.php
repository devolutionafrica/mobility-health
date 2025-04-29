<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsurancePolicyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "description" => $this->description,
            "summary" => $this->summary,
            "ref" => $this->id,
            "name" => $this->name,
            "miniature" => url('/storage/'.$this->miniature?->path),
            "packages" => PackageResource::collection($this->whenLoaded('packages')),
        ];
    }
}
