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

mix.sass('src/sass/app.scss', 'dist/app.css')
    .js('src/js/app.js', 'xampp/htdocs/workspace/penangpropertyangel/dist/')
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'dist/webfonts')
    .postCss('src/css/index.css', 'dist/index.css')
    .js('src/js/index.js', 'xampp/htdocs/workspace/penangpropertyangel/dist/index.js');

