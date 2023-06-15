<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropResource extends JsonResource
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
            'Name' => $this->Name,
            'Price' => $this->Price,
            'Bedrooms' => $this->Bedrooms,
            'Bathrooms' => $this->Bathrooms,
            'Storeys' => $this->Storeys,
            'Garages' => $this->Garages
        ];
    }
}
