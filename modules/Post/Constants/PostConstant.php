<?php

namespace Modules\Post\Constants;

class PostConstant
{
    public const ACTION_SAVE = 'save';
    public const ACTION_PUBLISH = 'publish';
    public const ACTION_DELETE = 'delete';
    public const ACTION_RESTORE = 'restore';

    public const STATUS_PUBLISHED = 10;
    public const STATUS_DRAFT = 20;
    public const STATUS_TRASH = 30;

    public const POST_HAS_FILE_TYPE_RESOURCE = 1;
    public const POST_HAS_FILE_TYPE_COVER = 2;
    public const POST_HAS_FILE_TYPE_THUMBNAIL = 3;

    public static function getStatusByAction($action, $old_status = null) {
        return match ($action) {
            self::ACTION_PUBLISH => self::STATUS_PUBLISHED,
            self::ACTION_DELETE => self::STATUS_TRASH,
            self::ACTION_RESTORE => self::STATUS_DRAFT,
            default => $old_status ?? self::STATUS_DRAFT,
        };
    }

    public static function statuses()
    {
        return [
            self::STATUS_PUBLISHED => 'published',
            self::STATUS_DRAFT => 'draft',
            self::STATUS_TRASH => 'trash',
        ];
    }

    public static function htmlStatuses()
    {
        return [
            self::STATUS_PUBLISHED => '<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Published</span>',
            self::STATUS_DRAFT => '<span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-100">Draft</span>',
            self::STATUS_TRASH => '<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Trash</span>',
        ];
    }

    public static function getHtmlStatus($status)
    {
        return self::htmlStatuses()[$status] ?? '<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Undefined</span>';
    }
}
