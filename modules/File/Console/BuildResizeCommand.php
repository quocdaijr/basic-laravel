<?php

namespace Modules\File\Console;

use Illuminate\Console\Command;
use Modules\Core\Constants\CoreConstant;
use Modules\File\Constants\FileConstant;
use Modules\File\Jobs\ResizeImage;
use Modules\File\Repositories\Interfaces\FileRepositoryInterface;

class BuildResizeCommand extends Command
{
    protected $signature = 'module:file:build-resize';

    protected $description = 'Command build resize for File';

    public function __construct(
        protected FileRepositoryInterface $fileRepository
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        $files = $this->fileRepository->getByAttributes(['status' => CoreConstant::STATUS_ACTIVE, 'type' => FileConstant::FILE_TYPE_IMAGE]);
        foreach ($files as $file) {
            dispatch(new ResizeImage($file->path));
            $this->info("[S] Send queue resize image success with id: $file->id and path: $file->path");
        }
    }
}
