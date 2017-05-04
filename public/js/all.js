$( document ).ready(function() {
    var location = window.location.pathname;
    $('.nav-item').each(function(){
        console.log($(this).attr('href'));
        console.log(location);
        if ($(this).attr('href') == location) {
            $(this).addClass('is-active');
        } else if ($(this).attr('href') != location && $(this).hasClass('is-active')){
            $(this).removeClass('is-active');
        };
    })
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

//# sourceMappingURL=all.js.map
