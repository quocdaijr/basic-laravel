<?php
if (!function_exists('getUrlFile')) {
    function getUrlFile($path, $allowNoImage = true): ?string
    {
        if (!empty($path)) {
            return \Storage::disk(config('filesystems.default'))->url($path);
        } else {
            return $allowNoImage ? \Storage::disk(config('filesystems.default'))->url('no-image.jpg') : null;
        }
    }
}
