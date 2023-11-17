<?php

namespace App\Enums;

enum NotificationEnum
{
    const TYPE_ERROR = 1;
    const TYPE_MESSAGE = 2;
    const TYPE_LOGS = 3;

    public static function getTypeList(): array
    {
        return [
            self::TYPE_ERROR => 'Ошибки',
            self::TYPE_MESSAGE => 'Сообщения',
            self::TYPE_LOGS => 'Логи',
        ];
    }
}
