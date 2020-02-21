<template>
	<div class="flex flex-row items-center">

	 	<a @click.prevent="toggleLogoutModel" class="ml-2  hover:text-gray-600" :href="`/#`">
            <svg class="hover:text-gray-400 pl-2 h-8 w-8  md:h-10 md:w-10 text-gray-300" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"/></svg>
        </a>
      	
      	<div v-if="logoutModal">
            <div class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
                <div class="h-full w-full bg-transparent" @click="logoutModal = false;">
                    
                </div>
                <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
                    <div class="text-right">
                        <button @click="logoutModal = false;" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </button>

                    </div>
                    <p class="mt-4 text-lg font-semibold text-red-600 text-center">Are you sure? You want to logout ?</p>
                    <div class="mt-6 mb-3 flex justify-end">
                        <button @click="logoutModal = false;" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Discard</button>
                        <form :method="`POST`" :action="`/logout`">
                            <input type="hidden" name="_token" :value="`${csrf}`">
                            <button type="submit" class="cursor-pointer bg-red-600 hover:bg-red-600 text-white px-4 py-3 rounded-lg">Logout</button>                            
                        </form>
                    </div>
                </div>

            </div>
        </div>
	</div>
</template>

<script>


export default {
	name: 'logout-modal',
	props:[],
	data(){
		return{
			logoutModal  : false,
            csrf         : document.head.querySelector('meta[name="csrf-token"]').content	
        }
	},
	methods:{
		toggleLogoutModel()
		{
			this.logoutModal = !this.logoutModal;
		}
	},
	
};
</script>