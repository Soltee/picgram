<template>
	<div class="w-auto">
		<div class="flex flex-row items-center flex-wrap w-auto">
			<div v-for="c in categories" class="mr-2 mb-2">
            	<button @click.prevent="getPosts(`/p/${c.id}`)" class="px-2 py-2 bg-gray-600 rounded hover:bg-gray-400">{{ c.name }}</button>
			</div>
        </div>

        <div v-if="posts.length"  class="flex flex-col justify-between items-center w-auto">
        	
            <div class="flex flex-row mb-4 text-center flex-1 flex-wrap w-auto" >
                
                <div v-for="p in posts" class="mr-3 mt-3 w-auto">
                   <a  :href="`${p.id}-${p.caption}`">
                     <img class="lg:post_image md:post_image w-auto"  :src="'/storage/'+ p.post_image">
                   </a>
                </div>

            </div>

            <!-- Pagination starts-->
            <div class="mt-auto flex flex-row w-auto">
        		<div v-if="prevPage" class="mr-2">
            	    <a @click.prevent="getPosts(prevPage)"><button class="px-2 py-2 bg-gray-600 rounded hover:bg-gray-400">Prev</button></a> 
        		</div>
        		<div v-if="() => { return posts.length > 0 }" class="mr-2">
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
</template>

<script>
let category = "";
export default {
	name: 'browse-post',
	data(){
		return{
			categories: [],
			posts:[],
			currentPage: null,
			nextPage : null,
			prevPage: null,
			error: null,
		}
	},
	mounted(){
		this.getCategories(),
		this.getPosts(category)
	},
	methods:{
		getCategories()
		{
			axios.get('/c').then(res => {
				this.categories = res.data.categories;
				
			}).catch((err => {
				this.error = err.data;
			}));
		},
		getPosts(c)
		{
			if(c){
				this.post = [];
				this.currentPage = null;
				this.nextPage = null;
				this.prevPage = null;
				axios.get(`${c}`).then(res => {
					this.posts = res.data.posts.data;
					this.currentPage = res.data.posts.current_page;
					this.nextPage = res.data.posts.next_page_url;
					this.prevPage = res.data.posts.prev_page_url;
					
					
				}).catch((err => {
					this.error = err.data;
				}));
			} else {
				axios.get('/p/').then(res => {
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