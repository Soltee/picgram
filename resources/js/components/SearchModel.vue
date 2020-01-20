<template>
	<div class="">

		<div class="md:relative">
			
			<div 
			v-if="searchStatus" 
			class="absolute  left-0 right-0 px-3 z-20 md:hidden flex flex-row items-center">
				<input @keyup.enter="searchUser" type="text" class="relative w-full  text-gray-700 rounded-full pl-12 py-1 pr-12 border border-gray-800"  v-model="searchKey">
				<svg  class="absolute right-0 z-10 mr-6 h-6 w-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
				<svg @click="searchStatus=false; getData=false; users=[];"  xmlns="http://www.w3.org/2000/svg" class="absolute left-0 z-10  ml-6 h-6 w-6 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</div>
			<svg 
			    v-else
			    @click="searchStatus=true;" 
			    class="md:hidden   h-6 w-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
			</svg>
			<div class="hidden  md:flex md:flex-row md:items-center relative">
				
				<input @keyup.enter="searchUser" type="text" class="w-full md:w-48 text-gray-700 rounded-full pl-10 py-1 pr-10 border border-gray-800"  v-model="searchKey">
				<svg  class="absolute right-0 z-10 pr-2 h-8 w-8 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
				<svg @click="getData=false; users=[];"  xmlns="http://www.w3.org/2000/svg" class="absolute left-0 z-10  pl-2 h-8 w-8 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</div>
			<div class="absolute right-0 mt-8 md:mt-4 px-3 w-full md:w-48 bg-gray-400 rounded "  >

				<div v-if="loading" class="loader">
				</div>
				
				<div v-else>
					<div v-if="getData" class=" h-64 overflow-y-scroll p-2">
						<div v-if="users.length > 0" class="flex flex-row items-end w-full px-2 py-2" v-for="u in users">

							<a  :href="`/profile/${u.id}/${u.name}`" class="mr-2 flex flex-row justify-between items-top">
								<img v-if="u.profile.avatar" class="user-img-sm mr-2" :src="u.profile.avatar">
								<svg v-else class="user-img-sm bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
								<span class="ml-3 hover:text-gray-600">{{ u.name }}</span>
							</a>
							<form id="user-profile-form" :action="`/profile`" :method="`GET`" style="display: none;">
		                        <input type="hidden" name="_token" :value="csrf">
		                        <input type="text" name="user" :value="u.id">
		                    </form>
						</div> 
						<div v-else class="p-2 border-2 rounded border-red-800 mb-2">
							No user match.
						</div>
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
			users:[],
			error: null,
			loading: false,
			search:true,
			getData : false,
			csrf : document.head.querySelector('meta[name="csrf-token"]').content
		}
	},
	methods:{
		searchUser(){
			this.loading = true;
			this.search = true;
			this.users = null;
			this.getData = false;
			axios.get(`/search?term=${this.searchKey}`)
			.then((res) => {
				this.searchKey = '';
				this.loading = false;
				let data = res.data.users;
				if (data.length > 0) {

					this.users = data;
					this.getData = true;
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
<style scoped>  
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>