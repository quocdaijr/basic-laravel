<?php

namespace Modules\File\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Factory;
use Modules\Core\Constants\CoreConstant;
use Modules\File\Constants\FileConstant;
use Modules\File\Jobs\ResizeImage;
use Modules\File\Repositories\Interfaces\FileRepositoryInterface;
use Storage;

class SyncFilesCommand extends Command
{
    protected $signature = 'module:file:sync-files {from} {to}';

    protected $description = 'Command sync files';

    public function __construct(
        protected FileRepositoryInterface $fileRepository,
        protected Factory                 $filesystem,
    )
    {
        parent::__construct();
    }

    public function arguments()
    {
    }

    public function handle()
    {
        $files = $this->fileRepository->getByAttributes(['status' => CoreConstant::STATUS_ACTIVE]);
        $from = $this->argument('from');
        $to = $this->argument('to');
        $diskFrom = $this->filesystem->disk($from);
        $diskTo = $this->filesystem->disk($to);
        foreach ($files as $file) {
            if ($diskFrom->exists($file->path)) {
                $fileData = $diskFrom->get($file->path);
                $save = $diskTo->put($file->path, $fileData, [
                    'visibility' => 'public',
                    'mimetype' => $file->mimetype,
                ]);
                if ($save) {
                    if ($file->type === FileConstant::FILE_TYPE_IMAGE) {
                        dispatch(new ResizeImage($file->path));
                        $this->info("[S] Send queue resize image success with id: $file->id and path: $file->path");
                    }
                    $this->info("[S] Sync file from $from to $to success with id: $file->id and path $file->path");
                } else {
                    $this->error("[S] Sync file from $from to $to failed with id: $file->id and path $file->path");
                }
            } else {
                $this->warn("[W] File from $from is not found with id: $file->id and path $file->path");
            }
        }
    }
}
