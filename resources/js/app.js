require('./bootstrap');
window.Vue = require('vue');

Vue.config.ignoredElements = ['video-js']
Vue.component('sections', require('./components/Sections.vue').default);
Vue.component('lectures', require('./components/Lectures.vue').default);
Vue.component('attachments', require('./components/Attachments.vue').default);
Vue.component('ratings', require('./components/Ratings.vue').default);


import StarRating from 'vue-star-rating'
Vue.component('star-rating', StarRating);


const app = new Vue({
    el: '#app',
});
