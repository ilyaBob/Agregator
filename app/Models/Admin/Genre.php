<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $slug
 * @property integer $is_active
 */

class Genre extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    public static function getGenres(): Collection|array
    {
        return self::query()->where('is_active', 1)->get();
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'books_genres', 'genre_id', 'book_id');
    }
}
