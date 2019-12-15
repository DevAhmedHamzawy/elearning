<template>
  <div>
     <star-rating :read-only="true" :max-rating="5" inactive-color="#f2f2f2" active-color="#ff0"  :star-size="20"  :rating="this.total_ratings"></star-rating>
    
       <div class="progress-table-wrap">
      <div class="progress-table">
        <div class="table-head">
          <div class="id">#</div>
          <div class="course_name">Course Name</div>
          <div class="operations">Operations</div>
        </div>
         <div class="table-row" v-for="rating in ratings" :key="rating.id">
            <div class="id"><star-rating :read-only="true"  :max-rating="5" inactive-color="#f2f2f2" active-color="#ff0"  :star-size="20"  :rating="rating.rating"></star-rating>
</div>
            <div class="course_name">{{ rating.comment }}</div>
            <!--<button @click="editRating(rating)" data-toggle="modal" data-target="#addRating" class="btn btn-warning"><i class="fas fa-edit"></i></button>-->

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