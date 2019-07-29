<template>
	<div>
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
		<div v-for="p in posts">
			<a  :href="`/p/${p.id}-${p.caption}`">
                <img class="post_image"  :src="'/storage/'+ p.post_image">
            </a>
		</div>
		
	</div>
</template>

<script>
let param = "";
export default {
	name: 'home',
	props:[],
	data(){
		return{
			posts: [],
			currentPage: null,
			nextPage : null,
			prevPage: null,
			error : null,
			count: null
		}
	},
	mounted(){
		this.getPosts(param)
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
					this.posts = res.data.posts.data;
					this.currentPage = res.data.posts.current_page;
					this.nextPage = res.data.posts.next_page_url;
					this.prevPage = res.data.posts.prev_page_url;
					
					
				}).catch((err => {
					this.error = err.data;
				}));
			} else {
				axios.get('/u/p')
				.then((res) => {
					console.log(res.data.posts.data);
					this.posts = res.data.posts.data;
					this.currentPage = res.data.posts.current_page;
					this.nextPage = res.data.posts.next_page_url;
					this.prevPage = res.data.posts.prev_page_url;
				}).catch(err => this.error = err.response);
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