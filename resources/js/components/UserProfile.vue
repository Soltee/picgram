<template>
    <div class="w-full flex-1 mb-16">

		<div class="flex flex-col md:flex-row ">
            <div class="w-16 md:w-64 flex items-center">
	                <img v-if="profile.avatar" class="w-auto h-auto md:w-40 md:h-40 bg-cover rounded-full" :src="`/storage/${profile.avatar }`">
	                <svg v-else class="w-auto h-auto md:w-40 md:h-40 bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
	        </div>
            <div class="md:ml-4 flex-1 ">
	                <!-- Author Top -->
                <div class="flex flex-row justify-between items-baseline ">
                  	<div class="flex flex-row mb-2 items-baseline">
	                    <h4 class="mr-3 text-gray-900 font-semibold capatialize">{{ user.name }}</h4>
	                    <div v-if="auth.id !== user.id">

              				<follow-profile :user="user" :follows="hasfollowed"></follow-profile>                    	
	                    </div>
	                    
                  	</div>
                  	<a v-if="auth.id === user.id" class="px-1 py-1  text-right  text-white rounded text-center" :href="`/edit/${user.id}`">
                          <svg class="h-6 w-6 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg>
                    </a>
                </div> 
                <!-- Author Top  ENDS-->
               	<div class="flex flex-row justify-between mt-2 mb-2">
                  <div class="flex">
                    <div class="flex flex-row items-center">
                      <button class="mr-3 px-1 py-1 bg-blue-700 text-white lg:font-semibold md:font-semibold rounded">Posts</button>
                      <span class="font-weight-bold">{{ posts.length }} </span>
                    </div>

                    <div class="flex flex-row items-center ml-4">
                      <button @click="type = 'followers'; modelStatus = true; getFollow();" class="mr-3 px-1 py-1 bg-blue-700 text-white lg:font-semibold md:font-semibold rounded">Followers</button>
                      <span class="font-weight-bold"> {{ followers }} </span>
                    </div>

                    <div class="flex flex-row items-center ml-4">
                      <button @click="type = 'followings'; modelStatus = true; getFollow();"  class="mr-3 px-1 py-1 bg-blue-700 text-white lg:font-semibold md:font-semibold rounded">Following</button>
                      <span class="font-weight-bold">{{ followings }}   </span>
                    </div>
                  </div>
                </div> 
                <!--Follow and posts ends-->
                <div  class="flex flex-col my-3">
                    <p v-if="profile.about">{{ profile.about }}</p>
                    <a v-if="profile.url" :href="`${profile.url}`" class="">{{ profile.url }}</a>
                </div>
            </div>
        </div>
        <h3 class="text-gray-900 text-black md:mx-6 font-bold my-6">Recent Posts</h3>

		<div v-if="posts.length > 0"  class="flex flex-col justify-between items-center w-auto">
			<div class="w-full flex flex-row mb-4 text-center flex-1 flex-wrap w-auto" >
            
	            <div 
	            v-for="p in posts"
	            :key="p.id"
	            class="w-full cm:w-1/2 md:w-1/3 lg:w-1/4 p-6" 
	           	> 

	            	<div class="p-2 mb-3 flex flex-col ">
	            		<imageSlider :post="p"  :images="p.images"></imageSlider>
	            		<svg @click="dropPost(p.id);" v-if="auth.id === user.id" xmlns="http://www.w3.org/2000/svg" class="text-red-600 h-8 w-8 text-center flex items-center" fill="currentColor" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>

					</div>
	            </div>
       	 	</div>

	        <div v-if="loading" class="loader">
			</div>
			<div v-else>
	        	<button v-if="total > 1 && hasMore" @click="more = true; getPosts()" class="my-3 text-lg font-bold bg-gray-300 shadow-lg text-gray-800 rounded-lg">Load More ...</button>	
			</div>

	    </div>
	    <div v-else >
			<p v-if="!loading" class="p-2 border-2 rounded border-blue-800 mb-2">No  Posts.</p>
		</div>

		<div v-if="modelStatus" class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
	        <div class="h-full w-full bg-gray-300" @click="closeModal">   
	        </div>
	        <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
	            <div class="flex justify-between items-center">
	            	
	                <button @click="closeModal" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
	                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
	                      <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
	                    </svg>
	                </button>

	            </div>
	            <div v-if="type == 'followers'" class="">
	            	<div v-if="newFollowers.length > 0" class="flex flex-col" v-for="f in newFollowers">
	            		<div class="w-full flex justify-around items-center mb-3">
		               		<a :href="`/profile/${f.id}/${f.name}`" class="mr-2">
								<img v-if="f.profile.avatar" class="user-img-sm" :src="`/storage/${f.profile.avatar}`">
								<svg v-else class="user-img-sm  bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
							</a>
							<span class="text-gray-900 ml-3 font-medium">{{ f.name }}</span>
		            	</div> 
	            	</div>
	            	<div v-if="newFollowers.length < 1"  class="flex justify-center items-center">
	            		<p class="text-red-600 text-center font-black">No User Followers.</p>
	            	</div>
	            </div> 	
	            <div v-if="type == 'followings'">
	            	<div v-if="newFollowings.length > 0" class="flex flex-col" v-for="f in newFollowings">
	            		<div class="w-full flex justify-around items-center mb-3">
		               		<a :href="`/profile/${f.id}/${f.name}`" class="mr-2">
								<img v-if="f.profile.avatar" class="user-img-sm" :src="`/storage/${f.profile.avatar}`">
								<svg v-else class="user-img-sm  bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
							</a>
							<span class="text-gray-900 ml-3 font-medium">{{ f.name }}</span>
		            	</div> 
	            	</div>
	            	<div v-if="newFollowings.length < 1" class="flex justify-center items-center">
	            		<p class="text-red-600 text-center font-black">No User Followings.</p>
	            	</div>
	            </div>
	        </div>
    	</div>
	</div>
</template>

<script>
import  imageSlider from './Slider';
import Toast from './Alert';
export default {
	name: 'user-profile',
	props: {
		auth : {
			type :Object,
			required :true
		},
		hasfollowed : {
			required : true
		},
		user : {
			type     : Object,
			required : true
		},
		profile : {
			type     : Object,
			required : true
		},
		followers : {
			required : true
		},
		followings : {
			required : true
		}
	},
	components: {
      imageSlider
   	},
	data(){
		return{
			csrf       : document.head.querySelector('meta[name="csrf-token"]').content,
			posts      : [],
			loading    : false,
			hasMore    : false,
			more       : false,
			page       : null,
			total      : 0,
			modelStatus    : false,
			type           : null,
			newFollowers   : [],
			newFollowings  : []	
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
			let endpoint = `/posts/${this.user.id}?paginate=${paginate}`;
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
					this.posts  = data.posts;
				}
				this.total = data.paginate.total_count;
				(data.paginate.next_page_url) ? (this.hasMore = true) : (this.hasMore = false);
				this.loading  = false;				
			}).catch((err => {
				Toast.fire({
                  icon: 'error',
                  title: 'There was some network error!'
                });
			}));
		},
		closeModal(){
			this.modelStatus = false;;
		},
		openModal(){
			this.modelStatus = true;			
		},
		getFollow(){
			axios.get(`/userFollow/${this.user.id}`)
			.then(res => {
				let data            = res.data;
				this.newFollowers    = data.followers;
				this.newFollowings  = data.followings;
			}).catch((err => {
				Toast.fire({
                  icon: 'error',
                  title: 'There was some network error!'
                });
			}));
		},
		dropPost(id){
			axios.delete(`/p/${id}/delete`)
			.then(res => {
				if(res.status == 204){
					Toast.fire({
                  		icon: 'succcess',
                  		title: 'Post deleted successfully!'
                	});
                	this.posts = this.posts.filter((state) => {
                        return state.id !== id;
                    });
				}
			}).catch((err => {
				Toast.fire({
                  icon: 'error',
                  title: 'There was some network error!'
                });
			}));
		}
	}
};
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
