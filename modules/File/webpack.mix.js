const mix = require('laravel-mix');
const path = require("path");

let directory = path.basename(path.resolve(__dirname)).toLowerCase();
const assetsModuleDist = 'public/assets/modules/' + directory + '/';

mix.js(__dirname + '/Resources/assets/js/app.js', assetsModuleDist + 'js/file.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', assetsModuleDist + 'css/file.css');

if (mix.inProduction()) {
    mix.version();
}
