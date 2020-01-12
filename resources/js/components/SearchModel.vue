<template>
	<div class="">

		<div class="">
			<div v-if="searchStatus" class="lg:hidden md:hidden inline-flex absolute top-8 left-0 w-full mt-0 z-20 pt-2 bg-gray-400 w-full p-2">
				<input  @keyup.enter="searchUser" type="text" class="relative w-full text-gray-700 rounded-full px-4 py-1 pr-10" v-model="searchKey">
				<svg @click.prevent="enlargeSearch" class="hover:text-gray-600 absolute right-0 z-10 mr-1 h-8 w-8 text-gray-700 pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><polygon points="16.172 9 10.101 2.929 11.515 1.515 20 10 19.293 10.707 11.515 18.485 10.101 17.071 16.172 11 0 11 0 9"/></svg>
			</div>
			<div class="lg:relative md:relative  flex flex-row items-center">
				<input v-if="searchStatus" @keyup.enter="searchUser" type="text" class="absolute right-0 lg:block md:block hidden lg:w-48 md:w-48 text-gray-700 rounded-full px-4 py-1 pr-10" v-model="searchKey">
				<svg @click.prevent="enlargeSearch" class="hover:text-gray-600 z-10 mr-1 h-8 w-8 text-gray-700 pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
			</div>
		</div>
		<div class="relative">

			<div class="absolute right-0  mt-4 m-2 w-48 bg-gray-400 rounded"  >

				<div v-if="loading" class="font-semibold text-lg p-2">
					Loading ...
				</div>
				
				<div v-else>
					
					<div v-if="search">

						<div class="flex flex-row items-end w-full px-2 py-2" v-for="u in users">

							<a :href="`/profile/${u.id}`" class="mr-2 flex flex-row justify-between items-top">
								<img v-if="u.profile.avatar" class="user-img-sm mr-2" :src="u.profile.avatar">
								<svg v-else class="user-img-sm bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
								<span class="hover:text-gray-600">{{ u.name }}</span>
							</a>
						</div> 
						
					</div>
					<div v-else class="p-2 border-2 rounded border-red-800 mb-2">
						No user match.
					</div>

				</div>

			</div>

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
			users:null,
			error: null,
			loading: false,
			search:true
		}
	},
	methods:{
		searchUser(){
			this.loading = true;
			this.search = true;
			this.users = null;
			axios.get(`/search?term=${this.searchKey}`)
			.then((res) => {
				this.searchKey = '';
				this.loading = false;
				let data = res.data.users;
				if (data.length > 0) {

					this.users = data;
				} else {
					this.search = false;
				}


			}).catch(err => this.error = err.response);
		},
		enlargeSearch(e){
		    return this.searchStatus = ! this.searchStatus;
		}
	}
}
</script>