<template>
	
</template>

<script>
	export default {
		created() {
			window.events.$on('notification', (payload) => {
				this.$swal(payload.message);
			})
		}
	}
</script>