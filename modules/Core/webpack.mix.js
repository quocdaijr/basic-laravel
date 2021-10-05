const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
const path = require('path');
let directory = path.basename(path.resolve(__dirname)).toLowerCase();

const publicDist = 'public/modules/' + directory + '/';

mix.js(__dirname + '/Resources/assets/js/core.js', publicDist + 'js/core.js')
    .js(__dirname + '/Resources/assets/js/bootstrap.js', publicDist + 'js/bootstrap.js')
    .js(__dirname + '/Resources/assets/js/init.js', publicDist + 'js/init.js')
    .js(__dirname + '/Resources/assets/js/sweetalert.js', publicDist + 'js/sweetalert.js')
    .js(__dirname + '/Resources/assets/js/toastr.js', publicDist + 'js/toastr.js')
    // .js(__dirname + '/Resources/assets/js/ck-editor.js', publicDist + 'js/ck-editor.js')
    .js(__dirname + '/Resources/assets/js/slim-select.js', publicDist + 'js/slim-select.js')
    .js(__dirname + '/Resources/assets/js/flatpickr.js', publicDist + 'js/flatpickr.js')
    .js(__dirname + '/Resources/assets/js/forms/multiple-select.js', publicDist + 'js/forms/multiple-select.js')
    .postCss(__dirname + '/Resources/assets/css/flatpickr.css', publicDist + 'css/flatpickr.css')
    .postCss(__dirname + '/Resources/assets/css/core.css', publicDist + 'css/core.css', [
        require('postcss-import'),
        require('tailwindcss')
    ])
    .sass(__dirname + '/Resources/assets/sass/sweetalert-theme.scss', publicDist + 'css/sweetalert-theme.css')
    .sass(__dirname + '/Resources/assets/sass/toastr.scss', publicDist + 'css/toastr.css')
    .sass(__dirname + '/Resources/assets/sass/slim-select.scss', publicDist + 'css/slim-select.css')
    .copyDirectory(__dirname + '/Resources/images', publicDist + 'images')
;

// tinyMCE editor
mix.copyDirectory('node_modules/tinymce/icons', 'public/node_modules/tinymce/icons');
mix.copyDirectory('node_modules/tinymce/plugins', 'public/node_modules/tinymce/plugins');
mix.copyDirectory('node_modules/tinymce/skins', 'public/node_modules/tinymce/skins');
mix.copyDirectory('node_modules/tinymce/themes', 'public/node_modules/tinymce/themes');
mix.copy('node_modules/tinymce/jquery.tinymce.js', 'public/node_modules/tinymce/jquery.tinymce.js');
mix.copy('node_modules/tinymce/jquery.tinymce.min.js', 'public/node_modules/tinymce/jquery.tinymce.min.js');
mix.copy('node_modules/tinymce/tinymce.js', 'public/node_modules/tinymce/tinymce.js');
mix.copy('node_modules/tinymce/tinymce.min.js', 'public/node_modules/tinymce/tinymce.min.js');

mix.copyDirectory('node_modules/prismjs/themes', 'public/node_modules/prismjs/themes');
mix.copy('node_modules/prismjs/prism.js', 'public/node_modules/prismjs/prism.js');


if (mix.inProduction()) {
    mix.version();
}
