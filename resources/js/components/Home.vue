<template>
    <div class="mb-16">
        
        <div v-if="posts.length > 0" class="">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3   gap-6
                 mb-4 text-center  flex-wrap w-auto">
                <div v-for="p in posts" :key="p.id" class="w-full flex flex-col">
        
                    <div class="p-2 my-3">
                        <a :href="`/profile/${p.user.id}/${p.user.name}`" class="flex flex-row items-center group mb-3">
                                <img v-if="p.user.profile.avatar" class="h-10 w-10 mr-2" :src="`/storage/${p.user.profile.avatar}`">
                                <svg v-else xmlns="http://www.w3.org/2000/svg" 
                                    class="text-blue-light group-hover:text-blue-dark h-10 w-10  bg-cover rounded-full" 
                                    fill="none" 
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-blue-light font-semibold ml-4 group-hover:text-blue-dark">{{ p.user.name }}</span>
                        </a>
                        <imageSlider :post="p" :images="p.images"></imageSlider>
                    </div>
                </div>
            </div>
        </div>
        
        <div v-if="posts.length < 1" class="p-2  mb-2 flex flex-col items-center">
            <svg class="h-16 w-16 text-red-500 mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z" /></svg>
            <p class="text-red-500">Oops! nothing is here.</p>
        </div>
        <div v-else class="flex flx-col items-center justify-center">
            <div v-if="loading" class="flex justify-center items-center">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
            <div v-else>
                <button v-if="!last" @click="getPosts()" class="my-3 text-lg font-bold  text-blue-light rounded-lg">Previous posts ...</button>
                <div v-else>
                     <span class="text-red-400">Oops! no more posts..</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Toast from './Alert';
import imageSlider from './Slider';

export default {
    name: 'home',
    props: [],
    components: {
        imageSlider,
    },
    data() {
        return {
            posts: [],
            currentPage: null,
            nextPage: null,
            prevPage: null,
            error: null,
            count: null,
            loading: true,
            next: null,
            last: false,
            // options: {
            //     autoplay: false,
            //     navButtons:true,
            //     centerMode: true,
            //     dots: true,
            //     touch:true,
            // },
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            this.loading = true;
            let paginate = 6;

            let endpoint = `/u/p?paginate=${paginate}`;
            if (this.next) {
                endpoint = `${this.next}&paginate=${paginate}`;
            }
            axios.get(`${endpoint}`)
                .then((res) => {
                    let data = res.data;
                    if (this.next) {
                        data.posts.forEach((post) => {
                            this.posts.push(post);
                        })
                    } else {
                        this.posts = data.posts;
                    }
                    if (data.paginate.next_page_url) {
                        this.next = data.paginate.next_page_url;
                    } else {
                        this.last = true;
                    }
                    this.loading = false;
                }).catch(err => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There was some network error!'
                    });
                });
        }
    },
    computed: {
        countPosts() {
            if (this.posts.length > 0) { this.count = true; } else { this.count = false; }
        }
    },
};

</script>
<style>
.spinner {
    margin: 100px auto;
    width: 100px;
    height: 80px;
    text-align: center;
    font-size: 10px;
}

.spinner>div {
    background-color: #6886c5;
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

/*.agile__actions{
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 10;
}
.agile__nav-button{
    height: 48px;
    width: 48px;
    color: #2E8BC0;
    font-size: 32px;
}
*/
</style>
