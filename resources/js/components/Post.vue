<template>
	<div class=" mx-2 md:mx-10 ">
		<div class="flex flex-row items-center my-3">
            <div class="mr-3 ">
                <a v-if="profile.avatar" href="`/profile/${user.id}/${user.name}`">
                    <img class="user-img-sm" :src="`/storage/${profile.avatar}`">
                </a>
                <a v-else :href="`/profile/${user.id}/${user.name}`">
                	<svg class="user-img-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
                </a>
            </div>
            <div v-if="auth.id !== user.id">

              <follow-profile :user="user" :follows="hasfollowed"></follow-profile>                    	
            </div> 
        </div>
		<carousel :perPage="1" :paginationEnabled="false" :navigationEnabled="true" >
            <slide v-for="(image, index) in images" :key="index">
                <img :src="`/storage/${image.url}`" class="w-full  bg-gray-400 rounded-lg shadow-lg" alt="...">
            </slide>
        </carousel>

        <div class="my-3 flex items-center">
        	<svg @click="likePost" class="h-8 w-8" :class="(isLiked) ? 'text-red-600' : 'text-white'" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 3.22l-.61-.6a5.5 5.5 0 0 0-7.78 7.77L10 18.78l8.39-8.4a5.5 5.5 0 0 0-7.78-7.77l-.61.61z"/></svg>
        	<span class="ml-3 text-white ">{{ likedTotal }} People Liked</span>
        </div>
        <div class="w-full py-12">
			<div class="relative flex flex-row w-64">
		        <input type="text" class="w-full px-2 py-3 rounded bg-gray-500 pr-10 pl-4" v-model="comment" placeholder="comment"/>
		        <svg @click.prevent="postComment" class="absolute right-0 mt-2 mr-2 w-8 h-8 text-gay-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z"/></svg>
			</div>

			<div class="flex flex-col mt-4" v-for="c in comments">
				<div class="flex">
					<a :href="`/profile/${c.user.id}`" class="mr-2">
						<img v-if="c.user.profile.avatar" class="user-img-sm" :src="`/storage/${c.user.profile.avatar}`">
						<svg v-else class="user-img-sm  bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
					</a>
					<div class="ml-3">
						<span class="text-white font-medium">{{ c.user.name }}</span>
						<p class="text-white font-bold">{{ c.comment }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import Toast from './Alert';
export default {
	name: 'browse-post',
	props:{
		auth : {
			type : Object,
			required : true
		},
		hasfollowed : {
			required : true
		},
		post : {
			type : Object,
			required :true,
		},
		liked : {
			required : true
		},
		likedcount : {
			required :true
		},
		user : {
			type : Object,
			required : true
		},
		profile : {
			type : Object,
			required :true
		},
		images : {
			type : Array,
			required : true
		}
	},
	data(){
		return {
			comment     : "",
			error       : "",
			comments    : [],
			profiles    :  [],
			likedTotal  : Number(this.likedcount),
			isLiked     : this.liked,
		}
	},
	components: {
      Carousel, Slide
   	},
	mounted(){
		(this.liked) ? (this.isLiked = true) : (this.isLiked = false);
		this.getComments(`${this.post.id}`);
	},
	methods:{
		getComments(id)
		{
			axios.get(`/p/${id}/comments`).then(res => {
				this.comments = res.data.comments;
				
			}).catch((err => {
				Toast.fire({
                  icon: 'error',
                  title: 'There was some network error!'
                });
			}));
		},

		postComment(){
			console.log(this.post.id);
			axios.post(`/p/${this.post.id}/comment`, {
				comment: this.comment
			}).then(res => {
				this.getComments(`${this.post.id}`);
			}).catch(err => {
				Toast.fire({
                  icon: 'error',
                  title: 'There was some network error!'
                });
			});
		},
		likePost(){
			axios.post(`/like/${this.post.id}`)
			.then(res => {
				if(res.status == 200){
					
					this.isLiked = !this.isLiked;
					(this.isLiked) ? (++this.likedTotal) : (--this.likedTotal);
				}
			}).catch(err => {
				Toast.fire({
                  icon: 'error',
                  title: 'There was some network error!'
                });
			});
		}
	}
};
</script>

