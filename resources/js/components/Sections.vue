<template>
  <div>
   
<!-- Modal -->
<div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-labelledby="addSectionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 v-if="this.edit === false" class="modal-title" id="addSectionLabel">New Section</h5>
        <h5 v-else class="modal-title" id="addSectionLabel">Edit Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
    <form @submit.prevent="addSection" class="mb-3">
      <div class="form-group">
        <input type="text" name="name"  class="form-control" placeholder="name" v-model="section.name">
        <span class="warning" v-if="errors.name">{{ errors.name[0] }}</span>
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Description" v-model="section.description"></textarea>
        <span class="warning" v-if="errors.description">{{ errors.description[0] }}</span>
      </div>
      <div class="modal-footer">
        <button type="button" @click="clearForm()" data-dismiss="modal" class="btn btn-danger btn-block">Cancel</button>
        <button v-if="this.edit == false" type="submit" class="btn btn-light btn-block">Add Section</button>
        <button v-else type="submit" class="btn btn-light btn-block">Edit Section</button>
      </div>
    </form>
      </div>
    </div>
  </div>
</div>

    
    
      <ul v-for="section in sections" :key="section.id" class="list-group">
        
         <li class="list-group-item">{{ section.name }}
           <button @click="editSection(section)" data-toggle="modal" data-target="#addSection" class="btn btn-warning"><i class="fas fa-edit"></i></button>
           <button @click="deleteSection(section.slug, key)" class="btn btn-danger"><i class="fas fa-trash"></i></button>

         </li>
        
        
      </ul>
     
 

  </div>
</template>

<script>
import Axios from 'axios'

export default {
  props: ["course_slug","course_sections"],
  data() {
    return {
      errors: [],
      sections: JSON.parse(this.course_sections),
      section: {
        id: '',
        name: '',
        description: '',
      },
      pagination: {},
      edit: false
    };
  },
  methods: {
  deleteSection(slug, key) {
    if (confirm('Are You Sure ?')) {
    	Axios.delete(`../courses/${this.course_slug}/sections/${slug}`)
        .then(res => {
            this.sections.splice(key, 1)
            /*/window.noty({
                message: 'Lesson deleted successfully',
                type: 'success'
            })*/
        }).catch(error => {
           //window.handleErrors(error)
           console.log(error)
        })
    }
},
   addSection() {
    if (this.edit === false) {
        // Add

        Axios.post(`../courses/${this.course_slug}/sections`, this.section).then(res => {

            this.clearForm();
            alert('A New Section Was Added');
            $('#addSection').modal('hide');
            $('.modal-backdrop').remove();
            this.sections.push(res.data);
            this.errors = [];

        }).catch(err => {
            //window.handleErrors(error)
            this.errors = err.response.data.errors
        })
    }
    else {
    // Update

    Axios.put(`../courses/${this.course_slug}/sections/${this.section.slug}` , this.section).then(res => {
    
        //this.$parent.$emit('lesson_created', resp.data)
        //$('#createLesson').modal('hide')
        this.clearForm();
        alert('A New Section Was Added');
        $('#addSection').modal('hide');
        $('.modal-backdrop').remove();
        
        console.log(res.data);

        let sectionIndex = this.sections.findIndex(s => {
					return res.data.id == s.id 
        })
        
				
        this.sections.splice(sectionIndex, 1, res.data)
        
    }).catch(error => {
        //window.handleErrors(error)
        this.errors = error.response.data.errors   
    })
   
   }
   },
    editSection(section) {
      this.edit = true;
      this.section.id = section.id;
      this.section.slug = section.slug;
      this.section.name = section.name;
      this.section.description = section.description;
    },
    clearForm() {
      this.edit = false;
      this.errors = '';
      this.section.id = null;
      this.section.name = '';
      this.section.description = '';
    },
   
  }
};
</script>