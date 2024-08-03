const mix = require('laravel-mix');
const path = require('path');

let directory = path.basename(path.resolve(__dirname)).toLowerCase();
const assetsDist = 'public/assets/'
const assetsModuleDist = assetsDist + 'modules/' + directory + '/';
const assetsNodeModuleDist = assetsDist + 'node_modules/';

mix.js(__dirname + '/Resources/assets/js/core.js', assetsModuleDist + 'js/core.js')
    .js(__dirname + '/Resources/assets/js/bootstrap.js', assetsModuleDist + 'js/bootstrap.js')
    .js(__dirname + '/Resources/assets/js/init.js', assetsModuleDist + 'js/init.js')
    .js(__dirname + '/Resources/assets/js/sweetalert.js', assetsModuleDist + 'js/sweetalert.js')
    .js(__dirname + '/Resources/assets/js/toastr.js', assetsModuleDist + 'js/toastr.js')
    // .js(__dirname + '/Resources/assets/js/ck-editor.js', assetsModuleDist + 'js/ck-editor.js')
    .js(__dirname + '/Resources/assets/js/slim-select.js', assetsModuleDist + 'js/slim-select.js')
    .js(__dirname + '/Resources/assets/js/flatpickr.js', assetsModuleDist + 'js/flatpickr.js')
    .js(__dirname + '/Resources/assets/js/forms/multiple-select.js', assetsModuleDist + 'js/forms/multiple-select.js')
    .postCss(__dirname + '/Resources/assets/css/flatpickr.css', assetsModuleDist + 'css/flatpickr.css')
    .postCss(__dirname + '/Resources/assets/css/core.css', assetsModuleDist + 'css/core.css', [
        require('postcss-import'),
        require('tailwindcss')
    ])
    .sass(__dirname + '/Resources/assets/sass/sweetalert-theme.scss', assetsModuleDist + 'css/sweetalert-theme.css')
    .sass(__dirname + '/Resources/assets/sass/toastr.scss', assetsModuleDist + 'css/toastr.css')
    .sass(__dirname + '/Resources/assets/sass/slim-select.scss', assetsModuleDist + 'css/slim-select.css')
    .copyDirectory(__dirname + '/Resources/images', assetsModuleDist + 'images')
;

// tinyMCE editor
mix.copyDirectory('node_modules/tinymce/icons', assetsNodeModuleDist + 'tinymce/icons');
mix.copyDirectory('node_modules/tinymce/plugins', assetsNodeModuleDist + 'tinymce/plugins');
mix.copyDirectory('node_modules/tinymce/skins', assetsNodeModuleDist + 'tinymce/skins');
mix.copyDirectory('node_modules/tinymce/themes', assetsNodeModuleDist + 'tinymce/themes');
// mix.copy('node_modules/tinymce/jquery.tinymce.js', assetsNodeModuleDist + 'tinymce/jquery.tinymce.js');
// mix.copy('node_modules/tinymce/jquery.tinymce.min.js', assetsNodeModuleDist + 'tinymce/jquery.tinymce.min.js');
mix.copy('node_modules/tinymce/tinymce.js', assetsNodeModuleDist + 'tinymce/tinymce.js');
mix.copy('node_modules/tinymce/tinymce.min.js', assetsNodeModuleDist + 'tinymce/tinymce.min.js');

mix.copy('node_modules/prismjs/themes/prism-tomorrow.css', assetsNodeModuleDist + 'prismjs/themes/prism-tomorrow.css');
mix.copy('node_modules/prismjs/prism.js', assetsNodeModuleDist + 'prismjs/prism.js');


if (mix.inProduction()) {
    mix.version();
}
