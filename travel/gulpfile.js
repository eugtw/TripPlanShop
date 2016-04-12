var elixir = require('laravel-elixir');

var bowerDir = './resources/assets/bower_dl/';


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix

        .stylesIn("resources/assets/css", null, "public/css/all.css")
        .sass('app.scss');

});
