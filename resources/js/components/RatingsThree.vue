<template>
  <div>
        <star-rating :read-only="true" :max-rating="5" inactive-color="#f2f2f2" active-color="#ff0"  :star-size="20"  :rating="this.total_ratings"></star-rating>
  </div>
</template>

<script>
import Axios from 'axios'

export default {
  props: ["total_course_ratings"],
  data() {
    return {
      errors: [],
      total_ratings: this.total_course_ratings,
    };
  },
  
};
</script>