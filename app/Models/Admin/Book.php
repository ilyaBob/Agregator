<?php

namespace App\Models\Admin;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use mysql_xdevapi\Collection;

/**
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property string $time
 * @property integer $is_active
 * @property integer $age
 * @property integer $cycle_id
 * @property integer $cycle_number
 * @property string $genre_slug
 * @property string $link_to_original
 *
 *
 * @property object|Author $authors
 * @property object|Genre $genres
 * @property object|Reader $readers
 * @property object|Cycle $cycle
 * @property object|File $files
 */
class Book extends Model
{
    use HasFactory;
    use Filterable;
    use SoftDeletes;

    protected $guarded = [];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'authors_books', 'book_id', 'author_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'books_genres', 'book_id', 'genre_id');
    }

    public function readers(): BelongsToMany
    {
        return $this->belongsToMany(Reader::class, 'books_readers', 'book_id', 'reader_id');
    }

    public function cycle(): HasOne
    {
        return $this->hasOne(Cycle::class, 'id', 'cycle_id');
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'books_files', 'book_id', 'file_id');
    }

    public function getGenre()
    {
        return Genre::where('slug', $this->genre_slug)->first();
    }


}
