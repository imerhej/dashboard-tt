
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueClipboard from 'vue-clipboard2'

Vue.use(VueClipboard)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));


// const app = new Vue({
//     el: '#app'
// });

$(document).ready(function($){
    $('#phone_number').mask("(999) 999-9999", {placeholder:"(___) ___-____"});
  });

  $(".delete").on("submit", function(){
     return confirm("Do you want to delete this Account?");
  });

  $(".pdelete").on("submit", function(){
     return confirm("Do you want to permanently delete this Account?");
 });

 $(".job_delete").on("submit", function(){
    return confirm("Do you want to delete this Job?");
});
$(".jobdelete").on("submit", function(){
   return confirm("Do you want to permanently delete this Job?");
});

 $(".restore").on("submit", function(){
    return confirm("Do you want to restore this Account?");
  });
  $(".jobrestore").on("submit", function(){
     return confirm("Do you want to restore this Job?");
   });
