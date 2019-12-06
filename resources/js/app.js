import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

require('./bootstrap');
window.Vue = require('vue');
Vue.use(VueSweetalert2);

Vue.component('sections', require('./components/Sections.vue').default);
Vue.component('lectures', require('./components/Lectures.vue').default);
Vue.component('attachments', require('./components/Attachments.vue').default);
Vue.component('ratings', require('./components/Ratings.vue').default);
Vue.component('favourites', require('./components/Favourites.vue').default);
Vue.component('player', require('./components/Player.vue').default);


import StarRating from 'vue-star-rating'
Vue.component('star-rating', StarRating);


const app = new Vue({
    el: '#app',
});
