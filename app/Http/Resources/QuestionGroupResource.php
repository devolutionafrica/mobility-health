<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionGroupResource extends JsonResource
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
            "title" => $this->title,
            "page" => $this->page,
            "questions" => QuestionResource::collection($this->questions),
        ];
    }
}
