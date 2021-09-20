<template>
    <div class=" mx-2 flex flex-col md:flex-row ">

        <!-- User Data on small screen-->
        <div class="flex flex-row  my-3 md:hidden relative">
            <div class="mr-3 ">
                <a v-if="profile.avatar" :href="`/profile/${user.id}/${user.name}`">
                    <img class="user-img-sm" :src="`/storage/${profile.avatar}`">
                </a>
                <a v-else :href="`/profile/${user.id}/${user.name}`">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                            class="text-blue-light group-hover:text-blue-dark h-10 w-10  bg-cover rounded-full" 
                            fill="none" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                </a>
            </div>
            <div class="flex flex-col">
                <div v-if="auth.id !== user.id">
                    <follow-profile :user="user" :follows="hasfollowed"></follow-profile>
                </div>
                <p class="text-blue-light font-thin px-2 mt-2 mb-4 ml-3">{{ post.caption }} </p>

            </div>
        </div>
            
        <div class="md:w-2/3  mb-4 md:mb-0 h-full md:rounded-l-lg relative">
            
            <div class="">
            <!-- <agile
                :options="options"
                >
                <div class="slide" 
                    v-for="(i, index) in images"
                    :key="index"
                    >
                        <img 
                        :src="`${i.url}`" 
                        class="h-full rounded-l-lg rounded-r-none">
                
                </div>
            </agile>
             -->
                <imageSlider :post="post" :images="post.images"></imageSlider>

             </div>

        </div>

        <div class="md:w-1/3 px-3 md:h-full">
            <div class="hidden md:flex flex-row  my-3">
                <div class="mr-3 ">
                    <a v-if="profile.avatar" :href="`/profile/${user.id}/${user.name}`">
                        <img class="user-img-sm" :src="`/storage/${profile.avatar}`">
                    </a>
                    <a v-else :href="`/profile/${user.id}/${user.name}`">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="text-blue-light group-hover:text-blue-dark h-10 w-10  bg-cover rounded-full" 
                            fill="none" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                </div>
                <div class="flex flex-col">
                    <div v-if="auth.id !== user.id">
                        <follow-profile :user="user" :follows="hasfollowed"></follow-profile>
                    </div>
                    <p class="text-blue-light font-thin px-2 mt-2 mb-4 ml-3">{{ post.caption }} </p>

                </div>
            </div>
            
            <div class="mt-3 flex items-center">
                <svg @click="likePost" class="h-6 w-6" :class="(isLiked) ? 'text-red-600' : 'text-gray-400'" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M10 3.22l-.61-.6a5.5 5.5 0 0 0-7.78 7.77L10 18.78l8.39-8.4a5.5 5.5 0 0 0-7.78-7.77l-.61.61z" /></svg>
                <span class="ml-3 text-gray-900 ">{{ likedTotal }} People Liked</span>
            </div>
            <div class="w-full mb-8 mt-2">
                <div class="relative flex flex-row w-full">
                    <input @keyup.enter="postComment" type="text" class="w-full px-4 py-3 rounded shadow border border-c-blue text-lg pr-10 pl-4 focus:shadow" v-model="comment" placeholder="comment" />
                    <svg @click.prevent="postComment" class="absolute right-0 mt-2 mr-2 w-8 h-8 text-blue-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z" /></svg>
                </div>
                <div class="flex flex-col my-6" v-for="c in comments">
                    <div class="flex shadow-lg px-2 py-2">
                        <a :href="`/profile/${c.user.id}/${c.user.name}`" class="">
                            <img v-if="c.user.profile.avatar" class="w-8 h-8 md:w-10 md:h-10" :src="`/storage/${c.user.profile.avatar}`">
                            <svg  
                                v-else
                                xmlns="http://www.w3.org/2000/svg" 
                                class="w-8 h-8  border rounded-lg border-blue-light p-1 hover:bg-blue-light hover:text-c-white  text-blue-light   bg-cover rounded-full" fill="none" 
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>
                        <div class="ml-3 flex-1 flex flex-col">
                            <span class="text-gray-900 font-semibold text-sm">{{ c.user.name }}</span>
                            <p class="text-blue-light mt-2 font-thin">{{ c.comment }}</p>

                            <div class="mt-2">
                                <span class="text-xs"> {{ formatDate(c.comment.created_at) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import imageSlider from './Slider';
import Toast from './Alert';
import moment from 'moment';
import { VueAgile } from 'vue-agile'
export default {
    name: 'browse-post',
    props: {
        auth: {
            type: Object,
            required: true
        },
        hasfollowed: {
            required: true
        },
        post: {
            type: Object,
            required: true,
        },
        liked: {
            required: true
        },
        likedcount: {
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
        images: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            comment: "",
            error: "",
            comments: [],
            profiles: [],
            likedTotal: Number(this.likedcount),
            isLiked: this.liked,
            options: {
                autoplay: false,
                navButtons:true,
                centerMode: true,
                dots: true,
                touch:true,
            }
        }
    },
    components: {
        agile: VueAgile,
        imageSlider,
    },
    mounted() {
        (this.liked) ? (this.isLiked = true) : (this.isLiked = false);
        this.getComments(`${this.post.id}`);
    },
    methods: {
        getComments(id) {
            axios.get(`/p/${id}/comments`).then(res => {
                this.comments = res.data.comments;

            }).catch((err => {
                Toast.fire({
                    icon: 'error',
                    title: 'There was some network error!'
                });
            }));
        },

        postComment() {
            console.log(this.post.id);
            axios.post(`/p/${this.post.id}/comment`, {
                comment: this.comment
            }).then(res => {
                this.getComments(`${this.post.id}`);
            }).catch(err => {
                Toast.fire({
                    icon: 'error',
                    title: 'There was some network error!'
                });
            });
        },
        likePost() {
            axios.post(`/like/${this.post.id}`)
                .then(res => {
                    if (res.status == 200) {

                        this.isLiked = !this.isLiked;
                        (this.isLiked) ? (++this.likedTotal) : (--this.likedTotal);
                    }
                }).catch(err => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There was some network error!'
                    });
                });
        },
        formatDate(date)
        {
            // return moment(date, "YYYYMMDD").fromNow();
            return moment(date).format('MMMM Do YYYY, h:mm:ss a'); // September 20th 2021, 1:33:51 am
        }
    }
};

</script>
<style type="text/css">
    .agile__actions{
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;

    }
    .agile__nav-button{
        height: 48px;
        width: 48px;
        color: #2E8BC0;
        font-size: 32px;
    }
</style>
