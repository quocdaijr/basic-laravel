<?php

use Modules\File\Constants\FileConstant;

return [
    'name' => 'File',
    'filesystem' => 'public',
    'allowed_extensions' => 'jpg,jpeg,png,gif,txt,docx,zip,mp3,bmp,csv,xls,xlsx,ppt,pptx,pdf,mp4,doc,wav',
    'mine_types' => [
        FileConstant::FILE_TYPE_IMAGE => [
            'image/png',
            'image/jpeg',
            'image/gif',
            'image/bmp',
        ],
        FileConstant::FILE_TYPE_VIDEO => [
            'video/mp4',
        ],
        FileConstant::FILE_TYPE_DOCUMENT => [
            'application/pdf',
            'application/vnd.ms-excel',
            'application/excel',
            'application/x-excel',
            'application/x-msexcel',
            'text/plain',
            'application/msword',
            'text/csv',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ],
        FileConstant::FILE_TYPE_OTHER => []
    ]
];
