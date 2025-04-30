<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            "status" => $this->status,
            "status_message" => $this->status_message,
            "price" => $this->price,
            "date_start" => $this->date_start,
            "date_end" => $this->date_end,
            "period" => $this->period["value"].' '.match ($this->period["type"]){ "year"=> "an(s)","day"=>"jour(s)" ,default =>"mois"},
            "insurance_policy" => $this->insurancePolicy->name,
            "option" => $this->destination_option == "mono" ? "mono-destination":"multi-destination",
            "geographic_area" => $this->geographicArea->name,
        ];
    }
}
