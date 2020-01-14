<template>
	<div class="px-4 md:px-0 w-full flex-1 h-full bg-gray-900  flex flex-col items-left justify-center">

		<div v-if="loginModal" class="">
	    	<div class=" md:pl-12 text-lg my-2 font-semibold">
	    		<div class="flex flex-row items-center">		
			        <svg class="h-8 w-8 text-white pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
		            <span class="pl-2 border-white border-l-2 font-serif text-white text-xl font-black">PicGram</span>
	    		</div>
	    		<p class="font-serif text-white text-sm font-normal  mt-2">Share Memories</p>
		    </div>
		    <form @submit.prevent="authenticate" class="mt-10" >
		        <div class="md:pl-12">
		        	
		        	<div class="mb-4">
		              <label class="block text-white text-md mb-2 font-semibold   " for="email">
		                E-Mail 
		            </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(emailErr.length > 0) ? 'is-invalid': ''" id="email" type="email" v-model="email" value=""  autocomplete="email" autofocus placeholder="*******@gmail.com">
		              	
                        <p  v-if="emailErr.length > 0" v-for="e in emailErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        </p>
		            </div>

		        
		            <div class="mb-4">
		              <label class="block text-white text-md font-semibold mb-2    " for="password">
		                Password
		              </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(passErr.length > 0) ? 'is-invalid': ''" id="password" type="password" v-model="password"  autocomplete="password" autofocus placeholder="**********">
		               <p  v-if="passErr.length > 0" v-for="e in passErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        </p>
		            </div>

		           
		            <div class=" mb-4 flex flex-row items-center">
		                
		                <input class="p-1 rounded mr-3 " type="checkbox" v-model="remember" >

		                <label class="form-check-label font-normal text-gray-400" for="remember">
		                    Remember Me
		                </label>
		                   
		            </div>

		            <div class="flex flex-col my-4">
		                <button class="w-full mb-3 font-bold text-lg md:w-64 bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded">
		                    Login

		                </button>

	                    <a class="btn btn-link w-full md:w-64 text-center text-blue-200" :href="`/password/reset`">
	                         Forgot Your Password?
	                    </a>

		             	<p  @click="toggle()" id="regLink" class=" mt-3 btn btn-link w-full md:w-64 text-center text-blue-200 cursor-pointer">
		                     New Here ? <strong class="font-bold text-lg text-gray-400">Register Now.</strong>
		                </p>
		                
		            </div>
		        </div>
		    </form>
	    </div>

	    <div v-else class="">
	    	<div class=" md:pl-12 text-lg my-2 font-semibold">
	    		<div class="flex flex-row items-center">		
			        <svg class="h-8 w-8 text-white pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
		            <span class="pl-2 border-white border-l-2 font-serif text-white text-xl font-black">PicGram</span>
	    		</div>
	    		<p class="font-serif text-white text-sm font-normal  mt-2">Register</p>
		    </div>
		    <form method="POST" class="mt-10" @submit.prevent="authenticate">
		        <input type="hidden" name="register">
		        <div class="md:pl-12">
		        	<div class="mb-4">
		              <label class="block text-white text-md mb-2 font-semibold   " for="name">
		                Name
		              </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(nameErr.length > 0) ? 'is-invalid' : '' " id="name" v-model="name" autocomplete="name" autofocus placeholder="Hari ....">
			               <p  v-if="nameErr.length > 0" v-for="e in nameErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        </p>
		            </div>

		        	<div class="mb-4">
		              <label class="block text-white text-md mb-2 font-semibold   " for="email">
		                E-Mail 
		            </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(emailErr.length > 0) ? 'is-invalid': ''" id="email" type="email" v-model="email" value=""  autocomplete="email" autofocus placeholder="*******@gmail.com">
		              	
                        <p  v-if="emailErr.length > 0" v-for="e in emailErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        </p>
		            </div>

		        
		            <div class="mb-4">
		              <label class="block text-white text-md font-semibold mb-2    " for="password">
		                Password
		              </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(passErr.length > 0) ? 'is-invalid': ''" id="password" type="password" v-model="password"   autocomplete="password" autofocus placeholder="**********">
		               <p  v-if="passErr.length > 0" v-for="e in passErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        </p>
		            </div>


		            <div class="mb-4">
		              <label class="block text-white text-md font-semibold mb-2    " for="password-confirm">
		               	Confirm Password
		              </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(passErr.length > 0) ? 'is-invalid': ''" id="password-confirm" type="password" v-model="confirm"   autocomplete="new-password" autofocus placeholder="**********">

		            </div>

		           

		            <div class="flex flex-col my-4">
		                <button class="w-full mb-3 font-bold text-lg md:w-64 bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded">
		                    Register

		                </button>
		             	<p @click="toggle()" id="logLink" class="mt-3 btn btn-link w-full md:w-64 text-center text-blue-200 flex flex-col items-center cursor-pointer">
		                     <span>Already Have an account ?</span> 
		                     <strong class="font-bold text-lg text-gray-400">Login Now.</strong>
		                </p>
		                
		            </div>
		        </div>

		    </form>
	    </div>

	</div>
</template>

<script>
export default {
	name: 'welcome-view',
	data(){
		return{
			loginModal : true,
			name 	   : '',
			email      : '',
			remember   : false,
			password   : '',
			confirm    : '',
			nameErr    : [],
			passErr    : [],
			emailErr   : [],
		}
	},
	mounted(){
	},
	methods:{
		toggle(){
			this.name      = '';
			this.email     = '';
			this.password     = '';
			this.remember     = false;
			this.confirm     = '';
			this.nameErr     = '';
			this.emailErr     = '';
			this.passErr     = '';
			this.loginModal = !this.loginModal;
		},
		authenticate()
		{
			let endpoint = "";
			let formData = new FormData;
			formData.append('email', this.email);
			formData.append('password', this.password);

			if(this.loginModal){
				formData.append('remember', this.remember);
				endpoint += "/login";
			} else {
				formData.append('name', this.name);
				formData.append('password_	confirmation', this.confirm);
				endpoint += "/register";
			}
			
			console.log(endpoint);
			axios.post(`${endpoint}`, formData).then(res => {
				console.log(res.status);
				if(res.status == 201){
					window.location = '/p/browse?register=true';
				}

				if(res.status == 200){
					window.location = '/p/browse?login=true';
				}
			}).catch((err) => {
				let errors = err.response.data.errors;
				this.password     = '';
				this.confirm     = '';
				this.nameErr     = '';
				this.emailErr     = '';
				this.passErr     = '';

				if(errors.name){
					this.nameErr = errors.name;
				}
				if(errors.email){
					this.emailErr = errors.email;
				}
				if(errors.password){
					this.passErr = errors.password;
				}
			});
		}

	}
}
</script>