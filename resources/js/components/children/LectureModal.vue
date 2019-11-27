<template>
	<div class="modal fade" id="createLecture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h5 class="modal-title" id="exampleModalLabel">Create new Lecture</h5>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
	        <div class="modal-body">
		        <div class="form-group">
	              <input type="text" class="form-control" placeholder="Lecture Name" v-model="lecture.name">
				  <span class="warning" v-if="errors.name">{{ errors.name[0] }}</span>
	            </div>
				<div class="form-group">
	            	<textarea cols="30" rows="10" class="form-control" v-model="lecture.description"></textarea>
					<span class="warning" v-if="errors.description">{{ errors.description[0] }}</span>
	            </div>
	            <div class="form-group" v-if="!editing">
	              <input type="file" class="form-control" placeholder="Lecture Video" ref="file" @change="handleFileUpload()">
				  <span class="warning" v-if="errors.video_file">{{ errors.video_file[0] }}</span>
				</div>
	            <div class="form-group">
	              <input type="number" class="form-control" placeholder="Episode number" v-model="lecture.episode_number">
				  <span class="warning" v-if="errors.episode_number">{{ errors.episode_number[0] }}</span>
	            </div>
				<div class="form-group">
	            	<input type="checkbox" v-model="lecture.premium"> Premium: {{ lecture.premium }}
					<span class="warning" v-if="errors.premium">{{ errors.premium[0] }}</span>
	            </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="button" class="btn btn-primary" @click="updateLecture()" v-if="editing">Save lecture</button>
	          <button type="button" class="btn btn-primary" @click="createLecture()" v-else>Create lecture</button>
	        </div>
	      </div>
	    </div>
	  </div>
</template>

<script>
	import Axios from 'axios'

	class Lecture {
		constructor(lecture) {
			this.name = lecture.name || ''
			this.description = lecture.description || ''
			this.video = lecture.video || ''
			this.episode_number = lecture.episode_number || ''
			this.premium = lecture.premium || false 
		}
	}

	export default {
		mounted() {
			this.$parent.$on('create_new_lecture', ({ courseSlug, sectionSlug }) => {
				this.courseSlug = courseSlug
				this.sectionSlug = sectionSlug
				this.editing = false
				this.lecture = new Lecture({}) 
				$('#createLecture').modal()
			})

			this.$parent.$on('edit_lecture', ({ lecture, courseSlug, sectionSlug }) => {
				this.editing = true 
				this.lecture = new Lecture(lecture)
				this.courseSlug = courseSlug
				this.sectionSlug = sectionSlug
				this.lectureSlug = lecture.slug 

				$('#createLecture').modal()
			})
		}, 
		data() {
			return {
				lecture: {},
				courseSlug: '',
				sectionSlug: '',
				editing: false,
				lectureSlug: null,
				premium: false,
				errors: '', 
			}
		},
		methods: {
			handleFileUpload(){
 				this.lecture.video = this.$refs.file.files[0];
			},
			createLecture() {


				const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

				let formData = new FormData();

				formData.append('name', this.lecture.name);
				formData.append('description', this.lecture.description);
				formData.append('video_file', this.lecture.video);
				formData.append('episode_number', this.lecture.episode_number);
				formData.append('premium', this.lecture.premium);
				
				Axios.post(`/courses/${this.courseSlug}/sections/${this.sectionSlug}/lectures`, formData, config).then(resp => {
					console.log(resp.data);
					this.$parent.$emit('lecture_created', resp.data)
					$('#createLecture').modal('hide')
				}).catch(err => {
					//window.handleErrors(error)
					this.errors = err.response.data.errors
				})
			}, 
			updateLecture() {
				Axios.put(`/courses/${this.courseSlug}/sections/${this.sectionSlug}/lectures/${this.lectureSlug}`, this.lecture)
				 .then(resp => {
				 	$("#createLecture").modal('hide')
				 	this.$parent.$emit('lecture_updated', resp.data)
				 }).catch(err => {
					//window.handleErrors(error)
					this.errors = err.response.data.errors
				 })
			},
		}
	}
</script>