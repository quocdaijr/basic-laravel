const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname)).toLowerCase();

const publicDist = 'public/modules/' + directory + '/';

mix.js(__dirname + '/Resources/assets/js/app.js', publicDist + 'js/administration.js')
    .sass( __dirname + '/Resources/assets/sass/app.scss', publicDist + 'css/administration.css')
    .copyDirectory(__dirname + '/Resources/images', publicDist + 'images')
;

if (mix.inProduction()) {
    mix.version();
}
