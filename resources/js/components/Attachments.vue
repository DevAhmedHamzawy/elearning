<script>
import Axios from 'axios'

export default {
  props: ["course_slug","section_slug","lecture_slug"],
  data() {
    return {
      errors: [],
      edit: false
    };
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
                    this.uploads = [
                        ...this.uploads,
                        data
                    ]
                })
            })
  }
}
};
</script>