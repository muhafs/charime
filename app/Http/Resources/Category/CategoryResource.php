<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use App\Http\Resources\Tag\TagListResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Series\SeriesListResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'target' => $this->target,
            'description' => $this->description,

            'tags' => TagListResource::collection($this->whenLoaded('tags')),
            'series' => SeriesListResource::collection($this->whenLoaded('series'))
        ];
    }
}
