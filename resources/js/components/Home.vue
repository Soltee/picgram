<template>
    <div>
        <div v-if="posts">
            <div class="flex flex-col mb-6" v-for="p in posts">
                <div class="flex flex-row mb-8">
                    <a :href="`/profile/${p.user.id}/${p.user.name}`" class="flex flex-row">
                        <img v-if="p.user.profile.avatar" class="user-img-sm mr-2" :src="`${p.user.profile.avatar}`">
                        <svg v-else class="user-img-sm bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z" /></svg>
                        <span class="text-gray-500 font-semibold ml-4">{{ p.user.name }}</span>
                    </a>
                </div>
                <imageSlider :post="p" :images="p.images"></imageSlider>
            </div>
        </div>
        <div v-if="posts.length < 1" class="p-2  mb-2 flex flex-col items-center">
            <svg class="h-16 w-16 text-red-500 mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z" /></svg>
            <p class="text--red-500">No feeds.</p>
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
                <button v-if="!last" @click="getPosts()" class="my-3 text-lg font-bold  text-gray-800 rounded-lg">Load More ...</button>
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
        imageSlider
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
            last: false
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            this.loading = true;
            let paginate = 1;

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

</style>
