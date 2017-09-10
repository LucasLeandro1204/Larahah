const path = require('path');
const mix = require('laravel-mix');

mix.webpackConfig({
  resolve: {
    alias: {
      '@': path.resolve('resources/assets/sass'),
    },
  },
});

mix.js('resources/assets/js/app.js', 'public/build/js')
  .sass('resources/assets/sass/app.scss', 'public/build/css');

mix.browserSync({
  notify: false,
  injectChanges: false,
  proxy: 'larahah.dev',
  files: [
    'public/build/css/*',
    'public/build/js/*',
    'resources/views/**/*.php',
  ],
});
