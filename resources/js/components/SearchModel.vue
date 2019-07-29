<template>
	<div class="">

		<div class="lg:hidden md:hidden flex absolute left-0 w-full mt-10 pt-2 bg-gray-400 w-full p-2">
			<input v-if="searchStatus" @keyup.prevent="searchUser" type="text" class="relative w-42 text-gray-700 rounded-full px-4 py-1 pr-10" v-model="searchKey">
			<svg v-if="searchStatus" @click.prevent="enlargeSearch" class="absolute right-0 z-10 mr-1 h-8 w-8 text-gray-700 pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><polygon points="16.172 9 10.101 2.929 11.515 1.515 20 10 19.293 10.707 11.515 18.485 10.101 17.071 16.172 11 0 11 0 9"/></svg>
		</div>
		<div class="lg:relative md:relative  flex flex-row items-center">
			<input v-if="searchStatus" @keyup.prevent="searchUser" type="text" class="absolute right-0 lg:block md:block hidden lg:w-48 md:w-48 text-gray-700 rounded-full px-4 py-1 pr-10" v-model="searchKey">
			<svg @click.prevent="enlargeSearch" class="z-10 mr-1 h-8 w-8 text-gray-700 pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
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
	data() {
		return {
			searchStatus: false,
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
		},
		enlargeSearch(e){
			console.log(e.target);
		    return this.searchStatus = ! this.searchStatus;
		}
	}
}
</script>