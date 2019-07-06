const mix = require('laravel-mix');

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

mix.sass('resources/sass/company/common/index.scss', 'public/css/company/common')
   .sass('resources/sass/auth/login/index.scss', 'public/css/auth/login')
   
   // company
   .sass('resources/sass/company/task/index.scss', 'public/css/company/task')
   .sass('resources/sass/company/task/create.scss', 'public/css/company/task')
   .sass('resources/sass/company/task/show.scss', 'public/css/company/task')
   .sass('resources/sass/company/partner/index.scss', 'public/css/company/partner')
   .sass('resources/sass/company/partner/show.scss', 'public/css/company/partner')
   .sass('resources/sass/company/partnerMail/index.scss', 'public/css/company/partnerMail')

   // partner
   .sass('resources/sass/partner/dashboard/index.scss', 'public/css/partner/dashboard')
   .sass('resources/sass/partner/setting/invoice/index.scss', 'public/css/partner/setting/invoice');

mix.options({
   publicPath: 'public'
});
