let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')

    //to bad mix is not support for multiple compile at this time we need to
    //map each file manually and we can't create portal file for include scss
    //we just need only related file in that page
   .sass('resources/assets/sass/views/loan/form.scss', 'public/css/views/loan')
   ;

mix.browserSync('localhost:8000');
