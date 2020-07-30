<template>
    <div>
        <carousel :perPage="1" :paginationEnabled="false" :navigationEnabled="true">
            <slide v-for="(image, index) in images" :key="index">
                <a :href="`/posts/${post.id}/${post.caption}`">
                    <img :src="`${image.url}`" class="w-full bg-gray-400 rounded-lg shadow-lg" alt="...">
                </a>
            </slide>
        </carousel>
    </div>
</template>
<script>
import { Carousel, Slide } from 'vue-carousel';
import VueMasonryWall from "vue-masonry-wall";
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
    components: {
        Carousel,
        Slide,
        
    }
}

</script>
