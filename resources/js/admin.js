
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

var pace = require('./admin/pace');
pace.start();

/**
 *
 */
require('./admin/blockui');
require('./admin/select2');
require('./admin/uniform');
require('./admin/sweet_alert');
require('./admin/datatables');
require('./admin/datepicker');
require('./admin/fancybox');
require('./admin/natural_sort');
require('./admin/moment');
require('./admin/daterangepicker');
d3 = require('d3');
d3.tip = require('d3-tip');
require('./admin/multiselect');
require('./admin/dashboard');
require('./admin/app');




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('comment-manager', require('./components/admin/comment-manager.vue'));
//Vue.component('video-form', require('./components/admin/video-form.vue'));


// const app = new Vue({
//     el: '#app'
// });

