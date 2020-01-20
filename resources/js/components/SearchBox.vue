<template>
	<div class="hidden md:static left-0 right-0 p-2 md:p-0 md:static flex flex-row items-center">
		
		<input @keyup.enter="searchUser" type="text" class=" md:w-48 text-gray-700 rounded-full pl-10 py-1 pr-10 border border-gray-800"  >
		<svg  class="absolute righht-0 z-10 pr-2 h-8 w-8 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
		<svg @click="searchKey=''; reset();"  xmlns="http://www.w3.org/2000/svg" class="absolute left-0 z-10  pl-2 h-8 w-8 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
	</div>
</template>

<script>
import {serverBus} from '../app.js';
export default {
	name: 'searchBox',
	data() {
		return {
			searchKey  : ''
		}
	},
	methods: {
		searchUser(){
			serverBus.$emit('loading', {
				loading : true,
				getData : false
			});
			axios.get(`/search?term=${this.searchKey}`)
			.then((res) => {
				this.searchKey = '';
				let data = res.data.users;
				if (data.length > 0) {
					serverBus.$emit('data', {
						loading : false,
						getData : true,
						users   : data
					});
				} else {
					serverBus.$emit('data', {
						loading : false,
						getData : false
					});
				}
			}).catch(err =>{

			});
		},
		reset(){
			serverBus.$emit('reset', {
				loading : false,
				getData : false,
				searchStatus : false
			});
		}
	}

	
}
</script>
