<template>
	<div class="ml-3">
		<button @click.prevent="followPost" class="px-1 text-white font-medium py-1 rounded w-24 bg-blue-700 hover:bg-blue-600" v-text="followStatus">Follow</button>
	</div>
</template>

<script>
export default {
	name: 'followProfile',
	props:{
		user : {
			type : Object,
			required : true
		},
		follows: {
			required : true
		}
	},
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
			console.log("Following..");
			axios.post(`/follow/${this.user.id}`)
				.then(res => {
					this.status = !this.status;
				}).
				catch(err => {
					if(err.response.status == 401) {
						window.location = "/login";
					}
				});
			// axios.post(`/follow/${this.user.id}`)
			// .then(res => {
			// 	this.status = ! this.status;
			// 	console.log(res.data);
				
			// }).catch((err => {
			// 	if(err.response.status == 401) {
			// 		window.location = "/login";
			// 	}
			// }));
		}
	},
	computed:{
		followStatus(){
			return (this.status) ? 'Unfollow' : 'Follow';
		}
	},
}
</script>