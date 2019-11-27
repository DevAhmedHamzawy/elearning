<template>
	<div class="container" style="color: black; font-weight: bold;">
		<h1 class="text-center">
			<button class="btn btn-primary" @click="createNewLecture()">
				Create New Lecture
			</button>
		</h1>
		<div class="">
			<ul class="list-group d-flex">
				<li class="list-group-item d-flex justify-content-between" v-for="lecture in lectures" :key="lecture.id">
					<p>{{ lecture.name }}</p> 
					<p>
						<button class="btn btn-primary btn-xs" @click="editLecture(lecture)">
							Edit
						</button>
						<button class="btn btn-danger btn-xs" @click="deleteLecture(lecture.slug, key)">
							Delete
						</button>
					</p>
				</li>
			</ul>
		</div>
		<lecture-modal></lecture-modal>
	</div>
</template>

<script>
	import Axios from 'axios'
	
	export default {
		props: ['default_lectures', 'course_slug', 'section_slug'],
		mounted() {
			this.$on('lecture_created', (lecture) => {
				/*window.noty({
					message: 'Lecture created successfully',
					type: 'success'
				})*/
				this.lectures.push(lecture)
			})

			this.$on('lecture_updated', (lecture) => {
				let lectureIndex = this.lectures.findIndex(l => {
					return lecture.id == l.id 
				})
				
				this.lectures.splice(lectureIndex, 1, lecture)
				/*window.noty({
					message: 'Lecture updated successfully',
					type: 'success'
				})*/
			})
		},
		components: {
			"lecture-modal": require('./children/LectureModal.vue').default
		},
		data() {
			return {
				lectures: JSON.parse(this.default_lectures)
			}
		},
		computed: {
			
		},
		methods: {
			createNewLecture() {
				let courseSlug = this.course_slug
				let sectionSlug = this.section_slug

				this.$emit('create_new_lecture', { courseSlug, sectionSlug })
			},
			deleteLecture(slug, key) {
				if(confirm('Are you sure you wanna delete ?')) {
					Axios.delete(`/courses/${this.course_slug}/sections/${this.section_slug}/lectures/${slug}`)
						 .then(resp => {
						 	this.lectures.splice(key, 1)
						 	/*window.noty({
								message: 'Lecture deleted successfully',
								type: 'success'
							})*/
						 }).catch(error => {
						 	window.handleErrors(error)
						 })
				}
			},
			editLecture(lecture) {
				let courseSlug = this.course_slug
				let sectionSlug = this.section_slug
				this.$emit('edit_lecture', { lecture, courseSlug, sectionSlug })
			}
		}
	}
</script>