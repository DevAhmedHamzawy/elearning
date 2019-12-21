<script>
import Axios from 'axios'

export default {
  props: ["course_slug","section_slug","lecture_slug"],
  data() {
    return {
      errors: [],
      uploads: [],
      edit: false
    };
  },
  mounted() {
    this.getAttachments()
  },
  methods: {

    upload() {
            this.attachments = Array.from(this.$refs.attachments.files)

            const uploaders = this.attachments.map(attachment => {
                const form = new FormData()


                form.append('attachment_file', attachment)
                form.append('name', attachment.name)

                return axios.post(`${this.lecture_slug}/attachments`, form)
                .then(({ data }) => {
                    window.location.reload();
                    this.uploads = [
                        ...this.uploads,
                        data
                    ]
                })
            })
  },
  getAttachments(){
      return axios.get(`${this.lecture_slug}/attachments`)
                .then(({ data }) => {
                    this.uploads = data
      })      
  },
  deleteAttachment(path, file, key){
      return axios.delete(`${this.lecture_slug}/attachments/${file}`)
                .then(({ data }) => {
                    this.uploads = data
      })      
  },
}
};
</script>