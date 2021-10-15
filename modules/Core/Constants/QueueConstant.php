<?php

namespace Modules\Core\Constants;

class QueueConstant
{
    public const QUEUE_DEFAULT = 'default';
    public const QUEUE_MAIL = 'queue.mail';
    public const QUEUE_RESIZE_IMAGE = 'queue.resize.image';
    public const QUEUE_ES_POST = 'queue.es.post';

    public static function allQueues() {
        return [
            self::QUEUE_DEFAULT,
            self::QUEUE_MAIL,
            self::QUEUE_RESIZE_IMAGE,
            self::QUEUE_ES_POST,
        ];
    }

}
