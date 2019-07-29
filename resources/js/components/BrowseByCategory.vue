<template>
	<div>
		<div v-for="c in categories" class="d-flex flex-row">
            <button @click.prevent="getPosts(`/p/${c.id}`)" class="btn btn-primary mr-2">{{ c.name }}</button>
        </div>
        <div class="mt-4">
        	<div class="d-flex flex-row mb-4">
        		<div v-if="prevPage" class="mr-2">
            	    <a @click.prevent="getPosts(prevPage)"><button class="btn btn-primary">Prev</button></a> 
        		</div>
        		<div class="mr-2">
            	    <button class="btn btn-primary">{{ currentPage }}</button></a>    
        		</div>
        		<div v-if="nextPage" class="mr-2">
            	    <a @click.prevent="getPosts(nextPage)"><button class="btn btn-primary">Next</button></a> 
        		</div>
            </div>
            <div class="d-flex flex-row mb-4 text-center" v-for="p in posts">
                
                <div class="mr-3">
                   <a  :href="`${p.id}-${p.caption}`">
                     <img class="post_image"  :src="'/storage/'+ p.post_image">
                   </a>
                </div>

            </div>

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