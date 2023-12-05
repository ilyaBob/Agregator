<?php

namespace App\Http\Resources;

use App\Models\Admin\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Author $this */
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
