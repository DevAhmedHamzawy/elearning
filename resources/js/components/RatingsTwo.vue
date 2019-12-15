<template>
  <div>
   
<!-- Modal -->
<div class="modal fade" id="addRating" tabindex="-1" role="dialog" aria-labelledby="addRatingLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 v-if="this.edit === false" class="modal-title" id="addRatingLabel">New Rating</h5>
        <h5 v-else class="modal-title" id="addRatingLabel">Edit Rating</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
    <form @submit.prevent="addRating" class="mb-3">
       <div class="single-input">
       <star-rating v-model="rating.rating" :increment="0.5" :max-rating="5" inactive-color="#f2f2f2" active-color="#ff0"  :star-size="20"  :rating="rating.rating"></star-rating>
       </div>
       <textarea class="single-textarea" cols="50" id="new-review" v-model="rating.comment" placeholder="Enter your review here..." rows="5"></textarea>

      <div class="modal-footer">
        <button type="button" @click="clearForm()" data-dismiss="modal" class="btn btn-danger btn-block">Cancel</button>
        <button v-if="this.edit == false" type="submit" class="btn btn-light btn-block">Add Rating</button>
        <button v-else type="submit" class="btn btn-light btn-block">Edit Rating</button>
      </div>
    </form>
      </div>
    </div>
  </div>
</div>


    
    
    <div class="comment-list" v-for="rating in ratings" :key="rating.id">
                                <div class="single-comment single-reviews justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img :src="rating.user.img" alt="">
                                        </div>
                                        <div class="desc">
                                            <h5><a href="#">{{ rating.user.user_name }}</a>
                                            </h5>
                                            <div class="rating">
                                               <star-rating :read-only="true"  :max-rating="5" inactive-color="#f2f2f2" active-color="#ff0"  :star-size="20"  :rating="rating.rating"></star-rating>
                                            </div>
                                            <p class="comment">
                                                {{ rating.comment }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
 

  </div>
</template>

<script>
import Axios from 'axios'

export default {
  props: ["course_slug","total_course_ratings","course_ratings","auth_user_id"],
  data() {
    return {
      errors: [],
      ratings: JSON.parse(this.course_ratings),
      total_ratings: this.total_course_ratings,
      rating: {
        id: '',
        rating: '',
        comment: '',
      },
      avg: 0,
      edit: false
    };
  },
  mounted(){
    console.log(this.ratings)
    console.log(this.rating.auth_user_id)
  },
  methods: {
   addRating() {
    if (this.edit === false) {
        // Add

        Axios.post(`../courses/${this.course_slug}/ratings`, this.rating).then(res => {

            this.clearForm();
            alert('A New Rating Was Added');
            $('#addRating').modal('hide');
            $('.modal-backdrop').remove();
            this.ratings.push(res.data);
            this.errors = [];

        }).catch(err => {
            //window.handleErrors(error)
            this.errors = err.response.data.errors
        })
    }
    else {
    // Update

    Axios.put(`../courses/${this.course_slug}/ratings/${this.rating.id}` , this.rating).then(res => {
    
        //this.$parent.$emit('lesson_created', resp.data)
        //$('#createLesson').modal('hide')
        this.clearForm();
        alert('A New Rating Was Added');
        $('#addRating').modal('hide');
        $('.modal-backdrop').remove();
        
        console.log(res.data);

        let ratingIndex = this.ratings.findIndex(s => {
					return res.data.id == s.id 
        })
        
				
        this.ratings.splice(ratingIndex, 1, res.data)
        
    }).catch(error => {
        //window.handleErrors(error)
        this.errors = error.response.data.errors   
    })
   
   }
   },
    editRating(rating) {
      this.edit = true;
      this.rating.id = rating.id;
      this.rating.rating = rating.rating;
      this.rating.comment = rating.comment;
    },
    clearForm() {
      this.edit = false;
      this.errors = '';
      this.rating.id = null;
      this.rating.rating = '';
      this.rating.comment = '';
    },
   
  }
};
</script>