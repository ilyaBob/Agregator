<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $file
 */

class File extends Model
{
    use HasFactory;

    protected $guarded = [];
}
