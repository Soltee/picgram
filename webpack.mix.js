const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
require('laravel-mix-purgecss');

mix.override((config) => {
    delete config.watchOptions;
});

mix.js("resources/js/app.js", "public/js").vue() 
    .postCss("resources/css/app.css", "public/css", [    
        require("tailwindcss"),
        require('autoprefixer'),
        tailwindcss('./tailwind.config.js')  
    ]);
