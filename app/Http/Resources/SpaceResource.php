<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Space */
class SpaceResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'sectionsCount' => $this->whenLoaded('sections', $this->sections->count()),
            'sections' => $this->whenLoaded('sections'),
        ];
    }

}
