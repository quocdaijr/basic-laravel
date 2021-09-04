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
    .js(__dirname + '/Resources/assets/js/ck-editor.js', publicDist + 'js/ck-editor.js')
    .js(__dirname + '/Resources/assets/js/slim-select.js', publicDist + 'js/slim-select.js')
    .js(__dirname + '/Resources/assets/js/forms/multiple-select.js', publicDist + 'js/forms/multiple-select.js')
    .js(__dirname + '/Resources/assets/js/forms/upload-and-preview.js', publicDist + 'js/forms/upload-and-preview.js')
    .postCss(__dirname + '/Resources/assets/css/core.css', publicDist + 'css/core.css', [
        require('postcss-import'),
        require('tailwindcss')
    ])
    .sass(__dirname + '/Resources/assets/sass/sweetalert-theme.scss', publicDist + 'css/sweetalert-theme.css')
    .sass(__dirname + '/Resources/assets/sass/slim-select.scss', publicDist + 'css/slim-select.css')
    .copyDirectory(__dirname + '/Resources/images', publicDist + 'images')
;

if (mix.inProduction()) {
    mix.version();
}
