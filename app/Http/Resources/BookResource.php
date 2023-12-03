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
        /** @var Book $this*/
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
