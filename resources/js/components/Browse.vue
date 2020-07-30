<template>
    <div class="w-full">
        <div v-if="posts.length > 0" class="">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-6
                 mb-4 text-center  flex-wrap w-auto">
                <div v-for="p in posts" :key="p.id" v-if="p.images.length > 0" class="w-full                     ">
                    <div class="flex items-center my-2">
                        <a :href="`/profile/${p.user.id}/${p.user.name}`">
                            <img v-if="p.user.avatar" class="lg:h-24 lg:w-24 md:w-16 md:h-16 h-8 w-8 bg-cover rounded-full" :src="`${p.user.avatar}`">
                            <svg v-else class="w-6 h-6 md:w-8 md:h-8 bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z" /></svg>
                        </a>
                        <form id="uF" :action="`/profile`" method="GET" style="display: none;">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="user" :value="p.user.id">
                        </form>
                        <span class="text-md font-semibold text-gray-800 ml-3">{{p.user.name}}</span>
                    </div>
                    <div class="p-2 mb-3">
                        <imageSlider :post="p" :images="p.images"></imageSlider>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="posts.length < 1" class="p-2  mb-2 flex flex-col items-center">
            <svg class="h-16 w-16 text-red-500 mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z" /></svg>
            <p class="text--red-500">No posts.</p>
        </div>
        <div v-else class="flex flex-col items-center justify-center">
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
                <button v-if="!last" @click="getPosts()" class="my-3 text-lg font-bold  text-gray-800 rounded-lg">Load More ...</button>
            </div>
        </div>
    </div>
</template>
<script>
import imageSlider from './Slider';
import Toast from './Alert';


export default {
    name: 'browse-post',
    components: {
        imageSlider
    },
    data() {
        return {
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
            posts: [],

            paginate: [],
            postImages: [],
            loading: false,
            next: null,
            last: false
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        append() {


        },
        getPosts() {
            this.loading = true;
            let paginate = 8;

            let endpoint = `/browse/posts?paginate=${paginate}`;
            if (this.next) {
                endpoint = `${this.next}&paginate=${paginate}`;
            }


            axios.get(`${endpoint}`)
                .then(res => {
                    let data = res.data;
                    if (this.next) {
                        this.append()
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
                }).catch((err => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There was some network error!'
                    });
                }));
        },
        getPostImages(post) {
            let img = "";
            post.images.forEach((i) => {
                img = i.url;
            });
            return img;
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

.Item {
    overflow: hidden;
    border-radius: 4px;
    width: 100%;
    background: #F5F5F5;
}

.Content {
    padding: 20px;
}

img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    line-height: 0;
    display: block;
}

.grid-item {
    width: 200px;
}

.grid-item--width2 {
    width: 400px;
}


.spinner {
    margin: 100px auto;
    width: 50px;
    height: 40px;
    text-align: center;
    font-size: 10px;
}

.spinner>div {
    background-color: #6886c5;
    height: 100%;
    width: 6px;
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
