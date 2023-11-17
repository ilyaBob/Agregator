<?php

namespace App\Models\Admin;

use App\Enums\NotificationEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $is_new
 * @property string $title
 * @property string $description
 * @property integer $type
 */
class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getCountNotification(): int
    {
        return self::query()
            ->where('is_new', '=', 1)
            ->where('type', '<>', NotificationEnum::TYPE_MESSAGE)
            ->count();
    }

    public static function getCountErrors(): int
    {
        return self::query()
            ->where('is_new', '=', 1)
            ->where('type', '=', NotificationEnum::TYPE_ERROR)
            ->count();
    }

    public static function getCountMessage(): int
    {
        return self::query()
            ->where('is_new', '=', 1)
            ->where('type', '=', NotificationEnum::TYPE_MESSAGE)
            ->count();
    }

    public static function getCountLogs(): int
    {
        return self::query()
            ->where('is_new', '=', 1)
            ->where('type', '=', NotificationEnum::TYPE_LOGS)
            ->count();
    }
}
