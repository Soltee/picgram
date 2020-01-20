<template>
	<div class="w-full">


    	<div v-if="posts.length > 0"  class="flex flex-col justify-between items-center w-auto">
    	
            <div class="flex flex-row mb-4 text-center flex-1 flex-wrap w-auto" >
                
                <div 
                v-for="p in posts"
                :key="p.id"
                v-if="p.images.length > 0" 
                class="w-full cm:w-1/2 md:w-1/3 lg:w-1/4 p-6" 
               	> 
               		<div class="flex items-center my-2" >
               			<a :href="`/#`" onclick="event.preventDefault();document.getElementById('uF').submit();">
		                    <img v-if="p.user.avatar" class="lg:h-24 lg:w-24 md:w-16 md:h-16 h-8 w-8 bg-cover rounded-full" :src="`/storage/${p.user.avatar}`"
		                    
		                    >
		                    <svg v-else class="w-6 h-6 md:w-8 md:h-8 bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
               			</a>
	                  	<form id="uF" :action="`/profile`" method="GET" style="display: none;">
                        	<input type="hidden" name="_token" :value="csrf">
                        	<input type="hidden" name="user" :value="p.user.id">
                   		 </form>
	                    <span class="text-md font-semibold text-gray-800 ml-3">{{p.user.name}}</span>
               		</div>

                	<div class="p-2 mb-3">
                		<carousel :perPage="1" :paginationEnabled="false" :navigationEnabled="true" >
                            <slide v-for="(image, index) in p.images" :key="index">
                                <img :src="`/storage/${image.url}`" class="w-full bg-gray-400 rounded-lg shadow-lg" alt="...">
                            </slide>
                        </carousel>
					</div>	                	
                </div>

            </div>

            <div v-if="loading" class="loader">
			</div>
            <button v-else @click="more = true; getPosts()" class="my-3 text-lg font-bold bg-gray-300 shadow-lg text-gray-800 rounded-lg">Load More ...</button>

        </div>

        <div v-else >
			<p v-if="!loading" class="p-2 border-2 rounded border-blue-800 mb-2">No  Posts.</p>
		</div>



	</div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
export default {
	name: 'browse-post',
	components: {
      Carousel, Slide
   	},
	data(){
		return{
			csrf       : document.head.querySelector('meta[name="csrf-token"]').content,
			posts      : [],
			paginate   : [],
			postImages : [],
			page       : null,
			loading    : false,
			more       : false
		}
	},
	mounted(){
		this.getPosts();
	},
	methods:{
		getPosts()
		{
			this.loading = true;
			let paginate = 10;
			if(this.more){
				paginate+10;
			}
			let endpoint = `/posts?paginate=${paginate}`;
			if(this.page){
				endpoint = this.page;
			}


			axios.get(`${endpoint}`)
			.then(res => {
				let data      = res.data;
				if(this.more){
					data.posts.forEach((post) => {
						this.posts.unshift(post);
					})
				} else {
					this.posts    = data.posts;
				}
				// this.paginate = data.paginate;
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
