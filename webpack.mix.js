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


mix.js([
   'node_modules/jquery/dist/jquery.min.js',
   'node_modules/bootstrap/dist/js/bootstrap.js',
   'resources/assets/js/app.js'], 'public/js');
mix.sass('resources/assets/sass/app.scss', 'public/css');
//    .sass('resources/assets/sass/admin.scss', 'public/css/admin'); /* If you want to make admin css file. */
// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
mix.copy('node_modules/admin-lte/dist/img', 'public/img');
mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

