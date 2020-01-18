<template>
	<div class="w-full">

		<div v-if="loading" class="font-semibold text-lg">
			Loading ...
		</div>

        <div v-else>

        	<div v-if="posts.length > 0"  class="flex flex-col justify-between items-center w-auto">
        	
	            <div class="flex flex-row mb-4 text-center flex-1 flex-wrap w-auto" >
	                
	                <div v-for="p in posts" class="w-full cm:w-1/2 md:w-1/3 lg:w-1/4 p-2">

	                	<div class="p-2 mb-3">
	                		<div class="flex items-center mb-2">
                  				<img  v-if="p.user.profile.avatar" class="w-6 h-6 md:w-8 md:h-8 rounded-full"  :src="`/storage/${p.user.profile.avatar}`">
                  				<svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 md:w-8 md:h-8 rounded-full object-cover object-center"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                  				<followProfile :user="p.user"></followProfile>

                  				<h3 class="text-right text-md text-gray-900">{{ p.user.name }}</h3>
	                		
	                		</div>
                  			<img class="w-full bg-gray-400 rounded-lg shadow-lg"  :src="`/storage/${getPostImages(p)}`">
	                	</div>
	                	
	                </div>

	            </div>

	        </div>

	        <div v-else class="p-2 border-2 rounded border-blue-800 mb-2">
				No  Posts.
			</div>

			<!-- Pagination starts-->
            <div class="mt-auto flex flex-row w-auto">
        		
            </div>
            <!--- Pagination Ends-->

        </div>

	</div>
</template>

<script>
import followProfile from './FollowProfile';
export default {
	name: 'browse-post',
	components: {
      followProfile
   	},
	data(){
		return{
			posts      : [],
			paginate   : [],
			postImages : [],
			page       : null,
			loading    : false
		}
	},
	mounted(){
		this.getPosts();
	},
	methods:{
		getPosts()
		{
			this.loading = true;
			let endpoint = '/posts';
			if(this.page){
				endpoint = this.page;
			}

			axios.get(`${endpoint}`)
			.then(res => {
				let data      = res.data;
		
				this.posts    = data.posts;
				this.paginate = data.paginate;
				this.loading  = false;				
			}).catch((err => {
				
			}));
		},
		getPostImages(post){
			let img = "";
			post.images.forEach((i) => {
				img = i.url;
			});
			return img;
		}
	}
}
</script>
<style scoped>  


</style>
