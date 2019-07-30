<template>
	<div>
		<div class="flex flex-row mb-4">
    		<div v-if="prevPage" class="mr-2">
        	    <a @click.prevent="getPosts(prevPage)"><button class="px-1 py-1 rounded text-white bg-blue-700 hover:bg-blue-600 w-12">Prev</button></a> 
    		</div>
    		<div class="mr-2" v-if="nextPage">
        	    <button class="px-1 py-1 rounded text-white bg-blue-700 hover:bg-blue-600 w-12">{{ currentPage }}</button></a>    
    		</div>
    		<div v-if="nextPage" class="mr-2">
        	    <a @click.prevent="getPosts(nextPage)"><button class="px-1 py-1 rounded text-white bg-blue-700 hover:bg-blue-600 w-12">Next</button></a> 
    		</div>
        </div>
		<div class="flex flex-col " v-for="p in posts">
			<div class="flex flex-row mb-2">
				<a :href="`/profile/${p.user.id}`" class="flex flex-row">
					<img v-if="p.user.profile.avatar" class="user-img-sm mr-2" :src="'/storage/'+ p.user.profile.avatar">
					<img v-else class="user-img-sm" :src="'/storage/users/default.jpg'">
					<span class="text-gray-500 font-semibold">{{ p.user.name }}</span>
				</a>
			</div>
			<a  :href="`/p/${p.id}-${p.caption}`">
                <img class="w-full"  :src="'/storage/'+ p.post_image">
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