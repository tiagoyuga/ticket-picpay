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

mix.js('resources/js/app.js', 'public/js/app.js')
    .extract(['jquery', 'bootstrap', 'toastr'])
    .sourceMaps();

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/toastr/build/toastr.css',
], 'public/css/app.css')
    .sourceMaps();

mix.styles([
    'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css',
], 'public/css/datepicker.css');

mix.styles([
    'resources/inspinia/font-awesome/css/font-awesome.css',
    'resources/inspinia/animate.css',
    'resources/inspinia/style.css',
    'resources/inspinia/custom.css',
], 'public/css/theme.css')
    .sourceMaps();

mix.copy('resources/inspinia/font-awesome/fonts', 'public/fonts');

// datetimepicker
mix.scripts([
    'node_modules/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js'
], 'public/js/custom-datetimepicker.js')
    .styles([
        'node_modules/eonasdan-bootstrap-datetimepicker/src/sass/bootstrap-datetimepicker-build.scss',
    ], 'public/css/custom-datetimepicker.css');

// jquery.mask
mix.scripts([
    'node_modules/jquery-mask-plugin/src/jquery.mask.js',
    'resources/js/jquery.maskMoney.min.js',
    'resources/js/boot-jquery.mask.js',
], 'public/js/custom-masks.js');

// moment
mix.scripts([
    'node_modules/moment/min/moment.min.js',
], 'public/js/moment.js');

// bootstrap-datepicker
mix.scripts([
    'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
    'node_modules/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js',
    'resources/js/boot-datepicker.js',
], 'public/js/custom-datepicker.js');

// select2
mix.scripts([
    'node_modules/select2/dist/js/select2.full.js',
    'resources/js/boot-select2.js',
], 'public/js/custom-select2.js')
    .styles([
        'node_modules/select2/dist/css/select2.css',
        'node_modules/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css',
    ], 'public/css/select2.css');

mix.scripts([
    'node_modules/jquery-blockui/jquery.blockUI.js',
    'resources/js/boot-functions.js',
    'resources/js/jquery.metisMenu.js',
    'resources/js/inspinia.js',
], 'public/js/functions.js')
    .sourceMaps();

//jeditable
mix.scripts([
    'resources/js/jeditable.js',
], 'public/js/jeditable.js');


//highcharts
mix.scripts([
    'resources/js/highcharts/highcharts.js',
    'resources/js/highcharts/highcharts-data.js',
    'resources/js/highcharts/highcharts-export-data.js',
    'resources/js/highcharts/highcharts-exporting.js',
], 'public/js/highcharts.js').version();


mix.scripts([
    'resources/inspinia/js/jquery-3.1.1.min.js',
    'resources/inspinia/js/popper.min.js',
    'resources/inspinia/js/bootstrap.js',
    'resources/inspinia/js/plugins/metisMenu/jquery.metisMenu.js',
    'resources/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js',
    'resources/inspinia/js/plugins/steps/jquery.steps.min.js',
    'resources/inspinia/js/plugins/validate/jquery.validate.min.js',
], 'public/js/inspina_register_dev.js').version();

mix.styles([
    'resources/inspinia/css/bootstrap.min.css',
    'resources/inspinia/font-awesome/css/font-awesome.css',
    'resources/inspinia/css/plugins/iCheck/custom.css',
    'resources/inspinia/css/plugins/steps/jquery.steps.css',
    'resources/inspinia/css/animate.css',
    'resources/inspinia/css/style.css',
], 'public/css/inspina_theme_register_dev.css')
    .sourceMaps();



