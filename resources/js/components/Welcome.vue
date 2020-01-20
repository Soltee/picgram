<template>
	<div class="min-h-screen px-4 md:px-0 w-full flex-1 h-full bg-gray-900  flex flex-col items-left justify-center">

		<div v-if="loginModal" class="">
	    	<div class=" md:pl-12 text-lg my-2 font-semibold">
	    		<div class="flex flex-row items-center">		
			        <svg class="h-8 w-8 text-white pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
		            <span class="pl-2 border-white border-l-2 font-serif text-white text-md md:text-xl font-black">PicGram</span>
	    		</div>
	    		<p class="font-serif text-white text-sm font-normal  mt-2">Share Memories</p>
		    </div>
		    <form :action="`/login`" :method="`post`"  class="mt-4" id="loginForm">
		        <input type="hidden" name="_token" :value="csrf">                  
		        <input type="hidden" name="login">
		        <div class="md:pl-12">
		        	
		        	<div class="mb-4">
		              <label class="block text-white text-md mb-2 font-semibold   " for="email">
		                E-Mail 
		            	</label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(emailErr.length > 0) ? 'is-invalid': ''" id="email" type="email" v-model="email" name="email" value=""  autocomplete="email" autofocus placeholder="*******@gmail.com">
		              	
                        <div v-if="emailErr.length > 0" class="overflow-y-scroll h-12">
                        	<p   v-for="e in emailErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        	</p>
                    	</div>
		            </div>

		        
		            <div class="mb-4">
		              <label class="block text-white text-md font-semibold mb-2    " for="password">
		                Password
		              </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(passErr.length > 0) ? 'is-invalid': ''" id="password" type="password" v-model="password" name="password"  autocomplete="password" autofocus placeholder="**********">
		               <div v-if="passErr.length > 0" class="overflow-y-scroll h-12">
		               		<p   v-for="e in passErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        	</p>
                    	</div>
		            </div>

		           
		            <div class=" mb-4 flex flex-row items-center">
		                
		                <input class="p-1 rounded mr-3 " type="checkbox" v-model="remember" >

		                <label class="form-check-label font-normal text-gray-400" for="remember">
		                    Remember Me
		                </label>
		                   
		            </div>

		            <div class="flex flex-col my-4">
		                <button @click.prevent="validateData()" type="submit" id="logBtn" class="w-full mb-3 font-bold text-lg md:w-64 bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded">
		                    Login
		                </button>

	                    <a class="btn btn-link w-full md:w-64 text-center text-blue-200" :href="`/password/reset`">
	                         Forgot Your Password?
	                    </a>

		             	<p  @click="toggle()" id="regLink" class=" mt-3 btn btn-link w-full md:w-64 text-center text-blue-200 cursor-pointer">
		                     New Here ? <strong class="font-bold text-lg text-gray-400">Register Now.</strong>
		                </p>
		                <span class="block my-2 text-center w-full md:w-64 text-gray-300"> Or </span>

		                <div class="w-full md:w-64  flex flex-row items-center justify-center">
		                	
			                <a :href="`/redirect`" class="border-2 bg-gray-300 border-blue-600 rounded-full p-1">
			                	<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 md:w-8 md:h-8 text-blue-600"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
			                </a>
		                </div>
		                
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
		    <form :method="`post`" :action="`/register`" class="mt-4" id="registerForm">
		        <input type="hidden" name="_token" :value="csrf">
		        
		        <input type="hidden" name="register">
		        <div class="md:pl-12">
		        	<div class="mb-4">
		              <label class="block text-white text-md mb-2 font-semibold   " for="name">
		                Name
		              </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(nameErr.length > 0) ? 'is-invalid' : '' " id="name" v-model="name" name="name" autocomplete="name" autofocus placeholder="Hari ....">
			                <div v-if="nameErr.length > 0" class="overflow-y-scroll h-12">
			            	   <p  v-for="e in nameErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            	{{ e }}
                        		</p>
                    		</div>
		            </div>

		        	<div class="mb-4">
		              <label class="block text-white text-md mb-2 font-semibold   " for="email">
		                E-Mail 
		            </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(emailErr.length > 0) ? 'is-invalid': ''" id="email" type="email" v-model="email" name="email" value=""  autocomplete="email" autofocus placeholder="*******@gmail.com">
		              	
                        <div v-if="emailErr.length > 0"  class="overflow-y-scroll h-12">
                        	<p  v-for="e in emailErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        	</p>
                    	</div>
		            </div>

		        
		            <div class="mb-4">
		              <label class="block text-white text-md font-semibold mb-2    " for="password">
		                Password
		              </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(passErr.length > 0) ? 'is-invalid': ''" id="password" type="password" v-model="password" name="password"   autocomplete="password" autofocus placeholder="**********">
		               <div v-if="passErr.length > 0" class="overflow-y-scroll h-12">
		               		<p   v-for="e in passErr" class="text-red-800 mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        	</p>
                    	</div>
		            </div>


		            <div class="mb-4">
		              <label class="block text-white text-md font-semibold mb-2    " for="password-confirm">
		               	Confirm Password
		              </label>
		              <input class=" text-white appearance-none   w-full md:w-64 bg-gray-900 py-2 px-3  leading-tight focus:outline-none  border-b-2 border-transparent hover:border-b-2 hover:border-white" :class="(passErr.length > 0) ? 'is-invalid': ''" id="password-confirm" type="password" v-model="confirm"   autocomplete="new-password" autofocus placeholder="**********">

		            </div>

		           

		            <div class="flex flex-col my-4">
		                <button @click.prevent="validateData()" type="submit" id="regBtn"  class="w-full mb-3 font-bold text-lg md:w-64 bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded">
		                    Register

		                </button>
		             	<p @click="toggle()" id="logLink" class="mt-3 btn btn-link w-full md:w-64 text-center text-blue-200 flex flex-col items-center cursor-pointer">
		                     <span>Already Have an account ?</span> 
		                     <strong class="font-bold text-lg text-gray-400">Login Now.</strong>
		                </p>

		                <span class="block my-2 text-center w-full md:w-64 text-gray-300"> Or </span>

		                <div class="w-full md:w-64  flex flex-row items-center justify-center">
		                	
			                <a :href="`/redirect`" class="border-2 bg-gray-300 border-blue-600 rounded-full p-1">
			                	<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 md:w-8 md:h-8 text-blue-600"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
			                </a>
		                </div>
		                
		            </div>
		        </div>

		    </form>
	    </div>

	</div>
</template>

<script>
export default {
	name: 'welcome-view',
	props: {
		errors : {
			type : Array,
			required : false
		}
	},
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
			csrf : ""
		}
	},
	mounted(){
		this.refreshCsrf();

		if(this.errors.email){
			this.emailErr = [];
			this.emailErr = this.errors.email;
		}
	},
	methods:{
		toggle(){
			this.refreshCsrf();
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
		validateData()
		{
			let formData = new FormData;
			formData.append('email', this.email);
			formData.append('password', this.password);

			if(this.loginModal){
				formData.append('remember', this.remember);
				formData.append('type', 'login');
			} else {
				formData.append('name', this.name);
				formData.append('password_confirmation', this.confirm);
				formData.append('type', 'register');
			}

			const logForm =  document.getElementById('loginForm');
			const regForm =  document.getElementById('registerForm');
			console.log(logForm, regForm);

			axios.post(`/validateData`, formData).then(res => {
				if(res.status == 200){
					if(this.loginModal){
						console.log(logForm);
						logForm.submit();
					} else {
						console.log(regForm);
						regForm.submit();
					} 

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
		},
		refreshCsrf(){
			this.csrf = document.head.querySelector('meta[name="csrf-token"]').content;
		}

	}
}
</script>