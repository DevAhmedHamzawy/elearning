<template>
    <button @click="toggleFavourite" class="btn btn-danger">
        {{ owner ? '' : favourite ? 'Unfavourite' : 'Favourite' }} {{ count }} {{ owner ? 'Favourites' : '' }}
    </button>
</template>

<script>
import numeral from 'numeral'

export default {
    props: {
        course: {
            type: Object,
            required: true,
            default: () => ({})
        },
        initialFavourites: {
            type: Array,
            required: true,
            default: () => []
        }
    },

    data: function () {
        return { 
            favourites: this.initialFavourites
        }
    },

    computed: {
        favourite() {
            if (! __auth() || this.course.user_id === __auth().id) return false

            return !!this.favouriting
        },

        owner() {
            if (__auth() && this.course.user_id === __auth().id) return true

            return false
        },

        favouriting() {
            if (! __auth()) return null

            return this.favourites.find(favourite => favourite.user_id === __auth().id)
        },

        count() {
            return numeral(this.favourites.length).format('0a')
        }
    },
    methods: {
        toggleFavourite() {
            if (! __auth()) {
                return alert('Please login to Add To Favourite.')
            }

            /*if (this.owner) {
                return alert('You cannot favourite to your course.')
            }*/

            if (this.favourite) {
                axios.delete(`/courses/${this.course.slug}/favourites/${this.favourites.id}`)
                    .then(() => {
                        this.favourites = this.favourites.filter(s => s.id !== this.favourite.id)
                    })
            } else {
                axios.post(`/courses/${this.course.slug}/favourites`)
                    .then(response => {
                        this.favourites = [
                            ...this.favourites,
                            response.data
                        ]
                    })
            }
        }
    }
}
</script>