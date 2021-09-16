const mix = require('laravel-mix');
const glob = require('glob');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         require('postcss-import'),
//         require('tailwindcss'),
//     ]);

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app-test.scss', 'public/css');
glob.sync('resources/assets/sass/*.scss').map(function(file) {
    mix.sass(file, 'public/assets/css');
  });

if (mix.inProduction()) {
    mix.version();
}

glob.sync('resources/js/*.js').map(function (file) {
    mix.js(file, 'public/assets/js')
  });