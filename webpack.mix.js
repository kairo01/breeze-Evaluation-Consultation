const mix = require('laravel-mix');

mix
  .postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
  ])
  .webpackConfig({
    resolve: {
      alias: {
        '@': path.resolve('resources/js'),
      },
    },
  });
