<?php

namespace Modules\File\Http\Controllers\Api;

use File;
use Illuminate\Contracts\Filesystem\Factory;
use Image;
use Modules\File\Services\FileService;

class ResizeController
{
    private $disk;

    public function __construct(
        public FileService $fileService,
        public Factory     $filesystem
    )
    {
        $this->disk = $this->filesystem->disk(config('filesystems.default'));
    }

    public function fly($size, $imagePath)
    {
        if (!$this->disk->exists($imagePath)) {
            abort(404);
        }

        print_r(getimagesize($this->disk->path($imagePath)));exit();

        $resizedPath = 'i/' . $size . '/' . $imagePath;

//        if ($this->disk->exists($resizedPath))
//            return Image::make($this->disk->path($resizedPath))->response();

        $savedDir = dirname($resizedPath);
        if (!$this->disk->exists($savedDir)) {
            $this->disk->makeDirectory($savedDir);
        }

        list($width, $height) = explode('x', strtolower($size));//$sizes[$size];

        $image = Image::make($this->disk->path($imagePath))->resize($width, $height);

        $this->disk->put($resizedPath, $image->encode(), [
            'visibility' => 'public',
            'mimetype' => $this->disk->mimeType($imagePath),
        ]);

        return $image->response();
    }
}
