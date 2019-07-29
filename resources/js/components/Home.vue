<template>
	<div>
		<div v-if="count">
			<div v-for="p in posts">
				<a  :href="`/p/${p.id}-${p.caption}`">
                    <img class="post_image"  :src="'/storage/'+ p.post_image">
                </a>
			</div>
		</div>
		<div v-else>
			No
		</div>
	</div>
</template>

<script>
export default {
	name: 'home',
	props:[],
	data(){
		return{
			posts: [],
			error : null,
			count: null
		}
	},
	mounted(){
		this.getPosts()
	},
	methods:{
		getPosts()
		{
			axios.get('/u/p')
			.then((res) => {
				console.log(res.data.posts.data);
				this.posts = res.data.posts.data;
			}).catch(err => this.error = err.response);
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