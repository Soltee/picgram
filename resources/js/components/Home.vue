<template>
	<div>
			
			<div v-if="posts">

				<div class="flex flex-col mb-6" v-for="p in posts">
					<div class="flex flex-row mb-4">
						<a :href="`/profile/${p.user.id}/${p.user.name}`" class="flex flex-row">
							<img v-if="p.user.profile.avatar" class="user-img-sm mr-2" :src="`/storage/${p.user.profile.avatar}`">
							<svg v-else class="user-img-sm bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
							<span class="text-gray-500 font-semibold ml-4">{{ p.user.name }}</span>
						</a>
					</div>

					<imageSlider :post="p" :images="p.images"></imageSlider>

				</div>
				
			</div>
			<div v-if="posts.length < 1" class="p-2 border-2 rounded border-blue-800 mb-2">
				Please follow somebody or be followed to see on your feeds.
			</div>

			<div class="flex flx-col items-center justify-center">
	      		<div v-if="loading" class="loader">
				</div>
				<div v-else>
		        	<button v-if="!last" @click="getPosts()" class="my-3 text-lg font-bold  shadow-lg text-gray-800 rounded-lg">Load More ...</button>				
				</div>  	
	        </div>
	      

			
	</div>
</template>

<script>
import Toast from './Alert';
import  imageSlider from './Slider';

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
			loading : true,
			next : null,
			last       : false
		}
	},
	mounted(){
		this.getPosts();
	},
	methods:{
		getPosts()
		{
			this.loading = true;
			let paginate = 1;

			let endpoint = `/u/p?paginate=${paginate}`;
			if(this.next){
				endpoint = `${this.next}&paginate=${paginate}`;
			}
			axios.get(`${endpoint}`)
			.then((res) => {
				let data      = res.data;
				if(this.next){
					data.posts.forEach((post) => {
						this.posts.push(post);
					})
				} else {
					this.posts    = data.posts;
				}
				if(data.paginate.next_page_url){
				 	this.next     = data.paginate.next_page_url;					
				} else {
					this.last = true;
				}
				this.loading = false;
			}).catch(err => {
				Toast.fire({
                  icon: 'error',
                  title: 'There was some network error!'
                });
			});
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