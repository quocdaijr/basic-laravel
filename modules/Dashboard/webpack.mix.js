const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
const path = require("path");

let directory = path.basename(path.resolve(__dirname)).toLowerCase();

const publicDist = 'public/modules/' + directory + '/';

mix.js(__dirname + '/Resources/assets/js/app.js', publicDist + 'js/dashboard.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', publicDist + 'css/dashboard.css');

if (mix.inProduction()) {
    mix.version();
}
