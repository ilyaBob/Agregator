<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $slug
 * @property integer $is_active
 *
 * @property Reader $books
 */

class Reader extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public static function getReaders(): Collection|array
    {
        return self::query()->where('is_active', 1)->get();
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class,'books_readers', 'reader_id','book_id');
    }
}
