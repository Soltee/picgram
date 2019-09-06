<template>
	<div class="w-auto">
		<div v-if="loading" class="font-semibold text-lg">
			Loading ...
		</div>
        <div v-else>
        	<div v-if="posts.length"  class="flex flex-col justify-between items-center w-auto">
        	
	            <div class="flex flex-row mb-4 text-center flex-1 flex-wrap w-auto" >
	                
	                <div v-for="p in posts" class="mr-3 mt-3 w-auto">
	                   <a  :href="`${p.id}-${p.caption}`">
	                     <img class="lg:post_image md:post_image w-auto"  :src="p.post_image">
	                   </a>
	                </div>

	            </div>

	            <!-- Pagination starts-->
	            <div class="mt-auto flex flex-row w-auto">
	        		<div v-if="prevPage" class="mr-2">
	            	    <a @click.prevent="getPosts(prevPage)"><button class="px-2 py-2 bg-gray-600 rounded hover:bg-gray-400">Prev</button></a> 
	        		</div>
	        		<div v-if="() => posts.length > 2" class="mr-2">
	            	    <button class="px-2 py-2 bg-gray-600 rounded hover:bg-gray-400">{{ currentPage }}</button></a>    
	        		</div>
	        		<div v-if="nextPage" class="mr-2">
	            	    <a @click.prevent="getPosts(nextPage)"><button class="px-2 py-2 bg-gray-600 rounded hover:bg-gray-400">Next</button></a> 
	        		</div>
	            </div>
	            <!--- Pagination Ends-->
	        </div>

	        <div v-else class="p-2 border-2 rounded border-blue-800 mb-2">
				No  Posts.
			</div>
        </div>
	</div>
</template>

<script>
let paginate = "";
export default {
	name: 'browse-post',
	data(){
		return{
			posts:[],
			currentPage: null,
			nextPage : null,
			prevPage: null,
			error: null,
			loading: true
		}
	},
	mounted(){
		this.getPosts(paginate)
	},
	methods:{
		getPosts(paginate)
		{
			if(paginate){
				this.posts = [];
				this.currentPage = null;
				this.nextPage = null;
				this.prevPage = null;
				axios.get(`${paginate}`).then(res => {
					this.loading = false;
					this.posts = res.data.posts.data;
					this.currentPage = res.data.posts.current_page;
					this.nextPage = res.data.posts.next_page_url;
					this.prevPage = res.data.posts.prev_page_url;
					
				}).catch((err => {
					this.error = err.data;
				}));
			} else {
				axios.get('/p/').then(res => {
					this.loading = false;
					this.posts = res.data.posts.data;
					this.currentPage = res.data.posts.current_page;
					this.nextPage = res.data.posts.next_page_url;
					this.prevPage = res.data.posts.prev_page_url;
					
					
				}).catch((err => {
					this.error = err.data;
				}));
			}
			
		}

	}
}
</script>