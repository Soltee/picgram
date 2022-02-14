<template>
	<div class="ml-3">
		<button 
			@click.prevent="followPost" 
			class="px-1 font-medium py-1 rounded w-24"
			:class="{'border-0 text-white bg-blue-dark hover:text-blue-dark hover:bg-white hover:border hover:border-blue-dark' : status, 'border border-blue-dark text-blue-dark hover:bg-blue-dark hover:text-white' : !status}" 
			v-text="followStatus"></button>
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
		console.log(this.follows);
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

		}
	},
	computed:{
		followStatus(){
			return (this.status) ? 'Unfollow' : 'Follow';
		},
		followed(){
			// this.status 
			return {
				"text-blue-light  bg-blue-light hover:text-white hover:bg-blue-dark" : this.status,
				"text-white border border-blue-light hover:bg-blue-dark" : !this.status
			}
		}
	},
}
</script>