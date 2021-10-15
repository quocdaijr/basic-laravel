<?php

namespace Modules\File\Jobs;

use Modules\Core\Constants\QueueConstant;
use Modules\Core\Jobs\CoreJob;
use Modules\File\Services\FileService;

class ResizeImage extends CoreJob
{
    public $queue = QueueConstant::QUEUE_RESIZE_IMAGE;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected $path,
    )
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FileService $fileService)
    {
        if (!empty($this->path)) {
            $resize = $fileService->resize($this->path);
            if ($resize)
                $this->writeMessage("Resize for path $this->path is success");
            else
                $this->writeError("Resize for path $this->path is success");
        } else {
            $this->writeError("Path $this->path is invalid");
        }
    }
}
