const mix = require('laravel-mix');

mix.setPublicPath('public')
    .js('assets/js/app.js', 'js')
    .sass('assets/sass/app.scss', 'css')
    .version();
