<?php
if (!function_exists('adjustedHtmlContent')) {
    function adjustedHtmlContent(string $content): ?string
    {
        $content = preg_replace_callback('/(\<img.*?src\=\")(.*?)(\".*?\>)/m', function ($matches) {
            return $matches[1] . getUrlFile(ltrim(parse_url($matches[2])['path'] ?? '', '/')) . $matches[3];
        }, $content);

        $content = preg_replace_callback('/(\<source.*?[src|srcset]\=\")(.*?)(".*?\>)/m', function ($matches) {
            return $matches[1] . getUrlFile(ltrim(parse_url($matches[2])['path'] ?? '', '/')) . $matches[3];
        }, $content);


        return $content;
    }
}
