<template>
	<div class="w-full">
		<form @submit.prevent="savePost" :enctype="`multipart/form-data`">
            <div class="w-full">
                <div class="flex flex-row justify-between items-center mb-3">
                    <div class="flex items-center">
  
                        <h1 class="m-0 text-lg font-bold ml-2">New Post</h1>  
                    </div>
                    <div class="flex items-center">
                        <svg @click="reset" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 mr-2 cursor-pointer"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                        <button type="submit"  class=" hover:bg-blue-500 bg-blue-600 hover:opacity-75 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline" >
                            Save
                        </button> 
                    </div>
                      
                </div> 
                <div>
				  	<div class="flex w-full items-center justify-center bg-grey-lighter mb-3">
		            	<label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue ">
		                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
		                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
		                </svg>
		                <span class="mt-2 text-lg">Choose Product Images</span>
		                <input type='file' id="files" ref="files"  class="hidden" multiple @change="handleFileUpload" />
		            </label>
		        	</div>
		        	<div v-if="files.length > 0" class=" w-full h-48 overflow-y-scroll">
		                <div v-for="(file) in fileRead" class="w-full flex flex-row flex-wrap  items-center justify-between">
		                    <div class="w-1/3 flex flex-col items-center rounded-lg">
		                        <img :src="`${file}`" class="w-full rounded-lg">
		                        <span class="rounded-lg my-2 text-white font-semibold text-lg  w-full text-center" >
		                            <svg v-on:click="removeFile( file )" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-red-600 cursor-pointer"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>

		                        </span>
		                    </div>   
		                </div>
		        	</div>

		        	<div class="flex flex-col  rounded-lg mb-3">
                        <label for="caption" class=" px-2 py-3 text-gray-800 text-md font-semibold ">Caption</label>
                        <input type="text" id="caption" v-model="caption" class="px-3 py-3 rounded-lg  bg-gray-300 text-gray-900">

                        <div v-if="captionErr.length > 0" class="">
                            <p  v-for="e in captionErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                                {{ e }}
                            </p>
                        </div>
                    </div>
	        	</div>
	        </div>
	    </form>
	</div>
</template>

<script>
import Toast from './Alert';

export default {
	name: 'upload',
	data(){
		return{
			files      : [],
			fileRead   : [],
			caption    : '',
            captionErr : []
		}
	},
	mounted(){
	},
	methods:{
		handleFileUpload(){
                // this.files = this.$refs.files.files;
                let uploadedFiles = this.$refs.files.files;
                for( var i = 0; i < uploadedFiles.length; i++ ){
                    this.files.push( uploadedFiles[i] );
                    this.readFileUrl(uploadedFiles[i]);
                }
                // this.coverFile = this.$refs.files.files[0];
                console.log(this.files);

            },
            readFileUrl(file){
                let name = file.name;
                let reader = new FileReader();  
                reader.onload = (e) => {  
                    // get file content  
                    let text = e.target.result; 
                    this.fileRead.push(e.target.result);
                }
                reader.readAsDataURL(file);
            },
            removeFile(file){
                this.files.splice( file, 1 );
                this.fileRead.splice(file, 1);
            },
            savePost(){
                this.captionErr = [];
                let formData = new FormData();
                for( var i = 0; i < this.files.length; i++ ){
                    let file = this.files[i];

                    formData.append('files[' + i + ']', file);
                }


                formData.append('caption', this.caption);
                axios.post(`/p`,
                    formData,
                    {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((res) =>{
                    if(res.status === 201){
                        

                        Toast.fire({
                            icon: 'success',
                            title:   `Post uploaded successfully!`
                        });

                        this.reset();
                    } else {
                        Toast.fire({
                          icon: 'error',
                          title: 'There was some network error!'
                        });
                    } 

                })
                .catch((err) => {
                    let errors = err.response.data.errors;
                    this.captionErr     = [];
                    console.log(errors);
                    if(errors.caption){
                        this.captionErr = errors.caption;
                    }
                    Toast.fire({
                      icon: 'error',
                      title: 'There was some network error!'
                    });
                });
            },
            reset(){
                this.caption = '';
                this.files   = [];
                this.fileRead = [];
            }
	}
}
</script>
<style scoped>  
</style>
