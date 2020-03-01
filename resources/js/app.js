/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import {URL_BASE} from "./models/helper";
import TDate from './boot-vue-functions'

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize
 * the JavaScript scaffolding to fit your unique needs.
 */

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('link-destroy-component', require('./components/LinkDestroyComponent').default);

// Vue.component('select2-vue-component', require('./components/Select2VueComponent').default);

Vue.prototype.URL_BASE = URL_BASE;

const app = new Vue({
    el: '#app',
    methods: {
        dateFormatUS: TDate.dateUS,
    }
});

$('#app').tooltip({
    //selector: '[data-toggle="tooltip"]'
    //selector: "[data-tooltip=tooltip]",
});
