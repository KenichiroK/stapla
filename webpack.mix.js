const mix = require("laravel-mix");

mix.autoload({
  jquery: ["$", "window.jQuery"],
});

mix.webpackConfig({
  resolve: {
    extensions: [".js"],
    alias: {
      "@": __dirname + "/resources/js",
    },
  },
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

// HACK: appから分離する
// mix.js(
//   [
//     // 共通

//     //company

//     //partner
//   ],
//   "public/js/app.js",
// );

mix.babel(["resources/js/partner/document/invoice/create.js"], "public/js/partner/document/invoice/create.js");

mix.js(["resources/js/pages/owner/registration/gym_closing_hours/create.js"], "public/js/pages/owner/registration/gym_closing_hours/create.js");


mix.options({
  publicPath: "public",
});
