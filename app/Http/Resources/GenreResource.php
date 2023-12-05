<?php

namespace App\Http\Resources;

use App\Models\Admin\Genre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Genre $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'isActive' => $this->is_active,
            'slug' => $this->slug,
            'createdAt' => Carbon::parse($this->created_at)->toDateString(),
            'books' => BookResource::collection($this->whenLoaded('books'))
        ];
    }
}
