<template>
	<div class="w-full">

		<div v-if="loading" class="font-semibold text-lg">
			Loading ...
		</div>

        <div v-else>

        	<div v-if="posts.length > 0"  class="flex flex-col justify-between items-center w-auto">
        	
	            <div class="flex flex-row mb-4 text-center flex-1 flex-wrap w-auto" >
	                
	                <div v-for="p in posts" class="w-full md:w-1/3 lg:w-1/4">


	                	{{p.images[0] }}
	                    <!-- <img v-for="image in p.images" class="w-full"  :src="`/storage/${p.images[0].url}`"> -->
	                </div>

	            </div>

	        </div>

	        <div v-else class="p-2 border-2 rounded border-blue-800 mb-2">
				No  Posts.
			</div>

			<!-- Pagination starts-->
            <div class="mt-auto flex flex-row w-auto">
        		
            </div>
            <!--- Pagination Ends-->

        </div>

	</div>
</template>

<script>

export default {
	name: 'browse-post',
	components: {
      
   	},
	data(){
		return{
			posts    : [],
			paginate : [],
			page     : null,
			loading  : false,
			postImage : null
		}
	},
	mounted(){
		this.getPosts();
	},
	methods:{
		getPosts()
		{
			this.loading = true;
			let endpoint = '/posts';
			if(this.page){
				endpoint = this.page;
			}

			axios.get(`${endpoint}`)
			.then(res => {
				let data      = res.data;
				this.posts    = data.posts;
				this.paginate = data.paginate;
				this.loading  = false;				
			}).catch((err => {
				
			}));
		}
	}
}
</script>
<style scoped>  


</style>
