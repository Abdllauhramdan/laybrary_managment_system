<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'year_published' => $this->year_published,
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
        ];
    }
}
