<?php

namespace Modules\File\Services;

use Auth;
use File;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\UploadedFile;
use Modules\Core\Constants\CoreConstant;
use Modules\File\Repositories\Interfaces\FileRepositoryInterface;
use Str;

class FileService
{
    public function __construct(
        protected Factory                 $filesystem,
        protected FileRepositoryInterface $fileRepository
    )
    {
    }

    public function store(UploadedFile $file)
    {
        $path = date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d') .
            DIRECTORY_SEPARATOR . Str::slug(File::name($file->getClientOriginalName())) .
            '-' . time() . '.' . $file->getClientOriginalExtension();

        $stream = fopen($file->getRealPath(), 'r+');
        $saveFile = $this->filesystem->disk($this->getConfigFilesystem())->writeStream($path, $stream, [
            'visibility' => 'public',
            'mimetype' => $file->getMimeType(),
        ]);

        if ($saveFile) {
            $data = [
                'name' => $file->getClientOriginalName(),
                'title' => File::name($file->getClientOriginalName()),
                'status' => CoreConstant::STATUS_ACTIVE,
                'raw_path' => $this->filesystem->disk($this->getConfigFilesystem())->getDriver()->getAdapter()->getPathPrefix() . $path,
                'path' => $path,
                'where' => $this->getConfigFilesystem(),
                'mine_type' => $file->getMimeType(),
                'type' => $this->getTypeByMineType($file->getMimeType()),
                'size' => $file->getSize(),
                'mtime' => $file->getMTime(),
                'created_by' => Auth::id()
            ];
            $dbFile = $this->fileRepository->create($data);
        }
        return $dbFile ?? null;
    }

    public function getConfigFilesystem()
    {
        return config('filesystems.default');
    }

    public function getTypeByMineType($mine_type) {
        $mine_types = config(CoreConstant::MODULE_NAME . '.file.config.mine_types');
        $type = 'other';
        foreach ($mine_types as $key => $value) {
            if (in_array($mine_type, $value)) {
                $type = $key;
                break;
            }
        }
        return $type;
    }
}
