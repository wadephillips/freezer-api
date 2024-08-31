<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Section */
class SectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'uniqueItemsCount' => $this->items->count(),
            //'totalItemsCount' => $this->items->sum(),
            'items' => $this->whenLoaded('items', SectionItemResource::collection($this->items)),
            'spaceId' => $this->space_id,
            'space' => new SpaceResource($this->whenLoaded('space')),
        ];
    }
}
