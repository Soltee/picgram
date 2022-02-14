<template>
    <div class="w-full flex-1 mb-16">
        <div class="flex flex-col md:flex-row ">
            <div class="w-16 md:w-64 flex items-center">
                <img v-if="profile.avatar" class="w-auto h-auto md:w-40 md:h-40 bg-cover rounded-full" :src="`/storage/${profile.avatar }`">
                <svg 
                    v-else 
                    xmlns="http://www.w3.org/2000/svg" 
                    class="text-blue-light group-hover:text-c-white -auto h-auto md:w-40 md:h-40 bg-cover rounded-full" 
                    fill="none" 
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                                
                
            </div> 


            <div class="md:ml-4 flex-1 ">
                <!-- Author Top -->
                <div class="flex flex-row justify-between items-baseline ">
                    <div class="flex flex-row mb-2 items-baseline">
                        <h4 class="mr-3 text-blue-dark font-semibold capatialize">{{ user.name }}</h4>
                        <div v-if="auth.id !== user.id">
                            <follow-profile :user="user" :follows="hasfollowed"></follow-profile>
                        </div>
                    </div>

                    <!-- Edit profile icon -->
                    <a v-if="auth.id === user.id" class="z-0 px-2 py-1  text-right  text-white rounded text-center border border-blue-light group hover:bg-blue-light rounded-lg" :href="`/edit/${user.id}`">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-light group-hover:text-c-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                </div>

                <!-- Author Top  ENDS-->
                <div class="flex flex-row justify-between mt-2 mb-2">
                    <div class="flex">
                        <div class="flex flex-row items-center">
                            <button class="mr-3 px-1 py-1 bg-blue-light text-white lg:font-semibold md:font-semibold rounded">Posts</button>
                            <span class="text-blue-light">{{ total }} </span>
                        </div>
                        <div class="flex flex-row items-center ml-4">
                            <button @click="type = 'followers'; modelStatus = true; getFollow();" class="mr-3 px-1 py-1 bg-blue-light text-white lg:font-semibold md:font-semibold rounded">Followers</button>
                            <span class="text-blue-light"> {{ followers }} </span>
                        </div>
                        <div class="flex flex-row items-center ml-4">
                            <button @click="type = 'followings'; modelStatus = true; getFollow();" class="mr-3 px-1 py-1 bg-blue-light text-white lg:font-semibold md:font-semibold rounded">Following</button>
                            <span class="text-blue-light">{{ followings }} </span>
                        </div>
                    </div>
                </div>
                <!--Follow and posts ends-->
                <div class="flex flex-col my-3">
                    <p v-if="profile.about">{{ profile.about }}</p>
                    <a v-if="profile.url" :href="`${profile.url}`" class="">{{ profile.url }}</a>
                </div>
            </div>
        </div>

        <!--- Posts from the USer -->
        <div class="flex items-center my-6">
            <h3 class="text-blue-dark text-black font-bold  px-2 py-1">Recent Posts</h3>
        </div>

        <div v-if="posts.length > 0" class="flex flex-col justify-between items-center w-auto">
            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-4 text-center flex-1 w-auto">
                <div v-for="p in posts" :key="p.id" class="w-full">
                    
                    <div class="p-2 mb-3 flex flex-col relative shadow-lg px-3">
                        <imageSlider :post="p" :images="p.images"></imageSlider>
                        <svg @click="dropPost(p.id);" v-if="auth.id === user.id" xmlns="http://www.w3.org/2000/svg" class="absolute top-0 right-0 text-red-400 h-6 w-6 text-center flex items-center" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z" /></svg>
                    </div>
                </div>
            </div>
            <div v-if="loading" class="loader">
            </div>
            <div v-else>
                <button v-if="page" @click="more = true; getPosts()" class="my-3 text-lg font-bold shadow-lg px-2 py-2 text-blue-light rounded-lg">Click to load more ...</button>
                <div v-else>
                     <span class="text-red-400">Oops! End of line..</span>
                </div>
            </div>
        </div>
        <div v-else>
            <div v-if="!loading">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-red-400">Oops! Empty. Please upoad some pots.</p>
            </div>
        </div>

        <!-- Followers && Followings -->
        <div v-if="modelStatus" class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-40">
            <div class="h-full w-full bg-gray-100 opacity-70" @click="closeModal">
            </div>
            <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30 h-64 overflow-y-scroll overflow-x-hidden">
                <div class="flex justify-end items-center">
                    <svg 
                        @click="closeModal" 
                        class="fill-current text-red-400 h-8 w-8 -top-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path stroke-width="1" d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
                <div v-if="type == 'followers'" class="">
                    <div v-if="newFollowers.length > 0" class="flex flex-col" v-for="f in newFollowers">
                        <div class="w-full flex justify-between items-center mb-3">
                            <a 
                                :href="`/profile/${f.id}/${f.name}`" 
                                class="mr-2 flex items-center rounded-lg group hover:bg-blue-light px-2 py-1">
                                <img 
                                    v-if="f.profile.avatar" 
                                    class="user-img-sm text-blue-light group-hover:text-c-white" :src="`${f.profile.avatar}`">
                                <svg 
                                    v-else 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    class="w-10 h-10    bg-cover rounded-full text-blue-light group-hover:text-c-white" 
                                    fill="none" 
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-blue-light group-hover:text-c-white ml-3 font-medium">{{ f.name }}</span>
                            </a>
                            
                        </div>
                    </div>
                    <div v-if="newFollowers.length < 1" class="flex justify-center items-center">
                        <p class="text-red-400 text-center font-black">No User Followers.</p>
                    </div>
                </div>
                <div v-if="type == 'followings'">
                    <div v-if="newFollowings.length > 0" class="flex flex-col" v-for="f in newFollowings">
                        <div class="w-full flex justify-between items-center mb-3">
                            <a 
                                :href="`/profile/${f.id}/${f.name}`" 
                                class="mr-2 flex items-center rounded-lg group hover:bg-blue-light px-2 py-1">
                                <img 
                                    v-if="f.profile.avatar" 
                                    class="user-img-smtext-blue-light group-hover:text-c-white" 
                                    :src="`${f.profile.avatar}`">
                                <svg 
                                    v-else 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    class="w-10 h-10 bg-cover rounded-full text-blue-light group-hover:text-c-white" 
                                    fill="none" 
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-blue-light group-hover:text-c-white ml-3 font-medium">{{ f.name }}</span>
                            </a>
                        </div>
                    </div>
                    <div v-if="newFollowings.length < 1" class="flex justify-center items-center">
                        <p class="text-red-400 text-center font-black">No User Followings.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import imageSlider from './Slider';
import Toast from './Alert';
export default {
    name: 'user-profile',
    props: {
        auth: {
            type: Object,
            required: true
        },
        hasfollowed: {
            required: true
        },
        user: {
            type: Object,
            required: true
        },
        profile: {
            type: Object,
            required: true
        },
        followers: {
            required: true
        },
        followings: {
            required: true
        }
    },
    components: {
        imageSlider
    },
    data() {
        return {
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
            posts: [],
            loading: false,
            hasMore: false,
            more: false,
            page: null,
            total: 0,
            modelStatus: false,
            type: null,
            newFollowers: [],
            newFollowings: []
        }
    },
    mounted() {
        this.getPosts();
    },

    methods: {
        getPosts() {
            this.loading = true;
            let paginate = 6;
            
            let endpoint = `/posts/${this.user.id}?paginate=${paginate}`;
            if (this.page) {
                endpoint = `${this.page}&paginate=${paginate}`;
            }
            

            axios.get(`${endpoint}`)
                .then(res => {
                    let data = res.data;
                    if (this.page) {
                        data.posts.forEach((post) => {
                            this.posts.unshift(post);
                        })
                    } else {
                        this.posts = data.posts;
                    }
                    this.total = data.paginate.total_count;

                    (data.paginate.next_page_url) ? 
                        (this.page = data.paginate.next_page_url) : 
                        (this.page = null);
                    this.loading = false;
                }).catch((err => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There was some network error!'
                    });
                }));
        },
        closeModal() {
            this.modelStatus = false;;
        },
        openModal() {
            this.modelStatus = true;
        },
        getFollow() {
            axios.get(`/userFollow/${this.user.id}`)
                .then(res => {
                    let data = res.data;
                    this.newFollowers = data.followers;
                    this.newFollowings = data.followings;
                }).catch((err => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There was some network error!'
                    });
                }));
        },
        dropPost(id) {
            axios.delete(`/p/${id}/delete`)
                .then(res => {
                    if (res.status == 204) {
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
    border: 16px solid #f3f3f3;
    /* Light grey */
    border-top: 16px solid #3498db;
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

</style>
