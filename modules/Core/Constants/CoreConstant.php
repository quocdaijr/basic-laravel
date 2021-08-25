<?php

namespace Modules\Core\Constants;

class CoreConstant
{
    public const STATUS_ACTIVE = 10;
    public const STATUS_DISABLE = 20;
    public const STATUS_DELETED = 30;

    public const LAYOUT_PC = 'pc';
    public const LAYOUT_MOBILE = 'mobile';

    public static function statuses()
    {
        return [
            self::STATUS_ACTIVE => 'active',
            self::STATUS_DISABLE => 'disable',
            self::STATUS_DELETED => 'delete',
        ];
    }

    public static function htmlStatuses()
    {
        return [
            self::STATUS_ACTIVE => '<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Active</span>',
            self::STATUS_DISABLE => '<span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-100">Disable</span>',
            self::STATUS_DELETED => '<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Deleted</span>',
        ];
    }

    public static function htmlOptionStatuses($default = '')
    {
        return '
        <option value=>Không</option>
        <option value="' . self::STATUS_ACTIVE . '" ' . ($default == self::STATUS_ACTIVE ? 'selected' : '') . '>Active</option>
        <option value="' . self::STATUS_DISABLE . '" ' . ($default == self::STATUS_DISABLE ? 'selected' : '') . '>Disable</option>
        <option value="' . self::STATUS_DELETED . '" ' . ($default == self::STATUS_DELETED ? 'selected' : '') . '>Deleted</option>
        ';
    }

    public static function getHtmlStatus($status)
    {
        return self::htmlStatuses()[$status] ?? '<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Không rõ</span>';
    }
}
