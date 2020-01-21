<template>
	<div class="">

		<div class="flex flex-row ">
            <div class="w-16 md:w-64 flex items-center">
	                <img v-if="profile.avatar" class="w-auto h-auto md:w-40 md:h-40 bg-cover rounded-full" :src="`/storage/${profile.avatar }`">
	                <svg v-else class="w-auto h-auto md:w-40 md:h-40 bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
	        </div>
            <div class="md:ml-4 flex-1 ">
	                <!-- Author Top -->
                <div class="flex flex-row justify-between items-baseline ">
                  	<div class="flex flex-row mb-2 items-baseline">
	                    <h4 class="mr-3 text-gray-600 font-semibold capatialize">{{ user.name }}</h4>
	                    <div >
	                      <follow-profile user="user" follows="false"></follow-profile>                    	
	                    </div>
	                    
                  	</div>
                  	<a v-if="auth.id === user.id" class="px-1 py-1  text-right  text-white rounded text-center" :href="`/edit/${user.id}`">
                          <svg class="h-6 w-6 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg>
                    </a>
                </div> 
                <!-- Author Top  ENDS-->
               	<div class="flex flex-row justify-between mt-2 mb-2">
                  <div class="flex">
                    <div class="flex flex-row items-center mr-2">
                      <button class="mr-3 px-1 py-1 bg-blue-700 text-white lg:font-semibold md:font-semibold rounded">Posts</button>
                      <span class="font-weight-bold">{{ posts.length }} </span>
                    </div>

                    <div class="flex flex-row items-center mr-2">
                      <button class="mr-3 px-1 py-1 bg-blue-700 text-white lg:font-semibold md:font-semibold rounded">Followers</button>
                      <span class="font-weight-bold"> </span>
                    </div>

                    <div class="flex flex-row items-center mr-2">
                      <button class="mr-3 px-1 py-1 bg-blue-700 text-white lg:font-semibold md:font-semibold rounded">Following</button>
                      <span class="font-weight-bold">  </span>
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

		<div v-if="posts.length > 0"  class="flex flex-col justify-between items-center w-auto">
			<div class="w-full flex flex-row mb-4 text-center flex-1 flex-wrap w-auto" >
            
	            <div 
	            v-for="p in posts"
	            :key="p.id"
	            class="w-full cm:w-1/2 md:w-1/3 lg:w-1/4 p-6" 
	           	> 

	            	<div class="p-2 mb-3">
	            		<imageSlider :images="p.images"></imageSlider>
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
import  imageSlider from './Slider';
export default {
	name: 'user-profile',
	props: {
		auth : {
			type :Object,
			required :true
		},
		user : {
			type     : Object,
			required : true
		},
		profile : {
			type     : Object,
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
			more  : false,
			page  : null,	
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
					this.posts    = data.posts;
				}
				this.loading  = false;				
			}).catch((err => {
				
			}));
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
