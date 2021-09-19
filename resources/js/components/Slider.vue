<template>
    <div class="relative">
        <!-- <carousel :perPage="1" :paginationEnabled="false" :navigationEnabled="true">
            <slide v-for="(image, index) in images" :key="index">
                <a :href="`/posts/${post.id}/${post.caption}`">
                    <img :src="`${image.url}`" class="w-full bg-gray-400 rounded shadow-l-lg" alt="...">
                </a>
            </slide>
        </carousel> -->

        <!-- Vue Agile -->
        <agile
            :options="options"
            >
            <div class="slide" 
                v-for="(i, index) in images"
                :key="index"
                >
                    <a :href="`/posts/${post.id}/${post.caption}`">

                        <img 
                            :src="`${i.url}`" 
                            class="h-full rounded-lg cursor-move">
                    </a>
            
            </div>
        </agile>

    </div>
</template>
<script>
// import { Carousel, Slide } from 'vue-carousel';
// import VueMasonryWall from "vue-masonry-wall";
import { VueAgile } from 'vue-agile'

export default {
    name: 'imageSlider',
    props: {
        post: {
            type: Object,
            required: true,
        },
        images: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            options: {
                autoplay: false,
                // navButtons:true,
                // centerMode: true,
                // dots: true,
                touch:true,
            }
        }
    },
    components: {
        // Carousel,
        agile: VueAgile,

        
    }
};

</script>
<style type="text/css">
    .agile__actions{
            z-index: -1;
            display: none;
    }
    .agile__nav-button{
        height: 48px;
        width: 48px;
        color: #2E8BC0;
        font-size: 32px;
        z-index: 20;
    }
    

    .agile__nav-button--prev{
        display: flex;
        align-items: center;
        justify-content: space-between;
        
    }
    .agile__nav-button--next{
        display: flex;
        align-items: center;
        justify-content: space-between;
        
    }
</style>

