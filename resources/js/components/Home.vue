<template>
	<div>
		<div v-if="loading" class="font-semibold text-lg p-2">
			Loading ...
		</div>
		
		<div v-else>
			
			<div v-if="posts">

				<div class="flex flex-col mb-3" v-for="p in posts">
					<div class="flex flex-row mb-2">
						<a :href="`/profile/${p.user.id}`" class="flex flex-row">
							<img v-if="p.user.profile.avatar" class="user-img-sm mr-2" :src="p.user.profile.avatar">
							<svg v-else class="user-img-sm bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
							<span class="text-gray-500 font-semibold ml-4">{{ p.user.name }}</span>
						</a>
					</div>

					<imageSlider :post="p" :images="p.images"></imageSlider>

				</div>
				
			</div>
			<div v-if="posts.length < 1" class="p-2 border-2 rounded border-blue-800 mb-2">
				No Posts.
			</div>

			<div v-if="posts.length > 0" class="mt-2 flex flex-row mb-4">
	    		<div v-if="prevPage" class="mr-2">
	        	    <a @click.prevent="getPosts(prevPage)"><button class="px-1 py-1 rounded text-white bg-blue-700 hover:bg-blue-600 w-16" :class="(!prevPage) ? 'pointer-events-none' : ''">Prev</button></a> 
	    		</div>
	    		<div class="mr-2" v-if="() => posts.length > 2 ">
	        	    <button class="px-1 py-1 rounded text-white bg-blue-700 hover:bg-blue-600 w-12">{{ currentPage }}</button></a>    
	    		</div>
	    		<div v-if="nextPage" class="mr-2">
	        	    <a @click.prevent="getPosts(nextPage)"><button class="px-1 py-1 rounded text-white bg-blue-700 hover:bg-blue-600 w-16" :class="(!nextPage) ? 'pointer-events-none' : ''">Next</button></a> 
	    		</div>
	        </div>

		</div>
			
	</div>
</template>

<script>
import Toast from './Alert';
import  imageSlider from './Slider';
let param = null;

export default {
	name: 'home',
	props:[],
	components: {
      imageSlider
   	},
	data(){
		return{
			posts: [],
			currentPage: null,
			nextPage : null,
			prevPage: null,
			error : null,
			count: null,
			loading : true
		}
	},
	mounted(){
		this.getPosts(param);
	},
	methods:{
		getPosts(param)
		{
			if(param){
				this.post = [];
				this.currentPage = null;
				this.nextPage = null;
				this.prevPage = null;
				axios.get(`${param}`).then(res => {
					let data          =   res.data;
					this.posts        =   data.posts;
				
					this.prevPage     =   data.paginate.previous_page_url;
					this.currentPage  =   data.paginate.current_page;
					this.nextPage     =   data.paginate.next_page_url;
					
					this.loading = false;
				}).catch((err => {
					Toast.fire({
	                  icon: 'error',
	                  title: 'There was some network error!'
	                });
				}));
			} else {
				axios.get('/u/p')
				.then((res) => {
					let data          =   res.data;
					this.posts        =   data.posts;
				
					this.prevPage     =   data.paginate.previous_page_url;
					this.currentPage  =   data.paginate.current_page;
					this.nextPage     =   data.paginate.next_page_url;

					this.loading = false;
				}).catch(err => {
					Toast.fire({
	                  icon: 'error',
	                  title: 'There was some network error!'
	                });
				});
			}
		}
	},
	computed:{
		countPosts()
		{
			if(this.posts.length > 0){ this.count = true;} else { this.count = false; }
		}
	},
}
</script>