<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'tags'        => TagResource::collection($this->tags),
            'like_counts' => $this->likes_count,
            'created_at'  => $this->created_at,
        ];
    }
}
