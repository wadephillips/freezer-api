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
            'space_id' => $this->space_id,
            'items' => $this->whenLoaded('items', SectionItemResource::collection($this->items)),
            //'total_items_count' => $this->items->sum(),
            'unique_items_count' => $this->items->count(),
            'space' => new SpaceResource($this->whenLoaded('space')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
