<template>
	<div>
		<button @click.prevent="followPost" class="btn btn-primary" v-text="followStatus">Follow</button>
	</div>
</template>

<script>
export default {
	name: 'follow-profile',
	props:['user', 'follows'],
	data(){
		return{
			status: this.follows,
		}
	},
	mounted(){

	},
	methods:{
		followPost()
		{
			axios.post(`/follow/${this.user}/profile`)
			.then(res => {
				this.status = ! this.status;
				console.log(res.data);
				
			}).catch((err => {
				if(err.response.status == 401) {
					window.location = "/login";
				}
			}));
		}
	},
	computed:{
		followStatus(){
			return (this.status) ? 'Unfollow' : 'Follow';
		}
	},
}
</script>