<?php

namespace App\Http\Resources;

use App\Models\Admin\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Book $this */
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'linkToOriginal' => $this->link_to_original,
            'isActive' => $this->is_active,
            'age' => $this->age,
            'time' => $this->time,
            'genreSlug' => $this->genre_slug,
            'image' => $this->image,
            'description' => $this->description,
            'cycle' => [
                'cycleId' => $this->cycle_id,
                'cycleName' => $this->cycle->name,
                'cycleNumber' => $this->cycle_number,
            ],
            'genres' => GenreResource::collection($this->whenLoaded('genres')),
            'readers' => ReaderResource::collection($this->whenLoaded('readers')),
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
        ];
    }
}
