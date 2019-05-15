const mix = require('laravel-mix');

mix.options({
   processCssUrls: false
});
if(mix.inProduction()){
   mix.version();
}
else{
   mix.sourceMaps();
}
mix.browserSync({
   open: "external",
   online: true,
   proxy: "localhost/" + __dirname.split("www")[1] + "/public"

});
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

mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/sass/app.scss', 'public/css');

mix.sass('resources/sass/admin.scss', 'public/css');
mix.js('resources/js/admin.js', 'public/js').version();
mix.less('resources/less/admin-core.less', 'public/css'); 
