<?php

namespace Modules\File\Constants;

class FileConstant
{
    public const FILE_TYPE_IMAGE = 'image';
    public const FILE_TYPE_VIDEO = 'video';
    public const FILE_TYPE_DOCUMENT = 'document';
    public const FILE_TYPE_OTHER = 'other';

    public static function typeFiles()
    {
        return [
            self::FILE_TYPE_IMAGE => __('Image'),
            self::FILE_TYPE_VIDEO => __('Video'),
            self::FILE_TYPE_DOCUMENT => __('Document'),
            self::FILE_TYPE_OTHER => __('Other'),
        ];
    }

    public static function htmlOptionFileType($default = '')
    {
        return '
        <option value=></option>
        <option value="' . self::FILE_TYPE_IMAGE . '" ' . ($default == self::FILE_TYPE_IMAGE ? 'selected' : '') . '>Image</option>
        <option value="' . self::FILE_TYPE_VIDEO . '" ' . ($default == self::FILE_TYPE_VIDEO ? 'selected' : '') . '>Video</option>
        <option value="' . self::FILE_TYPE_DOCUMENT . '" ' . ($default == self::FILE_TYPE_DOCUMENT ? 'selected' : '') . '>Document</option>
        <option value="' . self::FILE_TYPE_OTHER . '" ' . ($default == self::FILE_TYPE_OTHER ? 'selected' : '') . '>Other</option>
        ';
    }
}
