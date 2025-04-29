<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $insuredCard = $this->insuredCard;
        //verifier
        $avatar = $this->avatar;

        /**
         * @var $this Customer
         */
        return [
            'ref' => $this->id,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'email' => $this->email,
            'phone_number' => is_string($this->phone_number) ? [
                "number" => $this->phone_number,
                "code" => "+225"
            ] : $this->phone_number,
            'whatsapp_number' => is_string($this->whatsapp_number) ? [
                "number" => $this->whatsapp_number,
                "code" => "+225"
            ] : $this->phone_number,
            'created_at' => $this->created_at,


            'birth_date' => $this->birth_date,
            'nationality_code' => $this->nationality_id,
            'residence_code' => $this->country_of_residence_id,
            'document' => !is_null($this->document_type) ? [
                'type' => $this->document_type,
                'num' => $this->document_num,
                'recto' => route("image.indexUrl", ["path" => $this->documentRecto->path]),
                'verso' => null
            ] : null,
            'avatar' => is_null($avatar) ? null : urlGen(src: route("image.indexUrl", ["path" => $avatar->path]), width: 200, height: 200, fit: "contain"),
            'medical_issues' => $this->medicalIssues()->exists(),
            'health_record' => $this->healthRecord()->exists(),
            'subscriptions' => SubscriptionResource::collection($this->subscriptions()->with(["insurancePolicy", "geographicArea"])->get()),
            "card" => is_null($insuredCard) ? null : [
                "insured_number" => $insuredCard->insured_number,
                "card_number" => $insuredCard->card_number,
                "issue_date" => $insuredCard->issue_date,
                "expiration_date" => $insuredCard->expiration_date,
                "status" => $insuredCard->status,
            ],

        ];
    }
}
