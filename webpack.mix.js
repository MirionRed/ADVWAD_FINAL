let mix = require('laravel-mix');
mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.js([
  'resources/assets/js/division.js',
  //'resources/assets/js/practical7.js',
], 'public/js/all.js');
