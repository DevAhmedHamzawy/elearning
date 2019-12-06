<template>
    <div>
        <button class="btn btn-success" @click="subscribe('Monthly')">Subscribe to $9.99 Monthly</button>
        <button class="btn btn-info" @click="subscribe('Yearly')"> Subscribe to $99.9 Yearly</button>
    </div>
</template>

<script>
import Axios from 'axios'
export default {
    props: ['email'],
    mounted() {
        this.handler = StripeCheckout.configure({
            key: 'pk_test_2VnQL9Cic4hLPeiYtvHellBI',
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
            locale: 'auto',
            token(token) {
                //Vue.$swal({ text: 'Please wait while we subscribe you to a plan ...', buttons: false });
                Axios.post('/subscribe', {
                    paymentMethod: token.id,
                    plan: window.stripePlan
                }).then(resp => {
                    /*Vue.$swal({ text: 'Successfully subscribed', icon: 'success' })
                        .then(() => {
                            window.location = '';
                        });
                    */
                   window.location = '';
                })
            }
        }) 
    },
    data() {
        return {
            plan: '',
            amount: 0,
            trial: 0,
            handler: null
        }
    },
    methods: {
        subscribe(plan) {
            if(plan == 'Monthly') {
                window.stripePlan = 'plan_G3vHvztFakBPl7'
                this.amount = 999
                this.trial = 30
            } else {
                window.stripePlan = 'prod_BV76gJHBzAsS8j'
                this.amount = 9999
                this.trial = 365
            }

            this.handler.open({
                name: 'Bahdcasts',
                description: 'Bahdcasts Subscription',
                amount: this.amount,
                email: this.email
            })
        }
    }
}
</script>
