<template>
	<div class="">
		<div class="d-flex flex-row">
			<input type="text" class="form-control" v-model="searchKey">
			<button @click.prevent="searchUser" class="btn btn-primary">Search</button>
		</div>

		<div v-for="u in users">
			<a :href="`/profile/${u.id}`">
				<img class="user-img-sm" :src="'/storage/'+ u.profile.avatar">
				<span>{{ u.name }}</span>
			</a>
		</div>

	</div>
</template>

<script>
export default {
	name: 'search-model',
	props:[],
	data(){
		return{
			searchKey: '',
			users:[],
			error: null
		}
	},
	computed:{
		usersCount(){
			if(this.users.length > 0){
				return true;
			} else {return false;}
		}
	},
	methods:{
		searchUser(){
			axios.post('/search', {
				key : this.searchKey
			})
			.then((res) => {
				this.users = res.data.users.data;
			}).catch(err => this.error = err.response);
		}
	}
}
</script>