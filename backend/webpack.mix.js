const mix = require('laravel-mix');
// const glob = require('glob');

// glob.sync('resources/js/*.js').map(function(file){
//     mix.js(file, 'public.js').version()
// });

// glob.sync('resources/sass/*.scss').map(function(file){
//     mix.sass(file,'public/css').version();
// })

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/sell.js','public/js')
    .js('resources/js/detail.js','public/js')
    .js('resources/js/search.js','public/js')
    .js('resources/js/layout.js','public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/styles.scss','public/css')
    .sourceMaps()
    .autoload({
        "jquery": ['$', 'window.jQuery'],
    }) ;
