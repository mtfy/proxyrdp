let mix = require('laravel-mix');

mix.js('./resources/js/app.js', 'public/__Motify/js')
	.postCss('./resources/css/app.css', 'public/__Motify/css', [
        require('tailwindcss'),
    ])
	.vue();