import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

require('./bootstrap');
window.Vue = require('vue');
Vue.use(VueSweetalert2);

window.noty = function(notification) {
    window.events.$emit('notification', notification)
}

window.handleErrors = function(error) {
	if(error.response.status == 422) {
 		window.noty({
			message: 'You had validation errors. Please try again.',
			type: 'danger'
		})
 	}

 	window.noty({
		message: 'Something went wrong . Please refresh the page.',
		type: 'danger'
	})
}

Vue.component('sections', require('./components/Sections.vue').default);
Vue.component('lectures', require('./components/Lectures.vue').default);
Vue.component('attachments', require('./components/Attachments.vue').default);
Vue.component('ratings', require('./components/Ratings.vue').default);
Vue.component('ratingstwo', require('./components/RatingsTwo.vue').default);
Vue.component('ratingsthree', require('./components/RatingsThree.vue').default);
Vue.component('favourites', require('./components/Favourites.vue').default);
Vue.component('player', require('./components/Player.vue').default);
Vue.component('stripe', require('./components/Stripe.vue').default);
Vue.component('update-card', require('./components/UpdateCard.vue').default);


import StarRating from 'vue-star-rating'
Vue.component('star-rating', StarRating);


const app = new Vue({
    el: '#app',
});
