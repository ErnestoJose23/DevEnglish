const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.scripts([
    'resources/assets/js/app.js',
 ], 'public/js/app.js');

 mix.styles([
    'resources/assets/css/font-awesome.min5152.css',
    'resources/assets/css/style5152.css',
    'resources/assets/css/style.css',
 ], 'public/css/app.css');

 mix.scripts([
    'resources/assets/js/sb-admin-2.js',
], 'public/js/admin.js');

 mix.styles([
    'resources/assets/css/sb-admin-2.css',
 ], 'public/css/admin.css');
 
 
 /*
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');*/