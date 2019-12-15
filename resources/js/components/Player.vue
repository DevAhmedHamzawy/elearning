<template>
  <div>
    <video id="video" @ended="videoEnded()" v-if="lecture" width="600" height="268" controls>
        <source :src="'../../../../../storage/courses/'+course_name+'/sections/'+section_name+'/lessons/'+lecture.video" type="video/mp4">
    </video>
  </div>
</template>

<script>
    import Axios from 'axios'
    export default {
        props: ['default_course_name', 'default_section_name', 'default_lecture', 'next_lecture_url'],
        data() {
            return {
                course_name: this.default_course_name,
                section_name: this.default_section_name,
                lecture: JSON.parse(this.default_lecture),
            }
        },
        methods: {
            displayVideoEndedAlert() {
                if(this.next_lecture_url) {
                    this.$swal('Yaaay ! You completed this lecture !')
                    .then(() => {
                        window.location = this.next_lecture_url
                    })
                } else {
                   this.$swal('Yaaay ! You completed this course !')
                }
                
            },
            completeLecture() {
                Axios.post(`/course/complete-lecture/${this.lecture.slug}`, {})
                     .then(resp => {
                         this.displayVideoEndedAlert()
                     })
            },
            videoEnded(){
                this.completeLecture()
            }
        }
    }
</script>
