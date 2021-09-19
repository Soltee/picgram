<template>
    <div class="z-30">
        <div class="md:relative">
            <!-- Small Screen -->
            <div v-if="searchStatus" class="absolute  left-0 top-0 right-0 px-3 z-20 md:hidden flex flex-row items-center mt-3">
                <input 
                    @keyup.enter="searchUser" 
                    type="text" 
                    class="
                        relative w-full  text-gray-700 rounded-lg pl-12 py-3 pr-12
                        border border-blue-light focus:outline-none focus:ring-2 focus:border-blue-light focus:ring-opacity-50 "  
                    v-model="searchKey">
                <!-- <svg class="absolute right-0 z-10 mr-6 h-6 w-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" /></svg>
                 -->
                 <svg 
                    @click="searchStatus=false; getData=false; users=[];" xmlns="http://www.w3.org/2000/svg" 
                    class="absolute left-0 z-10  ml-6 h-6 w-6 text-red-400 opacity-75" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </div>
            <svg 
                v-else 
                @click="searchStatus=true;" 
                class="md:hidden h-8 w-8 p-1 hover:bg-blue-light hover:text-c-white  text-blue-light" 
            
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            
            <!-- Medium + Large Screen -->
            <div class="hidden  md:flex md:flex-row md:items-center relative">
                <input 
                    @keyup.enter="searchUser" 
                    type="text" 
                    class="w-full md:w-64 text-gray-700 rounded-lg pl-10 py-1 pr-10 border border-blue-light focus:outline-none focus:ring-2 focus:border-blue-light focus:ring-opacity-50 " 
                    v-model="searchKey" 
                    placeholder="Search users">
                <svg class="absolute right-0 z-10 pr-2 h-8 w-8 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <pathd="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                </svg>
                <svg 
                    @click="getData=false; users=[];" 
                    xmlns="http://www.w3.org/2000/svg" 
                    class="absolute left-0 z-10  pl-2 h-8 w-8 text-red-400 opacity-75"viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </div>

            <!-- Search Results -->
            <div class="absolute right-0 mt-10  px-1 pb-3 w-full md:w-64  md:rounded ">
                <!--- Loading Spinner  -->
                <div v-if="loading" class="flex justify-center items-center bg-c-white">
                    <div class="spinner">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                    </div>
                </div>

                <!-- Results -->
                <div v-else>
                    <div v-if="getData" 
                        class=" h-64 overflow-y-scroll overflow-x-hidden px-1 py-6 bg-c-white shadow-lg">
                        <div v-if="users.length > 0" class="flex flex-row items-end w-full px-2 py-2" v-for="u in users">
                            <a 
                                :href="`/profile/${u.id}/${u.name}`" 
                                class="mr-2 flex flex-row justify-between items-top group hover:bg-blue-light px-2 py-1 rounded-lg items-center">
                                <img 
                                    v-if="u.profile.avatar" 
                                    class="w-10 h-10 mr-2" :src="`${u.profile.avatar}`">
                                <svg 
                                    v-else 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    class="w-8 h-8    bg-cover rounded-full text-blue-light group-hover:text-c-white" 
                                    fill="none" 
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-3 text-blue-light group-hover:text-c-white hover:opacity-75">{{ u.name }}</span>
                            </a>
                            <!-- <form id="user-profile-form" :action="`/profile`" :method="`GET`" style="display: none;">
                                <input type="hidden" name="_token" :value="csrf">
                                <input type="text" name="user" :value="u.id">
                            </form> -->
                        </div>
                        <div v-if="users.length < 1" class="px-3 py-2  mb-2 flex flex-col items-center bg-c-white">
                            <svg class="w-12 md:w-16 text-red-400 mb-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z" /></svg>
                            <p class="text-red-400">No user match.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'search-model',
    props: [],
    data() {
        return {
            searchStatus: false,
            searchKey: '',
            users: [],
            error: null,
            loading: false,
            getData: false,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        }
    },
    methods: {
        searchUser() {
            this.loading = true;
            this.users = [];
            this.getData = false;
            axios.get(`/search?term=${this.searchKey}`)
                .then((res) => {
                    this.searchKey = '';
                    this.loading = false;
                    let data = res.data.users;
                    this.getData = true;
                    if (data.length > 0) {
                        this.users = data;
                    } else {
                        this.users = [];
                    }


                }).catch(err => this.error = err.response);
        },
        enlargeSearch(e) {
            return this.searchStatus = !this.searchStatus;
        }
    }
};

</script>
<style>
.loader {
    border: 16px solid #2E8BC0;
    /* Light grey */
    border-top: 16px solid #2E8BC0;
    /* Blue */
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.spinner {
    margin: 100px auto;
    width: 100px;
    height: 80px;
    text-align: center;
    font-size: 10px;
}

.spinner>div {
    background-color: #2E8BC0;
    height: 100%;
    width: 6px;
    /*margin: 0 4px 0 0;*/
    display: inline-block;

    -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
    animation: sk-stretchdelay 1.2s infinite ease-in-out;
}

.spinner .rect2 {
    -webkit-animation-delay: -1.1s;
    animation-delay: -1.1s;
}

.spinner .rect3 {
    -webkit-animation-delay: -1.0s;
    animation-delay: -1.0s;
}

.spinner .rect4 {
    -webkit-animation-delay: -0.9s;
    animation-delay: -0.9s;
}

.spinner .rect5 {
    -webkit-animation-delay: -0.8s;
    animation-delay: -0.8s;
}

@-webkit-keyframes sk-stretchdelay {

    0%,
    40%,
    100% {
        -webkit-transform: scaleY(0.4)
    }

    20% {
        -webkit-transform: scaleY(1.0)
    }
}

@keyframes sk-stretchdelay {

    0%,
    40%,
    100% {
        transform: scaleY(0.4);
        -webkit-transform: scaleY(0.4);
    }

    20% {
        transform: scaleY(1.0);
        -webkit-transform: scaleY(1.0);
    }
}

</style>
