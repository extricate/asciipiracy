
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

/**
 * Dropdown replace with value and name
 * created for use in the trade page
 */

$(".dropdown-menu a").click(function(){
    var oldText = $(this).parents('.input-group').find('.dropdown-toggle').text();
    var selText = $(this).text();
    $(this).text(oldText);
    $(this).parents('.input-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
    $(this).parents('form').find('.trade-action').val(selText);
});