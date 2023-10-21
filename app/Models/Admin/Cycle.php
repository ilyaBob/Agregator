<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $slug
 * @property integer $is_active
 *
 * @property object|Book $books
 */
class Cycle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public static function getCycles(): Collection|array
    {
        return self::query()->where('is_active', 1)->get();
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'cycle_id', 'id')->orderBy('cycle_number');
    }
}
